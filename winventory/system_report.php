<?php

if ($_GET['pc']){$pc = $_GET['pc'];} else {}
include "include_config.php";
include "include_functions.php";

$db = mysql_connect($mysql_server,$mysql_user,$mysql_password) or die('Could not connect: ' . mysql_error());
mysql_select_db($mysql_database,$db);

?>
<html>
<head>
<title>Windows Inventory - Report</title>
<style type="text/css">
body {
 font-family: verdana;
 font-size: 9pt;
}
h1,h2 {
 font-family: Trebuchet MS;
}
.content {
 position: relative;
 width: 600px;
 min-width: 700px;
 margin: 0 0px 10px 0px;
 border: 1px solid black;
 background-color: white;
 padding: 10px;
 z-index: 3;
 font-family: verdana;
 font-size: 9pt;
}
</style>
</head>
<body>
<?php
$sql = "SELECT * FROM system WHERE system_uuid = '$pc' OR system_name = '$pc'";
$result = mysql_query($sql, $db);
$myrow = mysql_fetch_array($result);
$pc = $myrow['system_uuid'];

$sql2 = "SELECT * FROM network_card WHERE net_uuid = '$pc' AND net_timestamp = '" . $myrow["system_timestamp"] . "'";
$result2 = mysql_query($sql2, $db);
$myrow2 = mysql_fetch_array($result2);

$sql3 = "SELECT * FROM bios WHERE bios_uuid = '$pc' AND bios_timestamp = '" . $myrow["system_timestamp"] . "'";
$result3 = mysql_query($sql3, $db);
$bios = mysql_fetch_array($result3);

$sql4 = "SELECT * FROM processor WHERE processor_uuid = '$pc' AND processor_timestamp = '" . $myrow["system_timestamp"] . "'";
$result4 = mysql_query($sql4, $db);

$sql5 = "SELECT * FROM video WHERE video_uuid = '$pc' AND video_timestamp = '" . $myrow["system_timestamp"] . "'";
$result5 = mysql_query($sql5, $db);

$sql6 = "SELECT * FROM monitor WHERE monitor_uuid = '$pc' AND monitor_timestamp = '" . $myrow["system_timestamp"] . "'";
$result6 = mysql_query($sql6, $db);

$sql7 = "SELECT * FROM hard_drive WHERE hard_drive_uuid = '$pc' AND hard_drive_timestamp = '" . $myrow["system_timestamp"] . "'";
$result7 = mysql_query($sql7, $db);

$sql8 = "SELECT * FROM optical_drive WHERE optical_drive_uuid = '$pc' AND optical_drive_timestamp = '" . $myrow["system_timestamp"] . "'";
$result8 = mysql_query($sql8, $db);

$sql9 = "SELECT * FROM keyboard WHERE keyboard_uuid = '$pc' AND keyboard_timestamp = '" . $myrow["system_timestamp"] . "'";
$result9 = mysql_query($sql9, $db);
$keyboard = mysql_fetch_array($result9);

$sql10 = "SELECT * FROM mouse WHERE mouse_uuid = '$pc' AND mouse_timestamp = '" . $myrow["system_timestamp"] . "'";
$result10 = mysql_query($sql10, $db);
$mouse = mysql_fetch_array($result10);

$sql11 = "SELECT * FROM sound WHERE sound_uuid = '$pc' AND sound_timestamp = '" . $myrow["system_timestamp"] . "'";
$result11 = mysql_query($sql11, $db);
$sound = mysql_fetch_array($result11);

?>
<h1>Report for <?php echo $myrow['system_name']; ?></h1>

<div id="content">
<table border="0" cellpadding="2" cellspacing="0" class="content">
<tr><td colspan="2"><b>System Information</b></td></tr>
<tr bgcolor="#F1F1F1"><td width="250">User Name: </td><td><?php echo $myrow['net_user_name']; ?></td></tr>
<tr><td>Date Audited: </td><td><?php echo return_date_time($myrow['system_timestamp']); ?></td></tr>
<tr bgcolor="#F1F1F1"><td>Time Zone: </td><td><?php echo $myrow['time_caption']; ?></td></tr>
<tr><td width="250">Registered Owner: </td><td><?php echo $myrow['system_primary_owner_name']; ?></td></tr>
<tr bgcolor="#F1F1F1"><td>UUID: </td><td><?php echo $myrow['system_uuid']; ?></td></tr>
<tr><td>Model: </td><td><?php echo $myrow['system_model']; ?></td></tr>
<tr bgcolor="#F1F1F1"><td>Serial: </td><td><?php echo $myrow['system_id_number']; ?></td></tr>
<tr><td>Manufacturer: </td><td><?php echo $myrow['system_vendor']; ?></td></tr>
<tr bgcolor="#F1F1F1"><td>Chassis: </td><td><?php echo $myrow['system_system_type']; ?></td></tr>
</table></div>
<br />

