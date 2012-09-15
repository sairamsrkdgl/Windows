<?php 
$page = "se";
include "include.php"; 

echo "<div class=\"main_each\">";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"contenthead\">";
echo "<tr>";
echo "<td>Security Information for " . $name . "</td>";
echo "</tr>";
echo "</table>";

$opt_count = 0;
$SQL = "SELECT * FROM system WHERE system_uuid = '$pc' AND system_timestamp = '$timestamp'";
$result = mysql_query($SQL, $db);
$myrow = mysql_fetch_array($result);
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">";
echo "<tr><td class=\"contenthead\" colspan=\"2\"><img src=\"images/inv_firewall" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />XP SP2 Firewall</td></tr>";
echo "<tr><td class=\"contenthead\">General Settings - Domain.</td></tr>";

if (($myrow["firewall_enabled_domain"] == "1") OR ($myrow["firewall_enabled_domain"] == "0")) {
  $enabled = $myrow["firewall_enabled_domain"];
  if ($enabled == "0") { $enabled = "No";} else { }
  if ($enabled == "1") { $enabled = "Yes";} else { }
  $notifications = $myrow["firewall_disablenotifications_domain"];
  if ($notifications == "0") { $notifications = "No"; } else {}
  if ($notifications == "1") { $notifications = "Yes"; } else {}
  $excep = $myrow["firewall_donotallowexceptions_domain"];
  if ($excep == "0") { $excep = "No"; } else {}
  if ($excep == "1") { $excep = "Yes"; } else {}
  echo "<tr><td>Firewall Enabled:&nbsp;" . $enabled . "<br />\n";
  echo "Notifications Given to User:&nbsp;" . $notifications . "<br />\n";
  echo "Exceptions Allowed:&nbsp;" . $excep . "<br />&nbsp;</td>\n";
} else {
  echo "<tr><td>Domain Profile Not Detected.<br />&nbsp;</td></tr>\n";
}


echo "<tr><td class=\"contenthead\">General Settings - Standard.</td></tr>";
$bgcolor = "#FFFFFF";
if (($myrow["firewall_enabled_standard"] == "1") OR ($myrow["firewall_enabled_standard"] == "0")) {
  $enabled = $myrow["firewall_enabled_standard"];
  if ($enabled == "0") { $enabled = "No";} else { }
  if ($enabled == "1") { $enabled = "Yes";} else { }
  $notifications = $myrow["firewall_disablenotifications_standard"];
  if ($notifications == "0") { $notifications = "No"; } else {}
  if ($notifications == "1") { $notifications = "Yes"; } else {}
  $excep = $myrow["firewall_donotallowexceptions_standard"];
  if ($excep == "0") { $excep = "No"; } else {}
  if ($excep == "1") { $excep = "Yes"; } else {}
  echo "<td>Firewall Enabled:&nbsp;" . $enabled . "<br />\n";
  echo "Notifications Given to User:&nbsp;" . $notifications . "<br />\n";
  echo "Exceptions Allowed:&nbsp;" . $excep . "<br />&nbsp;</td></tr>\n";
} else {
  echo "<tr><td>General Profile Not Detected.<br />&nbsp;</td></tr>\n";
}



$SQL = "SELECT * FROM firewall_ports where port_uuid = '$pc' AND port_timestamp = '$timestamp' ORDER BY port_profile, port_number";
$result = mysql_query($SQL, $db);
$myrow = mysql_fetch_array($result);
  echo "<tr><td class=\"contenthead\">Port Exceptions.</td></tr>\n";
if ($myrow = mysql_fetch_array($result)){
  do {
    echo "<tr><td>" . $myrow["port_profile"] .  "&nbsp;&nbsp;:&nbsp;&nbsp;"  . $myrow["port_number"] . "&nbsp;&nbsp;:&nbsp;&nbsp;" . $myrow["port_protocol"] . "&nbsp;&nbsp;:&nbsp;&nbsp;" . $myrow["port_scope"] . "</td></tr>\n";
  } while ($myrow = mysql_fetch_array($result));
} else {}
echo "<tr><td><br />&nbsp;</td></tr>";


$SQL = "SELECT * FROM firewall_auth_app where firewall_app_uuid = '$pc' AND firewall_app_timestamp = '$timestamp'  ORDER BY firewall_app_profile, firewall_app_name";
$result = mysql_query($SQL, $db);
$myrow = mysql_fetch_array($result);
if ($myrow = mysql_fetch_array($result)){
  echo "<tr><td class=\"contenthead\">Program Exceptions.</td></tr>\n";
  do {
    echo "<tr><td>" . $myrow["firewall_app_profile"] . "&nbsp;&nbsp;:&nbsp;&nbsp;" . $myrow["firewall_app_name"] . "&nbsp;&nbsp;:&nbsp;&nbsp;" . $myrow["firewall_app_executable"] . "</td></tr>\n";
  } while ($myrow = mysql_fetch_array($result));
} else {}
echo "<tr><td><br />&nbsp;</td></tr>";
echo "</table>\n";

$opt_count = 0;
$SQL = "SELECT * from software WHERE software_uuid = '$pc' AND software_timestamp = '$timestamp' AND software_name LIKE '%ZoneAlarm%'";
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
  do {
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
    echo "<tr><td class=\"contenthead\" width=\"200\"><img src=\"images/inv_firewall" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />Other Firewall</td></td><td></tr>\n";
    echo "<tr><td>Enabled:</td><td>" . $myrow["software_name"] . "</td></tr>\n";
    echo "</table>";
	} while ($myrow = mysql_fetch_array($result));
	} else {}

$opt_count = 0;
$SQL = "SELECT * from system WHERE system_uuid = '$pc' AND system_timestamp = '$timestamp'";
$result = mysql_query($SQL, $db);
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
echo "<tr><td class=\"contenthead\" width=\"200\"><img src=\"images/inv_antivirus" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />AntiVirus</td><td></td></tr>\n";
if ($myrow = mysql_fetch_array($result)){
  do {
    echo "<tr><td>AV Program Name:</td><td>" . $myrow["virus_name"] . "</td></tr>\n";
    echo "<tr><td>AV Program Vendor:</td><td>" . $myrow["virus_manufacturer"] . "</td></tr>\n";
    echo "<tr><td>AV Program Version:</td><td>" . $myrow["virus_version"] . "</td></tr>\n";
    echo "<tr><td>AV Program 'up to date':</td><td>" . $myrow["virus_uptodate"] . "</td></tr>\n";
  } while ($myrow = mysql_fetch_array($result));
} else {
  echo "<tr><td>AntiVirus Program Installed:</td><td>NONE</td></tr>\n";
}

echo "</table>";

$opt_count = 0;
$SQL = "SELECT * from nmap_other_ports WHERE nmap_other_id = '" . $pc . "' ORDER BY nmap_port_number";
$result = mysql_query($SQL, $db);
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
echo "<tr><td class=\"contenthead\" width=\"200\" colspan=\"2\"><br /><img src=\"images/inv_nmap" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />Nmap detected open ports</td></tr>\n";
if ($myrow = mysql_fetch_array($result)){
  do {
    echo "<tr><td>" . $myrow["nmap_port_number"] . "</td><td>" . $myrow["nmap_port_name"] . "</td></tr>\n";
  } while ($myrow = mysql_fetch_array($result));
} else {
  echo "<tr><td>No open ports detected by Nmap.</td></tr>\n";
}

echo "</table>\n";

echo "</div>\n";
echo "</body>\n";
echo "</html>\n";

include "include_png_replace.php";
?>