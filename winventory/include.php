<?php
include "include_config.php";
include "include_win_type.php";
include "include_win_img.php";
include "include_functions.php";
include "include_lang_english.php";
include "include_col_scheme.php";

if ($use_pass != "n") { 
  // If there's no Authentication header, exit
  if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="PHP Secured"');
    exit('This page requires authentication');
  }
  // If the user name doesn't exist, exit
  if (!isset($users[$_SERVER['PHP_AUTH_USER']])) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="PHP Secured"');
    exit('Unauthorized!');
  }
  // Is the password doesn't match the username, exit
  if ($users[$_SERVER['PHP_AUTH_USER']] != $_SERVER['PHP_AUTH_PW'])
  {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="PHP Secured"');
    exit('Unauthorized!');
  }
} else {}

ob_start(); 
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WINventory</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta content="Windows Inventory" name="description" />
<meta content="inventory, software, hardware, windows, automatic" name="keywords" />
<meta content="Mark Unwin" name="author" />
<?php include "include_style.php"; ?>

<?php
if ($_SERVER["PHP_SELF"] == "/winventory/index.php") {
?>

<script type="text/javascript">
<!--
 function switchUl(id){
  if(document.getElementById){
   a=document.getElementById(id);
   a.style.display=(a.style.display!="none")?"none":"block";
  }
 }
 for(i=0;i<9;i++)   //number of folders HERE
{
  switchDIV('f'+i);
 }
// -->
</SCRIPT>

<?php
} else {}
?>

</head>
<body>

<?php
$sub = "0";
$pc = "";
if (isset($_GET['pc'])) { $pc = $_GET['pc'];   } else { }
if (isset($_GET['sub'])) { $sub = $_GET['sub']; } else { $sub="all"; }
if (isset($_GET['sort'])) { $sort = $_GET['sort']; } else { $sort="system_name"; }
$mac = $pc;
$db = mysql_connect($mysql_server,$mysql_user,$mysql_password) or die('Could not connect: ' . mysql_error());
mysql_select_db($mysql_database,$db);
$SQL = "SELECT config_value FROM config WHERE config_name = 'version'";
$result = mysql_query($SQL, $db);
$myrow = mysql_fetch_array($result);
$version = $myrow["config_value"];


?>

<div id="header">
<form action="search_name.php" method="post">
<table style="width: 100%;" cellpadding="0" cellspacing="0" class="header">
  <tbody>
    <tr style="<?php echo $header_top; ?>">
      <td width="150" height="23"><img src="<?php echo $header_top_image; ?>" border="0" width="150" height="23" alt=""></img></td>
      <td></td>
      <td width="280"><font style="font-family: Verdana;" size="-2" color="white">WINventory Home&nbsp;&nbsp;|&nbsp;&nbsp;Site Map</font></td>
    </tr>
    <tr style="<?php echo $header_middle; ?>">
      <td height="42"><a href="index.php"><img src="<?php echo $header_middle_image; ?>" border="0" height="42" width="409" alt="" /></a></td>
      <td>&nbsp;</td>
      <td width="280">Search WINventory for (system name)<input size="30" name="system_name" class="header" />&nbsp;&nbsp;<input name="submit" value="Go" type="submit" /></td>
    </tr>
    <tr style="<?php echo $header_bottom; ?>">
      <td height="23"><span style="color: rgb(255, 255, 255); font-family: Verdana; font-size:15px;">&nbsp;Network Inventory Tracking</span></td>
      <td></td>
      <td align="right"><font size="-2" color="white">© Mark Unwin, 2005.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;v&nbsp;<?php echo $version; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></td>
    </tr>
    <tr style="background-color: <?php echo $background; ?>;">
      <td height="20" colspan="3">&nbsp;&nbsp;<a href="index.php" class="header">Home</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="help.php" class="header">Help</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://winventory.sf.net/" class="header">WINventory on the web</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="call_home.php" class="header">Call Register</a></td>
    </tr>
  </tbody>
</table>
</form>
</div>

<?php
echo "<div id=\"menu_container\">\n";
echo "<div class=\"menu_each\">\n";
echo " <a class=\"menuhead\" href=\"admin.php?sub=d1\">" . $l_adm . "</a>\n";
if ($page == "admin") {
  echo " <a class=\"menu\" href=\"admin_pc_add.php?sub=1\">&nbsp;&nbsp;" . $l_add . "</a>\n";
  echo " <a class=\"menu\" href=\"admin_pc_delete.php?sub=1\">&nbsp;&nbsp;" . $l_del . "</a>\n";
  echo " <a class=\"menu\" href=\"scripts/audit.vbs\">&nbsp;&nbsp;" . $l_aud . "</a>\n";
  echo " <a class=\"menu\" href=\"admin_config.php?sub=1\">&nbsp;&nbsp;" . $l_con . "</a>\n";
 } else {}
