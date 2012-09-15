<?php 
$page = "os";
include "include.php"; 

echo "<div class=\"main_each\">";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">";
echo "<tr>";
echo "<td align=\"left\" class=\"contenthead\">Operating System Settings for " . $name . "<br />&nbsp;</td>";
echo "</tr>";


if (($sub == "su") or ($sub == "all")){
  $opt_count = 0;
  $SQL = "SELECT * FROM system WHERE system_uuid = '$pc' AND system_timestamp = '$timestamp'";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    do {
      echo "<tr><td class=\"contenthead\" colspan=\"2\"><img src=\"images/inv_summary$pic_style.png\" width=\"64\" height=\"64\" alt=\"\" />Summary</td></tr>\n";
      echo "<tr><td>Machine Name:</td><td>" . $myrow["system_name"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Description:</td><td>" . $myrow["system_description"] . "</td></tr>\n";
      echo "<tr><td>Registered User:</td><td>" . $myrow["system_registered_user"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Operating System:</td><td>" . $myrow["system_os_name"] . "</td></tr>\n";
      echo "<tr><td>Manufacturer:</td><td>" . $myrow["system_vendor"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Model / Serial:</td><td>" . $myrow["system_model"] . " / " . $myrow["system_id_number"] . "</td></tr>\n";
	} while ($myrow = mysql_fetch_array($result));
  } else {}
} else {}

if (($sub == "os") or ($sub == "all")){
  $SQL = "SELECT software_version FROM software WHERE software_name = 'Internet Explorer' AND software_uuid = '$pc' AND software_timestamp = '$timestamp'";
  $result = mysql_query($SQL, $db);
  $myrow = mysql_fetch_array($result);
  $version_ie = $myrow["software_version"];
  $SQL = "SELECT software_version FROM software WHERE software_name LIKE 'DirectX%' AND software_uuid = '$pc' AND software_timestamp = '$timestamp'";
  $result = mysql_query($SQL, $db);
  $myrow = mysql_fetch_array($result);
  $version_dx = $myrow["software_version"];
  $SQL = "SELECT software_version FROM software WHERE software_name = 'Windows Media Player' AND software_uuid = '$pc' AND software_timestamp = '$timestamp'";
  $result = mysql_query($SQL, $db);
  $myrow = mysql_fetch_array($result);
  $version_wmp = $myrow["software_version"];
  $opt_count = 0;
  $SQL = "SELECT * FROM system WHERE system_uuid = '$pc' AND system_timestamp = '$timestamp'";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
	do {
      echo "<tr><td class=\"contenthead\" colspan=\"2\"><img src=\"images/inv_os$pic_style.png\" width=\"64\" height=\"64\" alt=\"\" />OS Information</td></tr>\n";
      echo "<tr><td>Operating System:</td><td>" . $myrow["system_os_name"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Registered User:</td><td>" . $myrow["system_registered_user"] . "</td></tr>\n";
      echo "<tr><td>Registered Organisation:</td><td>" . $myrow["system_organisation"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>OS Version / Service Pack:</td><td>" . $myrow["system_build_number"] . " / " . $myrow["system_service_pack"] . "</td></tr>\n";
      echo "<tr><td>Windows Directory:</td><td>" . $myrow["system_windows_directory"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Windows Serial:</td><td>" . $myrow["system_serial_number"] . "</td></tr>\n";
      echo "<tr><td>Windows Installed On:</td><td>" . $myrow["date_system_install"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>System Language:</td><td>" . $myrow["system_language"] . "</td></tr>\n";
      echo "<tr><td>Time Zone:</td><td>" . $myrow["time_caption"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Daylight Savings Zone:</td><td>" . $myrow["time_daylight"] . "</td></tr>\n";
      echo "<tr><td>DirectX Version:</td><td>$version_dx</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Windows Media Player Version:</td><td>$version_wmp</td></tr>\n";
      echo "<tr><td>IE Version:</td><td>$version_ie</td></tr>\n";
	} while ($myrow = mysql_fetch_array($result));
  } else {}
} else {}


if (($sub == "ne") or ($sub == "all")){
  $opt_count = 0;
  $SQL = "SELECT * FROM network_card WHERE net_uuid = '$pc' AND net_timestamp = '$timestamp' AND net_ip_address <> '000.000.000.000'";
  $result = mysql_query($SQL, $db);
  echo "<tr><td class=\"contenthead\" colspan=\"2\"><img src=\"images/inv_network_info$pic_style.png\" width=\"64\" height=\"64\" alt=\"\" />Network Settings</td></tr>";
  if ($myrow = mysql_fetch_array($result)){
    echo "<tr><td>IP Address / Subnet:</td><td>" . ip_trans($myrow["net_ip_address"]) . " / " . $myrow["net_ip_subnet"] . "</td></tr>\n";
    echo "<tr bgcolor=\"$bg1\"><td>DHCP Enabled / DCHP Server:</td><td>" . $myrow["net_dhcp_enabled"] . " / " . $myrow["net_dhcp_server"] . "</td></tr>\n";
    echo "<tr><td>DNS Server:</td><td>" . $myrow["net_dns_server"] . "</td></tr>\n";
    echo "<tr bgcolor=\"$bg1\"><td>WINS Server:</td><td>" . $myrow["net_wins_primary"] . "</td></tr>\n";
  } else {}
  $SQL = "SELECT * FROM system WHERE system_uuid = '$pc' AND system_timestamp = '$timestamp'";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
	do {
	  echo "<tr><td>Domain Name / AD Site Name:</td><td>" . $myrow["net_domain"] . " / " . $myrow["net_client_site_name"] . "</td></tr>\n";
	  echo "<tr bgcolor=\"$bg1\"><td>Domain Controller:</td><td>" . $myrow["net_domain_controller_name"] . "</td></tr>\n";
	  echo "<tr><td>Current User:</td><td>" . $myrow["net_user_name"] . "</td></tr>\n";
	} while ($myrow = mysql_fetch_array($result));
  } else {}
} else {}


if ($sub == "sh") {
  $opt_count = 0;
  $SQL = "SELECT * FROM shares WHERE shares_uuid = '$pc' AND shares_timestamp = '$timestamp' ORDER BY shares_path, shares_name";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
	echo "<tr><td class=\"contenthead\" width=\"300\"><img src=\"images/inv_shares$pic_style.png\" width=\"64\" height=\"64\" alt=\"\" />Shared Drives</td><td></td></tr>";
	do {
      echo "<tr><td>Path:</td><td>" . $myrow["shares_path"] . "</td></tr>\n";
      echo "<tr bgcolor=\"$bg1\"><td>Share Name:</td><td>" . $myrow["shares_name"] . "</td></tr>\n";
      echo "<tr><td>Share Description:</td><td>" . $myrow["shares_caption"] . "</td></tr>\n";
      echo "<tr><td colspan=\"2\">&nbsp;</td></tr>\n";
	} while ($myrow = mysql_fetch_array($result));
  } else {
    echo "<p class=\"contenthead\"><img src=\"images/inv_shares" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />No Shared Drives.</p>"; }
} else {}

echo "<tr><td>&nbsp;</td></tr>";
echo "</table>";
?>
</div>
</div>
</body>
</html> 
<?php
include "include_png_replace.php";
?>