<div id="content">
<table border="0" cellpadding="2" cellspacing="0" class="content">
<tr><td colspan="2"><b>Windows Information</b></td></tr>
<tr><td width="250">OS Name: </td><td><?php echo $myrow['system_os_name']; ?></td></tr>
<tr bgcolor="#F1F1F1"><td>OS Install Date: </td><td><?php echo $myrow['date_system_install']; ?></td></tr>
<tr><td>Registered User: </td><td><?php echo $myrow['system_registered_user']; ?></td></tr>
<tr bgcolor="#F1F1F1"><td>Registered Organisation: </td><td><?php echo $myrow['system_organisation']; ?></td></tr>
<tr><td>Country: </td><td><?php echo $myrow['system_country_code']; ?></td></tr>
<tr bgcolor="#F1F1F1"><td>Language: </td><td><?php echo $myrow['system_language']; ?></td></tr>
<tr><td>Serial Number: </td><td><?php echo $myrow['system_serial_number']; ?></td></tr>
<tr bgcolor="#F1F1F1"><td>Service Pack: </td><td><?php echo $myrow['system_service_pack']; ?></td></tr>
<tr><td>Windows Directory: </td><td><?php echo $myrow['system_windows_directory']; ?></td></tr>
</table></div>
<br />

<div id="content">
<table border="0" cellpadding="2" cellspacing="0" class="content">
<tr><td colspan="2"><b>Network Information</b></td></tr>
<tr><td width="250">System Name: </td><td><?php echo $myrow['system_name']; ?></td></tr>
<tr bgcolor="#F1F1F1"><td>Description: </td><td><?php echo $myrow['system_description']; ?></td></tr>
<tr><td>MAC Address: </td><td><?php echo $myrow2['net_mac_address']; ?></td></tr>
<tr bgcolor="#F1F1F1"><td>IP Address: </td><td><?php echo $myrow['net_ip_address']; ?></td></tr>
<tr><td>Subnet: </td><td><?php echo $myrow2['net_ip_subnet']; ?></td></tr>
<tr bgcolor="#F1F1F1"><td>DHCP Enabled: </td><td><?php echo $myrow2['net_dhcp_enabled']; ?></td></tr>
<tr><td>DHCP Server: </td><td><?php echo $myrow2['net_dhcp_server']; ?></td></tr>
<tr bgcolor="#F1F1F1"><td>WINS Server: </td><td><?php echo $myrow2['net_wins_primary']; ?></td></tr>
<tr><td>DNS Server: </td><td><?php echo $myrow2['net_dns_server']; ?></td></tr>
<tr bgcolor="#F1F1F1"><td>NIC Manufacturer: </td><td><?php echo $myrow2['net_manufacturer']; ?></td></tr>
<tr><td>Description: </td><td><?php echo $myrow2['net_description']; ?></td></tr>
<tr bgcolor="#F1F1F1"><td>Part of Domain: </td><td>True</td></tr>
<tr><td>Domain Role: </td><td><?php echo $myrow['net_domain_role']; ?></td></tr>
<tr bgcolor="#F1F1F1"><td>Domain: </td><td><?php echo $myrow['net_domain']; ?></td></tr>
<tr><td>Domain Site Name: </td><td><?php echo $myrow['net_client_site_name']; ?></td></tr>
<tr bgcolor="#F1F1F1"><td>Domain Controller Name: </td><td><?php echo $myrow['net_domain_controller_name']; ?></td></tr>
</table>
</div>

<br style="page-break-before:always;" />