echo "</div>\n\n";

echo "<div class=\"menu_each\">\n";
echo " <a class=\"menuhead\" href=\"index.php\">Queries</a>\n";
if ($page == NULL) {
  echo " <a class=\"menu\" href=\"list_all.php\">&nbsp;&nbsp;" . $l_awp . "</a>\n";
  echo " <a class=\"menu\" href=\"list_servers.php\">&nbsp;&nbsp;" . $l_asv . "</a>\n";
  echo " <a class=\"menu\" href=\"list_workstations.php\">&nbsp;&nbsp;" . $l_aws . "</a>\n";
  echo " <a class=\"menu\" href=\"list_desktops.php\">&nbsp;&nbsp;" . $l_adk . "</a>\n";
  echo " <a class=\"menu\" href=\"list_laptops.php\">&nbsp;&nbsp;" . $l_alp . "</a>\n";
  echo " <a class=\"menu\" href=\"list_software.php?sub=1\">&nbsp;&nbsp;" . $l_asw . "</a>\n";
  echo " <a class=\"menu\" href=\"list_software_hotfixes.php?sub=1\">&nbsp;&nbsp;" . $l_ahf . "</a>\n";
  echo " <a class=\"menu\" href=\"list_software_bho.php?sub=1\">&nbsp;&nbsp;" . $l_abh . "</a>\n";
  echo " <a class=\"menu\" href=\"list_ms_keys.php\">&nbsp;&nbsp;" . $l_wcd . "</a>\n";
  echo " <a class=\"menu\" href=\"list_office_keys.php\">&nbsp;&nbsp;" . $l_ofc . "</a>\n";
  echo " <a class=\"menu\" href=\"list_other_keys.php\">&nbsp;&nbsp;" . $l_ocd . "</a>\n";
  echo " <a class=\"menu\" href=\"query.php?sub=3\">&nbsp;&nbsp;" . $l_oah . "</a>\n";
  $SQL2 = "SELECT * FROM group_names ORDER BY group_name";
  $result2 = mysql_query($SQL2, $db);
  if ($myrow2 = mysql_fetch_array($result2)){
    echo " <hr />\n";
    do {
      echo " <a class=\"menu\" href=\"group_members_list.php?sub=e1&amp;group=" . $myrow2["group_id"] . "\">&nbsp;&nbsp;" . $myrow2["group_name"] . "</a>\n";
    } while ($myrow2 = mysql_fetch_array($result2));
  } else {}
} else {}
echo "</div>\n\n";



echo "<div class=\"menu_each\">\n";
echo " <a class=\"menuhead\" href=\"software_register.php\">" . $l_swr . "</a>\n";
if ($page == "register") {
  echo " <a class=\"menu\" href=\"software_register.php\">&nbsp;&nbsp;" . $l_srg . "</a>\n";
  echo " <a class=\"menu\" href=\"software_register_add.php\">&nbsp;&nbsp;" . $l_asr . "</a>\n";
  echo " <a class=\"menu\" href=\"software_register_del.php\">&nbsp;&nbsp;" . $l_rsw . "</a>\n";
} else {}
echo "</div>\n\n";



echo "<div class=\"menu_each\">\n";
echo " <a class=\"menuhead\" href=\"statistics.php?sub=s1\">" . $l_sta . "</a>\n";
if ($page == "stats") {
  echo " <a class=\"menu\" href=\"statistics.php?sub=s2\">&nbsp;&nbsp;" . $l_osy . "</a>\n";
  echo " <a class=\"menu\" href=\"statistics.php?sub=s3\">&nbsp;&nbsp;" . $l_ine . "</a>\n";
  echo " <a class=\"menu\" href=\"statistics.php?sub=s4\">&nbsp;&nbsp;" . $l_mem . "</a>\n";
  echo " <a class=\"menu\" href=\"statistics.php?sub=s5\">&nbsp;&nbsp;" . $l_pro . "</a>\n";
} else {}
echo "</div>\n\n";


