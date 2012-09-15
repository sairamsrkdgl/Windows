'''''''''''''''''''''''''''''''''''
' WINventory                      '
' Software and Hardware inventory '
' Outputs into MySQL              '
' (c) Mark Unwin 2003             '
'''''''''''''''''''''''''''''''''''


''''''''''''''''''''''''''''''''''''
' User defined settings below here '
''''''''''''''''''''''''''''''''''''
Dim verbose
Public online
Dim strComputer
Dim mysql
Dim input_file
Dim email_to
Dim email_from
Dim email_failed
Dim email_server
Dim audit_local_domain
Dim local_domain
Dim sql


verbose = "y"					' y OR n
online = "y"					' y OR n
strComputer = "."				' PC to audit
mysql = "localhost"				' MySQL Server address
'input_file = "servers.txt"			' Put the filename of your pc names here
email_to = "munwin@qpcu.org.au"			' Where to send an email of failed audits
email_from = "munwin@qpcu.org.au"		' From address for above
email_server = "qpcu-svr3"			' The IP Address of the email server to send the email
'audit_local_domain = "y"			' y or n
local_domain = "LDAP://DC=ho,DC=qpcu,DC=org,DC=au" ' standard LDAP domain format
sql = ""

audit_local_domain_servers_only = "y"
audit_local_domain_servers_only_win2003_domain = "ho.qpcu.org.au"
audit_local_domain_servers_only_win2000NT_domain = "QPCU-HO"

''''''''''''''''''''''''''''''''''''
' Uncomment the 3 lines below to   '
'  have the script ask for a PC    '
'  to audit (name or IP)           '
''''''''''''''''''''''''''''''''''''
'strAnswer = InputBox("PC to run audit on:", "Audit Script")
'Wscript.Echo "Input PC Name: " & strAnswer
'strComputer = strAnswer





''''''''''''''''''''''''''''''''''''''''
' Audit the local domain, if requested '
''''''''''''''''''''''''''''''''''''''''
if audit_local_domain = "y" then
  Const ADS_SCOPE_SUBTREE = 2
  Set objConnection = CreateObject("ADODB.Connection")
  Set objCommand =   CreateObject("ADODB.Command")
  objConnection.Provider = "ADsDSOObject"
  objConnection.Open "Active Directory Provider"
  Set objCOmmand.ActiveConnection = objConnection
  objCommand.CommandText = "Select Name, Location from '" & local_domain & "' Where objectClass='computer'"  
  objCommand.Properties("Page Size") = 1000
  objCommand.Properties("Searchscope") = ADS_SCOPE_SUBTREE 
  objCommand.Properties("Sort On") = "name"
  Set objRecordSet = objCommand.Execute
  objRecordSet.MoveFirst
  Do Until objRecordSet.EOF
    On Error Resume Next
    strComputer = objRecordSet.Fields("Name").Value
    if verbose = "y" then
      wscript.echo "Computer Name from ldap: " & strComputer
    end if
    Set oReg=GetObject("winmgmts:{impersonationLevel=impersonate}!\\" & strComputer & "\root\default:StdRegProv")
    Set objWMIService = GetObject("winmgmts:\\" & strComputer & "\root\cimv2")
    Audit (strComputer)
    Set strComputer = nothing
    Set oReg = nothing
    Set objWMIService = nothing
    objRecordSet.MoveNext
  Loop
end if



''''''''''''''''''''''''''''''''''''''''''''''''
' Audit the local domain Servers, if requested '
''''''''''''''''''''''''''''''''''''''''''''''''
if audit_local_domain_servers_only = "y" then
  set database2=createobject("adodb.connection")
  conn2="driver={mysql};server=" & mysql & ";database=winventory;Uid=root"
  database2.open conn2
  SQL_QUERY = "select system_name from system WHERE system_os_name LIKE '%Server%' AND (net_domain = '" & audit_local_domain_servers_only_win2003_domain & "' OR net_domain = '" & audit_local_domain_servers_only_win2000NT_domain & "') ORDER BY system_name"
  wscript.echo SQL_QUERY
  SET system = database2.execute(SQL_QUERY)
  Do While Not system.EOF
    wscript.echo "Name: " & system.fields("system_name")
    strComputer = system.fields("system_name")
    Set oReg=GetObject("winmgmts:{impersonationLevel=impersonate}!\\" & strComputer & "\root\default:StdRegProv")
    Set objWMIService = GetObject("winmgmts:\\" & strComputer & "\root\cimv2")
    Audit (strComputer)
    Set strComputer = nothing
    Set oReg = nothing
    Set objWMIService = nothing
    system.MoveNext
  Loop
