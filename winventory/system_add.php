<?php 
$page = "us";
include "include.php"; 
?>
<div id="content">
<p class="contenthead">Add System.</p>
<table>
<form action="system_add_2.php" method="POST">
  <tr><td>Host Name:  </td><td><input type="text" name="name" size="20" value = "<?PHP print gethostbyaddr($_SERVER['REMOTE_ADDR']);?>"></td></tr>
  <tr><td>IP Address:  </td><td><input type="text" name="ip" size="20" value ="<?PHP print $_SERVER['REMOTE_ADDR'];?>"></td></tr>
  <tr><td>MAC Address:  </td><td><input type="text" name="mac_address" size="20"></td></tr>
  <tr><td>OS:  </td><td><select size="1" name="OS">
    <option value="Microsoft Windows 98">Microsoft Windows 98</option>
    <option value="Microsoft Windows 98 SE">Microsoft Windows 98 SE</option>
    <option value="Microsoft Windows 95">Microsoft Windows 95</option>
    <option value="Microsoft Windows NT">Microsoft Windows NT Workstation</option>
    <option value="Microsoft Windows NT Server">Microsoft Windows NT Server</option>
    <option value="Mac OS X">Mac OS X</option>
    <option value="Mac OS 9">Mac OS 9</option>
    <option value="Mac OS Other">Mac OS Other</option>
    <option value="Linux">Linux</option>
   <option value="Unix">Unix</option>
  </select></td></tr>
  <tr><td>Asset Tag:  </td><td><input type="text" name="asset_tag" size="20"></td></tr>
  <tr><td>Primary Owner:  </td><td><input type="text" name="owner" size="20"></td></tr>
  <tr><td>Physical Location:  </td><td><input type="text" name="location" size="20"></td></tr>
  <tr><td>Date Audited: </td><td><input type="text" name="date" size="20" value="<?PHP print date("Y-m-d");?>"></td></tr>
  <tr><td>PC/Laptop: </td><td>
  <tr><td width="35%"></td>
      <td width="50%"><INPUT TYPE=radio NAME="system_flag" VALUE="NULL" checked >PC
                      <INPUT TYPE=radio NAME="system_flag" VALUE="Internal Battery" >Laptop</td></tr>
  <tr><td>Additional Notes:</td><td></tr>
  <tr><td colspan=2><textarea rows="4" name="description" cols="60"></textarea></td></tr>
  <tr><td><input type="submit" value="Add System" name="submit"></td></tr>

</form>
</table>
</div>
</body>
</html> 