<div id="content">
<table border="0" cellpadding="2" cellspacing="0" class="content">
<tr><td colspan="2"><b>Hardware</b></td></tr>
<tr><td width="250">BIOS Manufacturer: </td><td><?php echo $bios['bios_manufacturer']; ?></td></tr>
<tr bgcolor="#F1F1F1"><td>BIOS Version: </td><td><?php echo $bios['bios_version']; ?></td></tr>
<?
if (($processor = mysql_fetch_array($result4))){
  do { 
    echo "<tr><td width=\"250\">Processor: </td><td>" . $processor['processor_name'] . "</td></tr>";
    echo "<tr bgcolor=\"#F1F1F1\"><td>Processor Speed: </td><td>" . number_format($processor['processor_max_clock_speed']) . " Mhz</td></tr>";
  } while ($processor = mysql_fetch_array($result4));
} else {}
echo "<tr><td>Total Memory: </td><td>" . number_format($myrow['system_memory']) . " MB</td></tr>";
if (($video = mysql_fetch_array($result5))){
  do { 
    echo "<tr bgcolor=\"#F1F1F1\"><td>Video Card &amp; Memory: </td><td>" . $video['video_caption'] . " - " . $video['video_adapter_ram'] . " MB</td></tr>";
    echo "<tr><td>Video Driver Date &amp; Version: </td><td>" . $video['video_driver_date'] . " - " . $video['video_driver_version'] . "</td></tr>";
  } while ($video = mysql_fetch_array($result5));
} else {}
if (($monitor = mysql_fetch_array($result6))){
  do { 
    echo "<tr bgcolor=\"#F1F1F1\"><td>Monitor Manufacturer: </td><td>" . $monitor['monitor_manufacturer'] . "</td></tr>";
    echo "<tr><td>Monitor Model: </td><td>" . $monitor['monitor_model'] . "</td></tr>";
  } while ($monitor = mysql_fetch_array($result6));
} else {}
if (($hard_drive = mysql_fetch_array($result7))){
  do { 
    echo "<tr bgcolor=\"#F1F1F1\"><td>Hard Drive Type &amp; Model: </td><td>" . $hard_drive['hard_drive_interface_type'] . " - " . $hard_drive['hard_drive_model'] . "</td></tr>";
    echo "<tr><td>Hard Drive Size &amp Partitions: </td><td>" . number_format($hard_drive['hard_drive_size']) . " MB - " . $hard_drive['hard_drive_partitions'] . "</td></tr>";
    $sql_partition = "SELECT * FROM partition WHERE (partition_uuid = '$pc' && partition_timestamp = '" . $myrow['system_timestamp'] . "' && partition_disk_index = '" . $hard_drive["hard_drive_index"] . "') ORDER BY partition_caption ";
	$sql_partition_result = mysql_query($sql_partition, $db);
	if ($partition = mysql_fetch_array($sql_partition_result)){ 
	  do {
        echo "<tr bgcolor=\"#F1F1F1\"><td>Partition Drive Letter &amp; Format: </td><td>" . $partition['partition_caption'] . " - " . $partition['partition_file_system'] . "</td></tr>";
        echo "<tr><td>Partition Size &amp; Free Space: </td><td>" . number_format($partition['partition_size']) . " MB - ". number_format($partition['partition_free_space']) . " MB</td></tr>";
      } while ($partition = mysql_fetch_array($sql_partition_result));
    } else {}
  } while ($hard_drive = mysql_fetch_array($result7));
} else {}
if (($optical_drive = mysql_fetch_array($result8))){
  do {
    echo "<tr bgcolor=\"#F1F1F1\"><td>Optical Drive: </td><td>" . $optical_drive['optical_drive_drive'] . "</td></tr>";
    echo "<tr><td>Optical Drive Caption: </td><td>" . $optical_drive['optical_drive_caption'] . "</td></tr>";
  } while ($optical_drive = mysql_fetch_array($result8));
} else {}
echo "<tr bgcolor=\"#F1F1F1\"><td>Keyboard Description: </td><td>" . $keyboard['keyboard_caption'] . "</td></tr>";
echo "<tr><td>Mouse Description: </td><td>" . $mouse['mouse_description'] . "</td></tr>";
echo "<tr bgcolor=\"#F1F1F1\"><td>Sound Card: </td><td>" . $sound['sound_name'] . "</td></tr>";
?>

<br />
<br />


</table>
</div>
