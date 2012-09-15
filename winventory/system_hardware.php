<?php 
$page = "hardware";
include "include.php"; 


echo "<div class=\"main_each\">";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
echo "<tr><td class=\"contenthead\" colspan=\"2\">Hardware for " . $name . "<br />&nbsp;</td></tr>\n";

if (($sub == "hd") or ($sub == "all")){
  $SQL = "SELECT * FROM hard_drive WHERE hard_drive_uuid = '$pc' AND hard_drive_timestamp = '$timestamp' ORDER BY hard_drive_index";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
  do {
	echo "<tr><td class=\"contenthead\" colspan=\"2\"><img src=\"images/inv_harddrive" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />Fixed Disk #" . $myrow["hard_drive_index"] . "</td></tr>\n";
	echo "<tr><td>Manufacturer:&nbsp;</td><td>" . $myrow["hard_drive_manufacturer"] . "</td><td></td></tr>\n";
	echo "<tr bgcolor=\"$bg1\"><td>Type:&nbsp;</td><td>" . $myrow["hard_drive_interface_type"] . "</td></tr>\n";
	echo "<tr><td>Model:&nbsp;</td><td>" . $myrow["hard_drive_model"] . "</td></tr>\n";
	echo "<tr bgcolor=\"$bg1\"><td>Partitions:&nbsp;</td><td>" . $myrow["hard_drive_partitions"] . "</td></tr>\n";
	echo "<tr><td>Size:&nbsp;</td><td>" . number_format($myrow["hard_drive_size"]) . " MB</td></tr>\n";
    if ($myrow["hard_drive_interface_type"] == "SCSI") { 
      echo "<tr bgcolor=\"$bg1\"><td>SCSI Bus:&nbsp;</td><td>" . $myrow["hard_drive_scsi_bus"] . "</td></tr>\n";
      echo "<tr><td>SCSI Logical Unit:&nbsp;</td><td>" . $myrow["hard_drive_scsi_logical_unit"] . "</td></tr>";
      echo "<tr bgcolor=\"$bg1\"><td>SCSI Port:&nbsp;</td><td>" . $myrow["hard_drive_scsi_port"] . "</td></tr\n";
    } else {}
	$SQL2 = "SELECT * FROM partition WHERE (partition_uuid = '$pc' && partition_timestamp = '$timestamp' && partition_disk_index = '" . $myrow["hard_drive_index"] . "') ORDER BY partition_caption ";
	$result2 = mysql_query($SQL2, $db);
	if ($myrow2 = mysql_fetch_array($result2)){ 
	  do {
	    $used = $myrow2["partition_size"] - $myrow2["partition_free_space"];
        echo "<tr><td class=\"contenthead\"><img src=\"images/inv_partitions$pic_style.png\" width=\"64\" height=\"64\" alt=\"\" />" . $myrow2["partition_device_id"] . "</td></tr>\n";
        echo "<tr><td>Drive Letter:&nbsp;</td><td>" . $myrow2["partition_caption"] . "</td></tr>\n";
        echo "<tr bgcolor=\"$bg1\"><td>Name:&nbsp;</td><td>" . $myrow2["partition_volume_name"] . "</td></tr>\n";
        echo "<tr><td>Boot Partition:&nbsp;</td><td>" . $myrow2["partition_boot_partition"] . "</td></tr>\n";
        echo "<tr bgcolor=\"$bg1\"><td>Bootable:&nbsp;</td><td>" . $myrow2["partition_bootable"] . "</td></tr>\n";
        echo "<tr><td>Size:&nbsp;</td><td>" . number_format($myrow2["partition_size"]) . " MB</td></tr>";
        echo "<tr bgcolor=\"$bg1\"><td>FileSystem:&nbsp;</td><td>" . $myrow2["partition_file_system"] . "</td></tr>\n";
        echo "<tr><td>Used:&nbsp;</td><td>" . number_format($used) . " MB</td></tr>";
        echo "<tr bgcolor=\"$bg1\"><td>Free:&nbsp;</td><td>" . number_format($myrow2["partition_free_space"]) . " MB</td></tr>\n";
	  } while ($myrow2 = mysql_fetch_array($result2)); 
    } else {}
  } while ($myrow = mysql_fetch_array($result));
  } else { 
	echo "<tr><td class=\"contenthead\"><img src=\"images/inv_harddrive" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />No Hard Disks installed.</td></tr>\n";
  }
} else {}


