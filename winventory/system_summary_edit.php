<?php 
$page = "su";
include "include.php"; 

$SQL = "SELECT MIN(system_timestamp) FROM system WHERE system_uuid = '" . $mac . "'";
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
  do {
      $first_audited = $myrow["MIN(system_timestamp)"];
  } while ($myrow = mysql_fetch_array($result));
} else {}
?>


<div class="main_each"> 
  <p class="contenthead">System Summary for <?php echo $myrow["net_ip_address"] . " - " . $myrow["system_name"]; ?></p>


  <p>

  <?php
	$SQL = "SELECT * FROM network_card WHERE net_uuid = '$pc' AND net_timestamp = '$timestamp'";
	$result = mysql_query($SQL, $db);
	if ($myrow = mysql_fetch_array($result)){
	do {
		$subnet = $myrow["net_ip_subnet"];
		$dhcp_enabled = $myrow["net_dhcp_enabled"];
		$dhcp_server = $myrow["net_dhcp_server"];
	} while ($myrow = mysql_fetch_array($result));
	} else {}
	

	$SQL = "SELECT * FROM system WHERE system_uuid = '$pc' AND system_timestamp = '$timestamp'";
	$result = mysql_query($SQL, $db);
	if ($myrow = mysql_fetch_array($result)){

	echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";

	do {
	?>
		<tr><td colspan=2 class="menuhead"><img src="images/inv_summary<?php echo $pic_style; ?>.png" width=64 height=64>Summary</td></tr>
		<tr><td width=200>Machine Name:&nbsp;</td><td><?php echo $myrow["system_name"]; ?></td></tr>
		<tr><td>Description:&nbsp;</td><td><?php echo $myrow["system_description"]; ?></td></tr>
		<tr><td>Registered User:&nbsp;</td><td><?php echo $myrow["system_registered_user"]; ?></td></tr>
		<tr><td>Operating System:&nbsp;</td><td><?php echo $myrow["system_os_name"]; ?></td></tr>
		<tr><td>Windows Installed On:&nbsp;</td><td><?php echo $myrow["date_system_install"]; ?></td></tr>
		<tr><td>IP Address / Subnet:&nbsp;</td><td><?php echo $myrow["net_ip_address"] . " / " . $subnet; ?></td></tr>
		<tr><td>DHCP Enabled / DCHP Server:&nbsp;</td><td><?php echo $dhcp_enabled . " / " . $dhcp_server; ?></td></tr>
		<tr><td>System Memory:&nbsp;</td><td><?php echo $myrow["system_memory"]; ?>&nbsp;MB</td></tr>
		<tr><td>Date Audited:&nbsp;</td><td><?php echo return_date_time($first_audited); ?>&nbsp;&nbsp;</td></tr>
	<?php
	} while ($myrow = mysql_fetch_array($result));
	} else {}


	$SQL = "SELECT * FROM hard_drive WHERE hard_drive_uuid = '$pc' AND hard_drive_timestamp = '$timestamp' ORDER BY hard_drive_index";
	$result = mysql_query($SQL, $db);
	if ($myrow = mysql_fetch_array($result)){
	do {
	?>
		<tr><td>Hard Drive Size:&nbsp;</td><td><?php echo $myrow["hard_drive_size"]; ?> Gb</td></tr>
	<?php
	} while ($myrow = mysql_fetch_array($result));
	} else {}


	$SQL = "SELECT * FROM processor WHERE processor_uuid = '$pc' AND processor_timestamp = '$timestamp' ORDER BY processor_id";
	$result = mysql_query($SQL, $db);
	if ($myrow = mysql_fetch_array($result)){
	do {
	?>
		<tr><td>Description:&nbsp;</td><td><?php echo $myrow["processor_name"]; ?></td></tr>
	<?php
	} while ($myrow = mysql_fetch_array($result));
	} else {}



	$SQL = "SELECT * FROM system_man WHERE system_man_uuid = '$pc'";
	$result = mysql_query($SQL, $db);
	if ($myrow = mysql_fetch_array($result)){
	do {
	$s_m_l = $myrow['system_man_location'];
	$s_m_d_o_p = $myrow['system_man_date_of_purchase'];
	$s_m_v = $myrow['system_man_value'];
	$s_m_s_n = $myrow['system_man_serial_number'];
	$s_m_d = ereg_replace( "\n", "<br>", $myrow['system_man_description'] );
	} while ($myrow = mysql_fetch_array($result));
	} else {
	$s_m_l = "";
	$s_m_d_o_p = "";
	$s_m_v = "";
	$s_m_s_n = "";
	$s_m_d = "";
	}
	?>
	<form action="system_summary_edit_2.php?sub=no&other=<?php echo $_GET['pc']; ?>" method="POST">
	<tr><td>Physical Location:&nbsp;</td><td><input type="text" name="location" size="20" value="<?php echo $s_m_l; ?>" class="content"></td></tr>
	<tr><td>Date of Purchase:&nbsp;</td><td><input type="text" name="date" size="20" value="<?php echo $s_m_d_o_p; ?>" class="content">(yyyy-mm-dd)</td></tr>
	<tr><td>Dollar Value:&nbsp;</td><td><input type="text" name="dollar" size="20" value="<?php echo $s_m_v; ?>" class="content"></td></tr>
	<tr><td>Serial Number:&nbsp;</td><td><input type="text" name="serial" size="20" value="<?php echo $s_m_s_n; ?>" class="content"></td></tr>
	<tr><td colspan=2 valign="top">Description:<br><textarea rows="4" name="description" cols="60" class="content"><?php echo $s_m_d; ?></textarea></td></tr>
	<tr><td><input name="Submit" value=" Submit" type="Submit" class="content"></td></tr>
	<input type="hidden" value="<?php echo $pc; ?>" name="pc">
	</form>

	</table>
</div>
</body>
</html> 
<?php
include "include_png_replace.php";
?>