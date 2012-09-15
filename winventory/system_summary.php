<?php 
$page = "su";
include "include.php"; 

$subnet = "";
$dhcp_enabled = "";
$dhcp_server = "";
$ip = "";

$SQL = "SELECT * FROM network_card WHERE net_uuid = '" . $pc . "'";
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
  do {
    if ($myrow["net_ip_address"] <> "000.000.000.000") {
      $subnet = $myrow["net_ip_subnet"];
      $dhcp_enabled = $myrow["net_dhcp_enabled"];
      $dhcp_server = $myrow["net_dhcp_server"];
      $ip = $myrow["net_ip_address"];
    } else {}
  } while ($myrow = mysql_fetch_array($result));
} else {}

	$sql = "SELECT * from system WHERE system_uuid = '$pc' AND system_timestamp = '$timestamp'";
	$result = mysql_query($sql, $db);
	if ($myrow = mysql_fetch_array($result)){
	  echo "<div class=\"main_each\">\n";
      echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
      echo "<tr><td class=\"contenthead\" colspan=\"4\">System Summary for " . ip_trans($myrow["net_ip_address"]) . " - " . $myrow["system_name"] . "</td></tr>\n";
	  do {
		echo "<tr><td colspan=\"2\" class=\"contenthead\"><img src=\"images/inv_summary" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />Summary</td></tr>\n";
		echo "<tr bgcolor=\"#F1F1F1\"><td width=\"200\">Machine Name:&nbsp;</td><td>" . $myrow["system_name"] . "</td></tr>\n";
		echo "<tr><td>Description:&nbsp;</td><td>" . $myrow["system_description"] . "</td></tr>\n";
		echo "<tr bgcolor=\"#F1F1F1\"><td>Domain Role:&nbsp;</td><td>" . $myrow["net_domain_role"] . "</td></tr>\n";
		echo "<tr><td>Registered User:&nbsp;</td><td>" . $myrow["system_registered_user"] . "</td></tr>\n";
		echo "<tr bgcolor=\"#F1F1F1\"><td>Chassis Type:&nbsp;</td><td>" . $myrow["system_system_type"] . "</td></tr>\n";
		echo "<tr><td>Model / Serial #:&nbsp;</td><td>" . $myrow["system_model"] . " / " . $myrow["system_id_number"] . "</td></tr>\n";
		echo "<tr bgcolor=\"#F1F1F1\"><td>Manufacturer:&nbsp;</td><td>" . $myrow["system_vendor"] . "</td></tr>\n";
		echo "<tr><td>Operating System:&nbsp;</td><td>" . $myrow["system_os_name"] . "</td></tr>\n";
		echo "<tr bgcolor=\"#F1F1F1\"><td>Build Number / Service Pack:&nbsp;</td><td>" . $myrow["system_build_number"] . " / " . $myrow["system_service_pack"] . "</td></tr>\n";
		echo "<tr><td>System UUID:&nbsp;</td><td>" . $myrow["system_uuid"] . "&nbsp;&nbsp;</td></tr>\n";
		echo "<tr bgcolor=\"#F1F1F1\"><td>Windows Installed On:&nbsp;</td><td>" . $myrow["date_system_install"] . "</td></tr>\n";
		echo "<tr><td>IP Address / Subnet:&nbsp;</td><td>" . ip_trans($ip) . " / " . ip_trans($subnet) . "</td></tr>\n";
		echo "<tr bgcolor=\"#F1F1F1\"><td>DHCP Enabled / DCHP Server:&nbsp;</td><td>" . $dhcp_enabled . " / " . $dhcp_server . "</td></tr>\n";
		echo "<tr><td>Date First Audited:&nbsp;</td><td>" . return_date_time($myrow["system_first_timestamp"]) . "&nbsp;&nbsp;</td></tr>\n";
		echo "<tr bgcolor=\"#F1F1F1\"><td>Date Last Audited:&nbsp;</td><td>" . return_date_time($timestamp) . "&nbsp;&nbsp;</td></tr>\n";
		echo "<tr><td>System Memory:&nbsp;</td><td>" . $myrow["system_memory"] . "&nbsp;MB</td></tr>\n";
	  } while ($myrow = mysql_fetch_array($result));
	  } else {}

    $bgcolor = "#FFFFFF";
	$SQL = "SELECT * FROM hard_drive WHERE hard_drive_uuid = '$pc' AND hard_drive_timestamp = '$timestamp' ORDER BY hard_drive_index";
	$result = mysql_query($SQL, $db);
	if ($myrow = mysql_fetch_array($result)){
	do {
      if ($bgcolor == "#F1F1F1") { $bgcolor = "#FFFFFF"; } else { $bgcolor = "#F1F1F1"; }
      echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Hard Drive Size:&nbsp;</td><td>" . number_format($myrow["hard_drive_size"]) . " MB</td></tr>\n";
	} while ($myrow = mysql_fetch_array($result));
	} else {}


	$SQL = "SELECT * FROM processor WHERE processor_uuid = '$pc' AND processor_timestamp = '$timestamp' ORDER BY processor_id";
	$result = mysql_query($SQL, $db);
	if ($myrow = mysql_fetch_array($result)){
	do {
      if ($bgcolor == "#F1F1F1") { $bgcolor = "#FFFFFF"; } else { $bgcolor = "#F1F1F1"; }
      echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Processor:&nbsp;</td><td>" . $myrow["processor_name"] . "</td></tr>\n";
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

    if ($bgcolor == "#F1F1F1") { $bgcolor = "#FFFFFF"; } else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Physical Location:&nbsp;</td><td>" . $s_m_l . "</td></tr>\n";
    if ($bgcolor == "#F1F1F1") { $bgcolor = "#FFFFFF"; } else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Date of Purchase:&nbsp;</td><td>" . $s_m_d_o_p . "</td></tr>\n";
    if ($bgcolor == "#F1F1F1") { $bgcolor = "#FFFFFF"; } else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Dollar Value:&nbsp;</td><td>" . $s_m_v . "</td></tr>\n";
    if ($bgcolor == "#F1F1F1") { $bgcolor = "#FFFFFF"; } else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Asset Number:&nbsp;</td><td>" . $s_m_s_n . "</td></tr>\n";
    if ($bgcolor == "#F1F1F1") { $bgcolor = "#FFFFFF"; } else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Description:&nbsp;</td><td>" . $s_m_d . "</td></tr>\n";

	$SQL = "SELECT * FROM other WHERE other_linked_pc = '" . $pc . "'";
	$result = mysql_query($SQL, $db);
	if ($myrow = mysql_fetch_array($result)){
	  do {
        if ($bgcolor == "#F1F1F1") { $bgcolor = "#FFFFFF"; } else { $bgcolor = "#F1F1F1"; }
	    echo "<tr bgcolor=\"" . $bgcolor . "\"><td valign=\"top\">Other Items:&nbsp;</td><td>" . $myrow["other_type"] . "&nbsp;&nbsp;:&nbsp;&nbsp;<a href=\"other_summary.php?other=" . $myrow["other_id"] . "&amp;sub=1\">" . $myrow["other_name"] . "</a>&nbsp;&nbsp;:&nbsp;&nbsp;" . $myrow["other_manufacturer"] . "</td></tr>";
	  } while ($myrow = mysql_fetch_array($result));
	} else {
      if ($bgcolor == "#F1F1F1") { $bgcolor = "#FFFFFF"; } else { $bgcolor = "#F1F1F1"; }
      echo "<tr><td>Other Items:&nbsp;</td><td>None</td></tr>\n";
    }

	$SQL = "SELECT * FROM printer WHERE printer_uuid = '" . $pc . "'";
	$result = mysql_query($SQL, $db);
	if ($myrow = mysql_fetch_array($result)){
	  do {
        if ($bgcolor == "#F1F1F1") { $bgcolor = "#FFFFFF"; } else { $bgcolor = "#F1F1F1"; }
	    echo "<tr bgcolor=\"" . $bgcolor . "\"><td valign=\"top\">Printers:&nbsp;</td><td><a href=\"printer_summary.php?printer=" . $myrow["printer_id"] . "&amp;sub=1\">" . $myrow["printer_caption"] . "</a></td></tr>";
	  } while ($myrow = mysql_fetch_array($result));
	} else {
      if ($bgcolor == "#F1F1F1") { $bgcolor = "#FFFFFF"; } else { $bgcolor = "#F1F1F1"; }
      echo "<tr><td>Printers:&nbsp;</td><td>None</td></tr>\n";
    }

	$SQL = "SELECT * FROM monitor WHERE monitor_uuid = '" . $pc . "'";
	$result = mysql_query($SQL, $db);
	if ($myrow = mysql_fetch_array($result)){
	  do {
        if ($bgcolor == "#F1F1F1") { $bgcolor = "#FFFFFF"; } else { $bgcolor = "#F1F1F1"; }
	    echo "<tr bgcolor=\"" . $bgcolor . "\"><td valign=\"top\">Monitor:&nbsp;</td><td><a href=\"monitor_summary.php?other=" . $myrow["monitor_id"] . "&amp;sub=1\">" . $myrow["monitor_manufacturer"] . "&nbsp;&nbsp;:&nbsp;&nbsp;" . $myrow["monitor_model"] . "</a></td></tr>";
	  } while ($myrow = mysql_fetch_array($result));
	} else {
      if ($bgcolor == "#F1F1F1") { $bgcolor = "#FFFFFF"; } else { $bgcolor = "#F1F1F1"; }
      echo "<tr><td>Monitors:&nbsp;</td><td>None</td></tr>\n";
    }

	echo "<tr><td><form action=\"system_summary_edit.php?pc=" .  $pc . "&amp;sub=all\" method=\"post\"><input name=\"Submit\" value=\" Edit \" type=\"submit\" class=\"content\" /></form></td></tr>";
?>

</table>
</div>
</body>
</html> 
<?php
include "include_png_replace.php";
?>