echo "<div class=\"menu_each\">\n";
echo " <a class=\"menuhead\" href=\"other_list.php?id=1\">" . $l_oth . "</a>\n";
if ($page == "other") {
  echo " <a class=\"menu\" href=\"other_add.php?sub=d1\">&nbsp;&nbsp;" . $l_ado . "</a>\n";
  echo " <a class=\"menu\" href=\"other_delete.php?sub=d1\">&nbsp;&nbsp;" . $l_dot . "</a>\n";
  echo " <hr />\n";
  echo " <a class=\"menu\" href=\"other_list.php?id=2\">&nbsp;&nbsp;" . $l_nit . "</a>\n";
  echo " <a class=\"menu\" href=\"other_list.php?id=3\">&nbsp;&nbsp;" . $l_nni . "</a>\n";
  echo " <a class=\"menu\" href=\"list_printers.php\">&nbsp;&nbsp;" . $l_prn . "</a>\n";
  echo " <a class=\"menu\" href=\"list_monitors.php\">&nbsp;&nbsp;" . $l_mon . "</a>\n";
} else {}
echo "</div>\n\n";


echo "<div class=\"menu_each\">\n";
echo " <a class=\"menuhead\" href=\"group_list.php\">" . $l_grp . "</a>\n";
if ($page == "groups") {
  echo " <a class=\"menu\" href=\"group_list.php\">&nbsp;&nbsp;" . $l_lgp . "</a>\n";
  echo " <a class=\"menu\" href=\"group_add.php?sub=e1\">&nbsp;&nbsp;" . $l_agp . "</a>\n";
} else {} 
echo "</div>\n\n";


echo "<div class=\"menu_each\">\n";
echo " <a class=\"menuhead\" href=\"call_home.php\">IT Tickets</a>\n";
if ($page == "calls") {
  echo " <a class=\"menu\" href=\"call_home.php\">&nbsp;&nbsp;List All Open Tickets</a>\n";
} else {} 
echo "</div>\n\n";


