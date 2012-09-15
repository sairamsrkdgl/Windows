<?php 
$page = "other";
include "include.php";
echo "<div class=\"main_each\">";
?>
 
<p class="contenthead">Add Other Equipment.</p>
<form action="other_add_2.php?sub=no" method="post">
<table border="0" cellpadding="0" cellspacing="0" width="700" class="content">
  <tr><td>Name:  </td><td><input type="text" name="name" size="20" /></td></tr>
  <tr><td>IP Address:  </td><td><input type="text" name="ip" size="20" /></td></tr>
  <tr><td>MAC Address:  </td><td><input type="text" name="mac_address" size="20" /></td></tr>
  <tr><td>Manufacturer:  </td><td><input type="text" name="manufacturer" size="20" /></td></tr>
  <tr><td>Model Number:  </td><td><input type="text" name="model" size="20" /></td></tr>
  <tr><td>Serial Number:  </td><td><input type="text" name="serial" size="20" /></td></tr>
  <tr><td>Physical Location:  </td><td><input type="text" name="location" size="20" /></td></tr>
  <tr><td>Date of Purchase:  (yyyy-mm-dd)</td><td><input type="text" name="date" size="20" /></td></tr>
  <tr><td>Dollar Value:  </td><td>$<input type="text" name="value" size="20" /></td></tr>
  <tr><td>Type:  </td><td><select size="1" name="type">
      <option value="BBS">BBS</option>
      <option value="bridge">Bridge</option>
      <option value="broadband router">Broadband Router</option>
      <option value="camera">Camera</option>
      <option value="console">Console</option>
      <option value="CSUDSU">CSUDSU</option>
      <option value="game console">Game Console</option>
      <option value="encryption accelerator">Encryption Accelerator</option>
      <option value="fax">fax</option>
      <option value="fileserver">FileServer</option>
      <option value="firewall">Firewall</option>
      <option value="general purpose">General Purpose</option>
      <option value="hub">Hub</option>
      <option value="load balancer">Load Balancer</option>
      <option value="media device">Media Device</option>
      <option value="modem">Modem</option>
      <option value="monitor">Monitor</option>
      <option value="PBX">PBX</option>
      <option value="PDA">PDA</option>
      <option value="phone">Phone</option>
      <option value="power-device">Power Device</option>
      <option value="print server">Print Server</option>
      <option value="printer">Printer</option>
      <option value="remote management">Remote Management</option>
      <option value="router">Router</option>
      <option value="scanner">Scanner</option>
      <option value="security-misc">Security Misc</option>
      <option value="specialized">Specialized</option>
      <option value="switch">Switch</option>
      <option value="storage-misc">Storage Misc</option>
      <option value="os_linux">System Linux</option>
      <option value="os_mac">System MAC</option>
      <option value="os_unix">System Unix</option>
      <option value="os_windows">System Windows</option>
      <option value="telecom-misc">Telecom Misc</option>
      <option value="terminal">Terminal</option>
      <option value="terminal server">Terminal Server</option>
      <option value="VoIP adapter">VoIP Adapter</option>
      <option value="VoIP phone">VoIP Phone</option>
      <option value="WAP">WAP</option>
      <option value="web proxy">Web Proxy</option>
      <option value="webcam">Web Camera</option>
      <option value="X terminal">X Terminal</option>
      <option value="zip drive">Zip Drive</option>
  </select></td></tr>
  <tr><td>Associate with System: </td><td><select size="1" name="linked_pc">
    <option value="none">None</option>
  <?php
  $SQL = "SELECT * FROM system";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    do {
	  echo "<option value=\"" . $myrow["net_mac_address"] . "\">" . $myrow["net_ip_address"] . "&nbsp;&nbsp;-&nbsp;&nbsp;" . $myrow["system_name"] . "</option>";
    } while ($myrow = mysql_fetch_array($result));
  } 
  else {
    echo "<div class=\"main_each\"><p class=\"contenthead\">No PCs have been WINventoried.</p></div>";
  }
  ?>
  </select></td></tr>
  <tr><td colspan="2"><textarea rows="4" name="description" cols="60"></textarea></td></tr>
  <tr><td><input name="Submit" value="Submit" type="submit" /></td></tr>
</table>
</form>
</div>
</body>
</html>


<?php
include "include_png_replace.php";
?>