end if



'''''''''''''''''''''''''''''''''''
' Read the text file if requested '
'  and audit PCs within - line    '
'  by line                        '
'''''''''''''''''''''''''''''''''''
On Error Resume Next
if input_file <> "" then
   Set objFSO = CreateObject("Scripting.FileSystemObject")
   Set objTextFile = objFSO.OpenTextFile(input_file, 1)
   Do Until objTextFile.AtEndOfStream
     strString = objTextFile.ReadLine
     strSplit = split(strString, ",")
     if strSplit(0) <> "" then
       strComputer = strSplit(0)
       wscript.echo "Computer Name from file: " & strComputer
     end if
     if strSplit(1) <> "" then
       strUser = strSplit(1)
     end if
     if strSplit(2) <> "" then
       strPass = strSplit(2)
     end if
     ' Below is for a PC on the local domain
     if ((strSplit(1) = "") AND (strSplit(2) = "")) then
       if verbose = "y" then
         wscript.echo "A local domain PC."
       end if
       Set oReg=GetObject("winmgmts:{impersonationLevel=impersonate}!\\" & strComputer & "\root\default:StdRegProv")
       Set objWMIService = GetObject("winmgmts:\\" & strComputer & "\root\cimv2")
     end if
     ' Below is for a PC not on the local domain
     if ((strSplit(0) <> "") AND (strSplit(1) <> "") AND (strSplit(2) <> "")) then
       if verbose = "y" then
         wscript.echo "Not a local domain PC."
       end if
       Set wmiLocator = CreateObject("WbemScripting.SWbemLocator")
       Set wmiNameSpace = wmiLocator.ConnectServer( strComputer, "root\default", strUser, strPass)
       Set oReg = wmiNameSpace.Get("StdRegProv")
       Set objWMIService = wmiLocator.ConnectServer(strComputer, "root\cimv2",strUser,strPass)
       objWMIService.Security_.ImpersonationLevel = 3
     end if

     If IsConnectible(strComputer, "", "") Then
       Audit (strComputer)
     else
       if verbose = "y" then
         wscript.echo "Cannot connect to " & strComputer
         wscript.echo
       end if
       email_failed = email_failed & strComputer & ", " & VBCrLf
     end if
     strComputer = ""
   Loop
else
  Set oReg=GetObject("winmgmts:{impersonationLevel=impersonate}!\\" & strComputer & "\root\default:StdRegProv")
  Set objWMIService = GetObject("winmgmts:\\" & strComputer & "\root\cimv2")
  Audit (strComputer)
end if




''''''''''''''''''''''''''''''''''
' Send an email of failed audits '
' if there are any               '
''''''''''''''''''''''''''''''''''
if email_failed <> "" then
  Set objEmail = CreateObject("CDO.Message")
  objEmail.From = email_from
  objEmail.To   = email_to
  objEmail.Subject = "Failed Windows Inventory (Disk) Audits." 
  objEmail.Textbody = "The following systems failed to report disk usage: " & vbCRLF & email_failed
  objEmail.Configuration.Fields.Item ("http://schemas.microsoft.com/cdo/configuration/sendusing") = 2
  objEmail.Configuration.Fields.Item ("http://schemas.microsoft.com/cdo/configuration/smtpserver") = email_server 
  objEmail.Configuration.Fields.Item ("http://schemas.microsoft.com/cdo/configuration/smtpserverport") = 25
  objEmail.Configuration.Fields.Update
  objEmail.Send
end if






function Audit(strComputer)


''''''''''''''''''''''''''''''''''''''''''
'   Setup for Online database connection '
''''''''''''''''''''''''''''''''''''''''''
set database=createobject("adodb.connection")
conn="driver={mysql};server=" & mysql & ";database=winventory;Uid=root"
database.open conn


'''''''''''''''''''''''''''
'   Who are we auditing   '
'''''''''''''''''''''''''''
On Error Resume Next

Set colItems = objWMIService.ExecQuery("Select * from Win32_ComputerSystem",,48)
For Each objItem in colItems
   system_name = objItem.Name
Next
if verbose = "y" then
   wscript.echo "Currently auditing PC: " & strComputer
   wscript.echo "PC name from WMI: " & system_name
end if


''''''''''''''''''''''''''''''''
' Double check WMI is working  '
''''''''''''''''''''''''''''''''
if ((UCase(strComputer) <> system_name) AND (strComputer <> ".")) then 
  email_failed = email_failed & strComputer & ", " & vbCRlf
  exit function
end if