if (($sub == "od") or ($sub == "all")){
  $opt_count = 0;
  $SQL = "SELECT * FROM optical_drive WHERE optical_drive_uuid = '$pc' AND optical_drive_timestamp = '$timestamp' ORDER BY optical_drive_drive";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    do {
      $opt_count = $opt_count + 1;
      echo "<tr><td colspan=\"2\" class=\"contenthead\"><img src=\"images/inv_cdrom" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />Optical Drive #$opt_count</td><td></td></tr>\n";
      echo "<tr><td width=\"200\">Drive Letter:</td><td>" . $myrow["optical_drive_drive"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Model:</td><td>" . $myrow['optical_drive_caption'] . "</td></tr>";
    } while ($myrow = mysql_fetch_array($result));
  } else {
    //echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
	//echo "<tr>";
    //echo "<td class=\"contenthead\"><img src=\"images/inv_tape" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />No Optical Drives installed.</td>"; 
	//echo "</tr>";
	//echo "</table>";
  }
} else {}


if (($sub == "fd") or ($sub == "all")){
  $opt_count = 0;
  $SQL = "SELECT * FROM floppy WHERE floppy_uuid = '$pc' AND floppy_timestamp = '$timestamp'";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    do {
      $opt_count = $opt_count + 1;
      echo "<tr><td colspan=\"2\" class=\"contenthead\"><img src=\"images/inv_floppy$pic_style.png\" width=\"64\" height=\"64\" alt=\"\" />Floppy Drive #$opt_count</td></tr>\n";
      echo "<tr><td>Caption:</td><td>" . $myrow["floppy_caption"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Description:</td><td>" . $myrow["floppy_description"] . "</td></tr>\n";
      echo "<tr><td>Manufacturer:</td><td>" . $myrow["floppy_manufacturer"] . "</td></tr>\n";
    } while ($myrow = mysql_fetch_array($result));
  } else {
    //echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
	//echo "<tr>";
    //echo "<td class=\"contenthead\"><img src=\"images/inv_floppy" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />No Floppy Drives installed.</td>"; 
	//echo "</tr>";
	//echo "</table>";
  }
} else {}


if (($sub == "td") or ($sub == "all")){
  $opt_count = 0;
  $SQL = "SELECT * FROM tape_drive WHERE tape_drive_uuid = '$pc' AND tape_drive_timestamp = '$timestamp' ORDER BY tape_drive_id";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
    do {
      $opt_count = $opt_count + 1;
      echo "<tr><td class=\"contenthead\"><img src=\"images/inv_tape$pic_style.png\" width=\"64\" height=\"64\" alt=\"\" />Tape Drive #$opt_count</td><td></td></tr>\n";
      echo "<tr><td>Manufacturer:</td><td>" . $myrow["tape_drive_manufacturer"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Caption:</td><td>" . $myrow["tape_drive_caption"] . "</td></tr>\n";
      echo "<tr><td>Description:</td><td>" . $myrow["tape_drive_description"] . "</td></tr>\n";
    } while ($myrow = mysql_fetch_array($result));
  } else {
    //echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
	//echo "<tr>";
    //echo "<td class=\"contenthead\"><img src=\"images/inv_tape" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />No Tape Drives installed.</td>"; 
	//echo "</tr>";
	//echo "</table>";
  }
} else {}