if ($pc > "0") {

$sql = "SELECT system_uuid, system_timestamp, system_name, net_ip_address, net_domain FROM system WHERE system_uuid = '$pc' OR system_name = '$pc' ";
$result = mysql_query($sql, $db);
$myrow = mysql_fetch_array($result);
$timestamp = $myrow["system_timestamp"];
$pc = $myrow["system_uuid"];
$ip = $myrow["net_ip_address"];
$name = $myrow['system_name'];
$domain = $myrow['net_domain'];


  echo "<div class=\"menu_each\">\n";
  echo " <a class=\"menuhead\" href=\"system_summary.php?pc=" . $pc . "&amp;sub=all\">" . $name . "</a>\n";
  echo " <a class=\"menu\" href=\"system_hardware.php?pc=" . $pc . "&amp;sub=all\">&nbsp;&nbsp;&nbsp;" . $l_hwd . "</a>\n";
  if ($page == "hardware"){ 
    echo " <a class=\"menu_2\" href=\"system_hardware.php?pc=" . $pc . "&amp;sub=hd\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_hdd . "</a>\n";
    echo " <a class=\"menu_2\" href=\"system_hardware.php?pc=" . $pc . "&amp;sub=od\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_odd . "</a>\n";
    echo " <a class=\"menu_2\" href=\"system_hardware.php?pc=" . $pc . "&amp;sub=fd\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_fdd . "</a>\n";
    echo " <a class=\"menu_2\" href=\"system_hardware.php?pc=" . $pc . "&amp;sub=td\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_tdv . "</a>\n";
    echo " <a class=\"menu_2\" href=\"system_hardware.php?pc=" . $pc . "&amp;sub=pb\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_pab . "</a>\n";
    echo " <a class=\"menu_2\" href=\"system_hardware.php?pc=" . $pc . "&amp;sub=me\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_mem . "</a>\n";
    echo " <a class=\"menu_2\" href=\"system_hardware.php?pc=" . $pc . "&amp;sub=na\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_nwa . "</a>\n";
    echo " <a class=\"menu_2\" href=\"system_hardware.php?pc=" . $pc . "&amp;sub=vm\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_vam . "</a>\n";
    echo " <a class=\"menu_2\" href=\"system_hardware.php?pc=" . $pc . "&amp;sub=so\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_snd . "</a>\n";
    echo " <a class=\"menu_2\" href=\"system_hardware.php?pc=" . $pc . "&amp;sub=km\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_kam . "</a>\n";
    echo " <a class=\"menu_2\" href=\"system_hardware.php?pc=" . $pc . "&amp;sub=mo\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_mod . "</a>\n";
    echo " <a class=\"menu_2\" href=\"system_hardware.php?pc=" . $pc . "&amp;sub=ba\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_bat . "</a>\n";
    echo " <a class=\"menu_2\" href=\"system_hardware.php?pc=" . $pc . "&amp;sub=us\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_usb . "</a>\n";
    echo " <a class=\"menu_2\" href=\"system_hardware.php?pc=" . $pc . "&amp;sub=pr\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_prn . "</a>\n";
  } else {}
  echo "<a class=\"menu\" href=\"system_software.php?pc=" . $pc . "&amp;sub=all\">&nbsp;&nbsp;&nbsp;" . $l_swf . "</a>\n";
  if ($page == "software"){ 
    echo " <a class=\"menu_2\" href=\"system_software.php?pc=" . $pc . "&amp;sub=is\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_isw . "</a>\n";
    echo " <a class=\"menu_2\" href=\"system_software.php?pc=" . $pc . "&amp;sub=ph\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_pah . "</a>\n";
    echo " <a class=\"menu_2\" href=\"system_software.php?pc=" . $pc . "&amp;sub=rs\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_ras . "</a>\n";
    echo " <a class=\"menu_2\" href=\"system_software_audit.php?pc=" . $pc . "&amp;sub=au\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_aui . "</a>\n";
    echo " <a class=\"menu_2\" href=\"system_software_keys.php?pc=" . $pc . "\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_cdk . "</a>\n";
    echo " <a class=\"menu_2\" href=\"system_software_bho.php?pc=" . $pc . "&amp;sub=bh\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_ieb . "</a>\n";
    echo " <a class=\"menu_2\" href=\"system_software_codecs.php?pc=" . $pc . "\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_cod . "</a>\n";
  } else {}
  echo " <a class=\"menu\" href=\"system_os.php?pc=" . $pc . "\">&nbsp;&nbsp;&nbsp;" . $l_oss . "</a>\n";
  if ($page == "os"){ 
    echo " <a class=\"menu_2\" href=\"system_os.php?pc=" . $pc . "&amp;sub=su\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_sum . "</a>\n";
    echo " <a class=\"menu_2\" href=\"system_os.php?pc=" . $pc . "&amp;sub=os\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_osi . "</a>\n";
    echo " <a class=\"menu_2\" href=\"system_os.php?pc=" . $pc . "&amp;sub=ne\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_nws . "</a>\n";
    echo " <a class=\"menu_2\" href=\"system_os.php?pc=" . $pc . "&amp;sub=sh\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_shd . "</a>\n";
  } else {}
  echo " <a class=\"menu\" href=\"system_manual.php?pc=" . $pc . "&amp;sub=all\">&nbsp;&nbsp;&nbsp;" . $l_man . "</a>\n";
  echo " <a class=\"menu\" href=\"system_security.php?pc=" . $pc . "&amp;sub=all\">&nbsp;&nbsp;&nbsp;" . $l_sec . "</a>\n";
  echo " <a class=\"menu\" href=\"system_patches.php?pc=" . $pc . "&amp;sub=all\">&nbsp;&nbsp;&nbsp;" . $l_hfn . "</a>\n";
  echo " <a class=\"menu\" href=\"system_services.php?pc=" . $pc . "&amp;sub=all\">&nbsp;&nbsp;&nbsp;" . $l_ser . "</a>\n";
  echo " <a class=\"menu\" href=\"system_users.php?pc=" . $pc . "&amp;sub=all\">&nbsp;&nbsp;&nbsp;" . $l_uag . "</a>\n";
  if ($page == "us"){ 
    echo " <a class=\"menu_2\" href=\"system_users.php?pc=" . $pc . "&amp;sub=us\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_usr . "</a>\n";
    echo " <a class=\"menu_2\" href=\"system_users.php?pc=" . $pc . "&amp;sub=gr\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $l_grp . "</a>\n";
  } else {}
  echo " <a class=\"menu\" href=\"system_notes.php?pc=" . $pc . "&amp;sub=all\">&nbsp;&nbsp;&nbsp;" . $l_nts . "</a>\n";
  echo " <a class=\"menu\" href=\"system_passwords.php?pc=" . $pc . "&amp;sub=all\">&nbsp;&nbsp;&nbsp;" . $l_psw . "</a>\n";
  echo " <a class=\"menu\" href=\"system_iis.php?pc=" . $pc . "&amp;sub=all\">&nbsp;&nbsp;&nbsp;" . $l_iis . "</a>\n";
  echo " <a class=\"menu\" href=\"system_graphs.php?pc=" . $pc . "&amp;sub=all\">&nbsp;&nbsp;&nbsp;" . $l_dug . "</a>\n";
  echo " <a class=\"menu\" href=\"system_actions.php?pc=" . $pc . "&amp;sub=all\">&nbsp;&nbsp;&nbsp;" . $l_act . "</a>\n";
  echo " <a class=\"menu\" href=\"system_audits.php?pc=" . $pc . "\">&nbsp;&nbsp;&nbsp;System Audits</a>\n";
  echo " <a class=\"menu\" href=\"system_report.php?pc=" . $pc . "\">&nbsp;&nbsp;&nbsp;Report</a>\n";
  echo "</div>\n";
} else {}

echo "</div><!-- End of menu_container -->\n\n";
?>