'''''''''''''''''''''''''''
'   Network Information   '
'''''''''''''''''''''''''''
count = 0
count_all = 0
On Error Resume Next
Set colItems = objWMIService.ExecQuery("select * from win32_networkadapterconfiguration WHERE IPEnabled='TRUE' " _
   & "AND ServiceName<>'AsyncMac' AND ServiceName<>'VMnetx' " _
   & "AND ServiceName<>'VMnetadapter' AND ServiceName<>'Rasl2tp' " _
   & "AND ServiceName<>'PptpMiniport' AND ServiceName<>'Raspti' " _
   & "AND ServiceName<>'NDISWan' AND ServiceName<>'RasPppoe' " _
   & "AND ServiceName<>'NdisIP' AND ServiceName<>''",,48)
For Each objItem in colItems
   count_all = count_all + 1
   if objItem.IPAddress(0) <> "0.0.0.0" then
     count = count + 1
     if count = 1 then
       net_ip_address = objItem.IPAddress(0)
       net_mac_address = objItem.MACAddress
     end if
   end if
' Does the machine have a NIC ?
' If not - use the PC name for the MAC address
' so it will have an entry in the database to join the tables together
if count_all = 0 then
   if net_mac_address = "" then
     net_mac_address = system_name
     net_ip_address = "000.000.000.000"
   end if
end if
Next
if verbose = "y" then
   wscript.echo "System MAC Address: " & net_mac_address
   wscript.echo "System IP Address: " & net_ip_address
end if



'''''''''''''''''''''''''''
'   Partition Information '
'''''''''''''''''''''''''''
sHost = strComputer
LocalDrives = HostDrives(sHost)
For Each LocalDrive in LocalDrives
  On Error Resume Next
  Set objWMIService = GetObject("winmgmts:\\" & strComputer & "\root\cimv2")
  Set colItems = objWMIService.ExecQuery("Select * from Win32_LogicalDisk WHERE caption='" & LocalDrive &"'",,48)
  For Each objItem in colItems
    partition_caption = objItem.Caption
    partition_free_space = Round(objItem.FreeSpace /1024 /1024 ,1)
    partition_size = Round(objItem.Size /1024 /1024 ,1)
    partition_volume_name = objItem.VolumeName
    partition_percent = round(((partition_size - partition_free_space) / partition_size) * 100 ,0)
    timestamp = now()
  Next
  sql = "INSERT INTO graphs_disk ( disk_mac, disk_letter, disk_percent" _
  & ") VALUES ('" _
  & net_mac_address & "','" _
  & partition_caption & "','" _
  & partition_percent & "')" 
  database.execute sql
  if verbose = "y" then
    wscript.echo "Partition Caption: " & partition_caption
    wscript.echo "Partition Percent Used: " & partition_percent
    wscript.echo "---------------------------------------------------"
    wscript.echo
    wscript.echo
  end if
Next


End Function








Function HostDrives(sHost)
 CONST LOCAL_DISK = 3
 Dim WmiSvc, Disks, Disk, aTmp(), i
 Set WmiSvc = GetObject("winmgmts:" & "{impersonationLevel=impersonate}!\\" & sHost & "\root\cimv2")
 Set Disks = WmiSvc.ExecQuery ("Select * from Win32_LogicalDisk where DriveType=" & LOCAL_DISK)
 ReDim aTmp(Disks.Count - 1)
 i = -1
 For Each Disk in Disks
  i = i + 1
   aTmp(i) = Disk.DeviceID
 Next
 HostDrives = aTmp
End Function

Function DrivePartition(sHost, sDrive)
 Dim WmiSvc, Associator, Associators
 Set WmiSvc = GetObject("winmgmts:{impersonationLevel=impersonate}!\\" & sHost & "\root\cimv2")
 Set Associators = WmiSvc.ExecQuery ("Associators of {Win32_LogicalDisk.DeviceID=""" & sDrive & """} WHERE ResultClass=CIM_DiskPartition")
 On Error Resume Next
 For Each Associator in Associators
  DrivePartition = Associator.Name
  If Err.Number <>0 then Err.Clear
 Next
End Function

Function IsConnectible(sHost,iPings,iTO)
 If iPings = "" Then iPings = 2
 If iTO = "" Then iTO = 750
  Set oShell = CreateObject("WScript.Shell")
  Set oExCmd = oShell.Exec("ping -n " & iPings _
   & " -w " & iTO & " " & sHost)
  Select Case InStr(oExCmd.StdOut.Readall,"TTL=")
    Case 0 IsConnectible = False
    Case Else IsConnectible = True
  End Select
End Function