if (($sub == "pb") or ($sub == "all")){
  $opt_count = 0;
  $SQL = "SELECT * FROM processor WHERE processor_uuid = '$pc' AND processor_timestamp = '$timestamp' ORDER BY processor_id";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    do {
      $opt_count = $opt_count + 1;
      echo "<tr><td class=\"contenthead\" colspan=\"2\"><img src=\"images/inv_processor$pic_style.png\" width=\"64\" height=\"64\" alt=\"\" />Processor #$opt_count</td><td></td></tr>\n";
      echo "<tr><td>Manufacturer:</td><td>" . $myrow["processor_manufacturer"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Type:</td><td>" . $myrow["processor_caption"] . "</td></tr>\n";
      echo "<tr><td>Description:</td><td>" . $myrow["processor_name"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Max Speed:</td><td>" . $myrow["processor_max_clock_speed"] . "</td></tr>\n";
      echo "<tr><td>Socket Designation:</td><td>" . $myrow["processor_socket_designation"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Current Speed:</td><td>" . $myrow["processor_current_clock_speed"] . "</td></tr>\n";
      echo "<tr><td>External Clock:</td><td>" . $myrow["processor_ext_clock"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Current Voltage:</td><td>" . $myrow["processor_current_voltage"] . "</td></tr>\n";
    } while ($myrow = mysql_fetch_array($result));
	$SQL = "SELECT * FROM bios WHERE bios_uuid = '$pc' AND bios_timestamp = '$timestamp'";
	$result = mysql_query($SQL, $db);
	if ($myrow = mysql_fetch_array($result)){
      do {
        echo "<tr><td class=\"contenthead\" colspan=\"2\"><img src=\"images/inv_bios$pic_style.png\" width=\"64\" height=\"64\" alt=\"\" />Bios</td><td></td></tr>\n";
        echo "<tr><td>Description:</td><td>" . $myrow["bios_description"] . "</td></tr>\n";
        echo "<tr bgcolor=\"$bg1\"><td>Manufacturer:</td><td>" . $myrow["bios_manufacturer"] . "</td></tr>\n";
        echo "<tr><td>Serial:</td><td>" . $myrow["bios_serial_number"] . "</td></tr>\n";
        echo "<tr bgcolor=\"$bg1\"><td>Version:</td><td>" . $myrow["bios_version"] . "</td></tr>\n";
        echo "<tr><td>SM Version:</td><td>" . $myrow["bios_sm_bios_version"] . "</td></tr>\n";
        echo "<tr bgcolor=\"$bg1\"><td>Asset Tag:</td><td>" . $myrow["bios_asset_tag"] . "</td></tr>\n";
      } while ($myrow = mysql_fetch_array($result));
    } else {}
  } else {
    //echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
	//echo "<tr>";
    //echo "<td class=\"contenthead\"><img src=\"images/inv_processor" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />No Processor installed.</td>"; 
	//echo "</tr>";
	//echo "</table>";
  }
} else {}

if (($sub == "me") or ($sub == "all")){
  $opt_count = 0;
  $SQL = "SELECT * FROM memory WHERE memory_uuid = '$pc' AND memory_timestamp = '$timestamp' ORDER BY memory_id";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    do {
      $opt_count = $opt_count + 1;
      echo "<tr><td class=\"contenthead\" colspan=\"2\"><img src=\"images/inv_processor$pic_style.png\" width=\"64\" height=\"64\" alt=\"\" />Memory Module #$opt_count</td><td></td></tr>\n";
      echo "<tr><td>Memory Location:</td><td>" . $myrow["memory_bank"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Form Factor:</td><td>" . $myrow["memory_form_factor"] . "</td></tr>\n";
      echo "<tr><td>Type:</td><td>" . $myrow["memory_type"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Type Detail:</td><td>" . $myrow["memory_detail"] . "</td></tr>\n";
      echo "<tr><td>Speed:</td><td>" . $myrow["memory_speed"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Capacity:</td><td>" . $myrow["memory_capacity"] . "</td></tr>\n";
    } while ($myrow = mysql_fetch_array($result));
  }
} else {}

if (($sub == "na") or ($sub == "all")){
  $opt_count = 0;
  $SQL = "SELECT * FROM network_card WHERE net_uuid = '$pc' AND net_timestamp = '$timestamp'";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    do {
    $opt_count = $opt_count + 1;
    echo "<tr><td class=\"contenthead\" colspan=\"2\"><img src=\"images/inv_network$pic_style.png\" width=\"64\" height=\"64\" alt=\"\" />Network Adapter #$opt_count</td></tr>\n";
    echo "<tr><td>Type:</td><td>" . $myrow["net_adapter_type"] . "</td></tr>\n";
    echo "<tr bgcolor=\"$bg1\"><td>Description:</td><td>" . $myrow["net_description"] . "</td></tr>\n";
    echo "<tr><td>Manufacturer:</td><td>" . $myrow["net_manufacturer"] . "</td></tr>\n";
    echo "<tr bgcolor=\"$bg1\"><td>MAC Address:</td><td>" . $myrow["net_mac_address"] . "</td></tr>\n";
    } while ($myrow = mysql_fetch_array($result));
  } else {
    //echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
	//echo "<tr>";
    //echo "<td class=\"contenthead\"><img src=\"images/inv_network" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />No Network Adapters installed.</td>"; 
	//echo "</tr>";
	//echo "</table>";
  }	
} else {}


if (($sub == "vm") or ($sub == "all")){
  $opt_count = 0;
  $SQL = "SELECT * FROM video WHERE video_uuid = '$pc' AND video_timestamp = '$timestamp'";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    do {
      $opt_count = $opt_count + 1;
      $col_depth = "";
      if ($myrow["video_current_number_colours"] == "256") { $col_depth = "8 bit"; } else {}
      if ($myrow["video_current_number_colours"] == "65536") { $col_depth = "16 bit"; } else {}
      if ($myrow["video_current_number_colours"] == "16777216") { $col_depth = "24 bit"; } else {}
      if ($myrow["video_current_number_colours"] == "4294967296") { $col_depth = "32 bit"; } else {}
      echo "<tr><td class=\"contenthead\" colspan=\"2\"><img src=\"images/inv_video$pic_style.png\" width=\"64\" height=\"64\" alt=\"\" />Video Adapter #$opt_count</td></tr>\n";
      echo "<tr><td>Description:</td><td>" . $myrow["video_caption"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Memory:</td><td>" . $myrow["video_adapter_ram"] . " MB</td></tr>\n";
      echo "<tr><td>Current Resolution:</td><td>" . return_unknown($myrow["video_current_horizontal_res"]) . " x " . return_unknown($myrow["video_current_vertical_res"]) . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Current Colour Depth:</td><td>" . return_unknown($col_depth) . "</td></tr>\n";
      echo "<tr><td>Refresh Rate:</td><td>" . return_unknown($myrow["video_current_refresh_rate"]) . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Driver Version:</td><td>" . $myrow["video_driver_version"] . "</td></tr>\n";
      echo "<tr><td>Driver Date:</td><td>" . $myrow["video_driver_date"] . "</td></tr>\n";
    } while ($myrow = mysql_fetch_array($result));
  } else {
    //echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
	//echo "<tr>";
    //echo "<td class=\"contenthead\"><img src=\"images/inv_video$pic_style.png\" width=\"64\" height=\"64\" alt=\"\" />No Video Adapter installed.</td>"; 
	//echo "</tr>";
	//echo "</table>";
  }
  $SQL = "SELECT * FROM monitor WHERE monitor_uuid = '$pc' AND monitor_timestamp = '$timestamp'";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    do {
      echo "<tr><td class=\"contenthead\" colspan=\"2\"><img src=\"images/inv_monitor$pic_style.png\" width=\"64\" height=\"64\" alt=\"\" />Monitor</td></tr>\n";
      echo "<tr><td>Monitor Manufacturer:</td><td>" . $myrow["monitor_manufacturer"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Monitor Model:</td><td>" . $myrow["monitor_model"] . "</td></tr>\n";
      echo "<tr><td>Monitor Serial:</td><td>" . $myrow["monitor_serial"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Monitor Manufacture Date:</td><td>" . $myrow["monitor_manufacture_date"] . "</td></tr>\n";
    } while ($myrow = mysql_fetch_array($result));
  } else {
    //echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
	//echo "<tr>";
    //echo "<td class=\"contenthead\"><img src=\"images/inv_monitor$pic_style.png\" width=\"64\" height=\"64\" alt=\"\" />No Monitor installed.</td>"; 
	//echo "</tr>";
	//echo "</table>";
  }
} else {}

if (($sub == "so") or ($sub == "all")){
  $SQL = "SELECT * FROM sound WHERE sound_uuid = '$pc' AND sound_timestamp = '$timestamp'";
  $result = mysql_query($SQL, $db);
  if (($myrow = mysql_fetch_array($result)) and ($myrow["sound_name"] <> "")){
    do {
      echo "<tr><td class=\"contenthead\" colspan=\"2\"><img src=\"images/inv_sound$pic_style.png\" width=\"64\" height=\"64\" alt=\"\" />Sound Card</td><td></td></tr>\n";
      echo "<tr><td>Description:</td><td>" . $myrow["sound_name"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Manufacturer:</td><td>" . $myrow["sound_manufacturer"] . "</td></tr>\n";
	} while ($myrow = mysql_fetch_array($result));
  } else {
	//echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
	//echo "<tr>";
    //echo "<td class=\"contenthead\"><img src=\"images/inv_sound" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />No Sound Card installed.</td>"; 
	//echo "</tr>";
	//echo "</table>";
  }
} else {}


if (($sub == "km") or ($sub == "all")){
  $opt_count = 0;
  $SQL = "SELECT * FROM keyboard WHERE keyboard_uuid = '$pc' AND keyboard_timestamp = '$timestamp'";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result) and $myrow["keyboard_caption"] <> ""){
    echo "<tr><td class=\"contenthead\" colspan=\"2\"><img src=\"images/inv_keyboard$pic_style.png\" width=\"64\" height=\"64\" alt=\"\" />Keyboard</td></tr>";
    do {
      echo "<tr><td>Type:</td><td>" . $myrow["keyboard_caption"] . "</td></tr>";
      echo "<tr bgcolor=\"$bg1\"><td>Description:</td><td>" . $myrow["keyboard_description"] . "</td></tr>";
    } while ($myrow = mysql_fetch_array($result));
  } else {}
  $SQL = "SELECT * FROM mouse WHERE mouse_uuid = '$pc' AND mouse_timestamp = '$timestamp'";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    do {
      $opt_count = $opt_count + 1;
      echo "<tr><td class=\"contenthead\" colspan=\"2\"><img src=\"images/inv_mouse$pic_style.png\" width=\"64\" height=\"64\" alt=\"\" />Mouse #" . $opt_count . "</td></tr>\n";
	  echo "<tr><td>Description:</td><td>" . $myrow["mouse_description"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Buttons:</td><td>" . $myrow["mouse_number_of_buttons"] . "</td></tr>\n";
      echo "<tr><td>Connection:</td><td>" . $myrow["mouse_port"] . "</td></tr>\n";
    } while ($myrow = mysql_fetch_array($result));
  } else {}
} else {}


if (($sub == "mo") or ($sub == "all")){
  $opt_count = 0;
  $SQL = "SELECT * FROM modem WHERE modem_uuid = '$pc' AND modem_timestamp = '$timestamp' ORDER BY modem_attached_to";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
	do {
	$opt_count = $opt_count + 1;
      echo "<tr><td class=\"contenthead\" colspan=\"2\"><img src=\"images/inv_modem$pic_style.png\" width=\"64\" height=\"64\" alt=\"\" />Modem #$opt_count</td><td></td></tr>\n";
      echo "<tr><td>Type:</td><td>" . $myrow["modem_device_type"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Description:</td><td>" . $myrow["modem_description"] . "</td></tr>\n";
      echo "<tr><td>Port:</td><td>" . $myrow["modem_attached_to"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Country Selected:</td><td>" . $myrow["modem_country_selected"] . "</td></tr>\n";
	} while ($myrow = mysql_fetch_array($result));
	} else {
	//echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
	//echo "<tr>";
    //echo "<td class=\"contenthead\"><img src=\"images/inv_modem" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />No Modems installed.</td>"; 
	//echo "</tr>";
	//echo "</table>";
  }
	} else {}


if (($sub == "ba") or ($sub == "all")){
  $SQL = "SELECT * FROM battery WHERE battery_uuid = '$pc' AND battery_timestamp = '$timestamp'";
  $result = mysql_query($SQL, $db);
  if (($myrow = mysql_fetch_array($result)) and ($myrow["battery_description"] <> "")){
    do {
      echo "<tr><td class=\"contenthead\" colspan=\"2\"><img src=\"images/inv_battery$pic_style.png\" width=\"64\" height=\"64\" alt=\"\" />Battery</td></tr>\n";
      echo "<tr><td>Description:</td><td>" . $myrow["battery_description"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Device ID:</td><td>" . $myrow["battery_device_id"] . "</td></tr>\n";
    } while ($myrow = mysql_fetch_array($result));
  } else {
	//echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
	//echo "<tr>";
    //echo "<td class=\"contenthead\"><img src=\"images/inv_battery" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />No Battery installed.</td>"; 
	//echo "</tr>";
	//echo "</table>";
  }
} else {}
	
	
if (($sub == "us") or ($sub == "all")){
  $SQL = "SELECT * FROM usb WHERE usb_uuid = '$pc' AND usb_timestamp = '$timestamp' AND usb_manufacturer <> '(Standard system devices)' AND usb_caption <> 'HID-compliant consumer control device' AND usb_manufacturer <> '(Standard USB Host Controller)' ORDER BY usb_caption";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    do {
      echo "<tr><td class=\"contenthead\" colspan=\"2\"><img src=\"images/";
      if (substr_count(strtolower($myrow["usb_caption"]), "ipod") > 0 ) {
        echo "inv_ipod" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />USB Device - iPod</td></tr>\n";
      } else {
        if (substr_count(strtolower($myrow["usb_caption"]), "mouse") > 0 ) {
          echo "inv_mouse" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />USB Device - Mouse</td></tr>\n";
        } else {	  
          if ((substr_count(strtolower($myrow["usb_caption"]), "keyboard") > 0 ) OR 
            (substr_count(strtolower($myrow["usb_caption"]), "internet keys usb") > 0 )) {
            echo "inv_keyboard" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />USB Device - Keyboard</td></tr>\n";
          } else {	  
            if ((substr_count(strtolower($myrow["usb_caption"]), "scanner") > 0 ) OR 
              (substr_count(strtolower($myrow["usb_caption"]), "scanjet") > 0 )) {
              echo "inv_scanner" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />USB Device - Scanner</td></tr>\n";
            } else {	
              if ((substr_count(strtolower($myrow["usb_caption"]), "printer") > 0 ) OR 
                  (substr_count(strtolower($myrow["usb_caption"]), "laserjet") > 0) OR 
                  (substr_count(strtolower($myrow["usb_caption"]), "kyocera mita fs") > 0 ) OR 
                  (substr_count(strtolower($myrow["usb_caption"]), "kyocera fs") > 0 )){
			      echo "inv_printer" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />USB Device - Printer</td></tr>\n";
              } else {
                if (substr_count(strtolower($myrow["usb_caption"]), "camera") > 0 ) {
                  echo "inv_camera" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />USB Device - Camera</td></tr>\n";
                } else {
		            if ((substr_count(strtolower($myrow["usb_caption"]), "disk") > 0 ) OR (substr_count(strtolower($myrow["usb_description"]), "disk drive") > 0 )){
			          echo "inv_flashdrive" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />USB Device - Disk</td></tr>\n";
		            } else {
		              if (substr_count(strtolower($myrow["usb_caption"]), "ipaq") > 0 ) {
			            echo "inv_pda" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />USB Device - PDA</td></tr>\n";
		              } else {
		                if ((substr_count(strtolower($myrow["usb_caption"]), "modem") > 0 ) OR 
						    (substr_count(strtolower($myrow["usb_caption"]), "netcomm roadster") > 0 )) {
			              echo "inv_modem" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />USB Device - Modem</td></tr>\n";
		                } else {
		                  if (substr_count(strtolower($myrow["usb_caption"]), "tv") > 0 ) {
			                echo "inv_tv" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />USB Device - TV Capture</td></tr>\n";
		                  } else {
		                    if (substr_count(strtolower($myrow["usb_description"]), "cd-rom") > 0 ) {
			                  echo "inv_cdrom" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />USB Device - CD / DVD Drive</td></tr>\n";
		                    } else {
		                      if (substr_count(strtolower($myrow["usb_description"]), "audio") > 0 ) {
			                    echo "inv_sound" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />USB Device - Audio</td></tr>\n";
		                      } else {
		                        if (substr_count(strtolower($myrow["usb_description"]), "touch screen") > 0 ) {
			                      echo "inv_monitor" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />USB Device - Touch Screen</td></tr>\n";
		                        } else {
                                  echo "inv_usb" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />USB Device</td></tr>\n";
								}
						      }
							}
						  }
						}
					  }
				    }
				  }
				}
			  }
			}
		  }
		}
		
		echo "<tr><td>Caption:</td><td>" . $myrow["usb_caption"] . "</td></tr>\n";
		echo "<tr bgcolor=\"$bg1\"><td>Description:</td><td>" . $myrow["usb_description"] . "</td></tr>\n";
		echo "<tr><td>Manufacturer:</td><td>" . $myrow["usb_manufacturer"] . "</td></tr>\n";
	} while ($myrow = mysql_fetch_array($result));
	} else {
	//echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
	//echo "<tr>";
    //echo "<td class=\"contenthead\"><img src=\"images/inv_usb" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />No USB Devices installed.</td>"; 
	//echo "</tr>";
	//echo "</table>";
  }
	} else {}


if (($sub == "pr") or ($sub == "all")){
  $opt_count = 0;
  $SQL = "SELECT * FROM printer WHERE printer_uuid = '$pc' AND printer_timestamp = '$timestamp' AND printer_system_name = '" . $name . "' AND printer_port_name NOT LIKE '%IP%' AND printer_port_name NOT LIKE '\\\\%'";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    do {
      $opt_count = $opt_count + 1;
      echo "<tr><td class=\"contenthead\" colspan=\"2\"><img src=\"images/inv_printer$pic_style.png\" width=\"64\" height=\"64\" alt=\"\" />Local Attached Printer #$opt_count</td></tr>\n";
      echo "<tr><td>Description:</td><td>" . $myrow["printer_caption"] . "</td></tr>\n";
      echo "<tr><td>Location:</td><td>" . $myrow["printer_location"] . "</td></tr>\n";
      echo "<tr><td>Port:</td><td>" . $myrow["printer_port_name"] . "</td></tr>\n";
      echo "<tr><td>Shared:&nbsp;</td><td>" . $myrow["printer_shared"] . "</td></tr>\n";
      echo "<tr><td>Share Name:</td><td>" . $myrow["printer_share_name"] . "</td></tr>\n";
	} while ($myrow = mysql_fetch_array($result));
  } else {
	//echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
	//echo "<tr>";
    //echo "<td class=\"contenthead\"><img src=\"images/inv_printer" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />No Local Attached Printers.</td>"; 
	//echo "</tr>";
	//echo "</table>";
  }
} else {}


echo "</table>\n";
echo "<br />&nbsp;";
echo "</div>\n";
echo "</body>\n";
echo "</html>\n";
include "include_png_replace.php";
