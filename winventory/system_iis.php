<?php 
$page = "iis";
include "include.php"; 

echo "<div class=\"main_each\">";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"700\">";
echo "<tr>";
echo "<td align=\"left\" class=\"contenthead\">IIS Settings for " . $name . "<br />&nbsp;</td>";
echo "</tr>";
echo "</table>";

$opt_count = 0;
$SQL = "SELECT * FROM iis WHERE iis_uuid = '$pc' AND iis_timestamp = '$timestamp'";
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
  do {
    echo "<tr><td class=\"menuhead\" colspan=\"3\"><img src=\"images/inv_iis" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />IIS Site Number:&nbsp;" . $myrow["iis_site"] . "</td></tr>\n";
    echo "<tr><td>Description:&nbsp;</td><td>" . $myrow["iis_description"] . "</td></tr>\n";
    echo "<tr bgcolor=\"$bg1\"><td>Home Directory:&nbsp;</td><td>" . $myrow["iis_home_directory"] . "</td></tr>\n";
    echo "<tr><td>Directory Browsing:&nbsp;</td><td>" . $myrow["iis_directory_browsing"] . "</td></tr>\n";
    echo "<tr bgcolor=\"$bg1\"><td>Default Documents:&nbsp;</td><td>" . $myrow["iis_default_documents"] . "</td></tr>\n";
    echo "<tr><td>Logging Enabled:&nbsp;</td><td>" . $myrow["iis_logging_enabled"] . "</td></tr>\n";
    echo "<tr bgcolor=\"$bg1\"><td>Logging Format:&nbsp;</td><td>" . $myrow["iis_logging_format"] . "</td></tr>\n";
    echo "<tr><td>Logging Period:&nbsp;</td><td>" . $myrow["iis_logging_time_period"] . "</td></tr>\n";
    echo "<tr bgcolor=\"$bg1\"><td>Logging Directory:&nbsp;</td><td>" . $myrow["iis_logging_dir"] . "</td></tr>\n";
    echo "<tr><td>Secure IP / Port:&nbsp;</td><td>" . htmlspecialchars($myrow["iis_secure_ip"]) . " / " . htmlspecialchars($myrow["iis_secure_port"]) . "</td></tr>\n";
    $SQL2 = "SELECT * from iis_ip where iis_ip_uuid = '$pc' AND iis_ip_timestamp = '$timestamp' AND iis_ip_site = '" . $myrow["iis_site"] . "' ORDER BY iis_ip_site";
    $result2 = mysql_query($SQL2, $db);
    if ($myrow2 = mysql_fetch_array($result2)){
      do {
        echo "<tr bgcolor=\"$bg1\"><td>IP Address / Port / Host Header:&nbsp;</td><td>" . htmlspecialchars($myrow2["iis_ip_ip_address"]) . " / " . $myrow2["iis_ip_port"] . " / " . htmlspecialchars($myrow2["iis_ip_host_header"]) . "</td></tr>\n";
	  } while ($myrow2 = mysql_fetch_array($result2));
    } else {}
    $SQL2 = "SELECT * from iis_vd where iis_vd_uuid = '$pc' AND iis_vd_timestamp = '$timestamp' AND iis_vd_site = '" . $myrow["iis_site"] . "' ORDER BY iis_vd_name";
    $result2 = mysql_query($SQL2, $db);
    $bg3 = $bg1;
    if ($myrow2 = mysql_fetch_array($result2)){
      echo "<tr><td valign=\"top\">Virtual Directories:&nbsp;</td><td>";
      echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
      do {
        if ($bg3 == $bg2) {$bg3 = $bg1;} else {$bg3 = $bg2;}
        echo "<tr bgcolor=\"$bg3\"><td>" . htmlspecialchars($myrow2["iis_vd_name"]) . "</td><td>" . htmlspecialchars($myrow2["iis_vd_path"]) . "</td></tr>\n";
	  } while ($myrow2 = mysql_fetch_array($result2));
      echo "</table></td></tr>";
    } else {}
  } while ($myrow = mysql_fetch_array($result));
  echo "<tr><td><br />&nbsp;</td><td></td></tr>";
  echo "</table>";
} else {
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
  echo "<tr>";
  echo "<td class=\"contenthead\"><img src=\"images/inv_iis" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />IIS is not installed.</td>\n"; 
  echo "</tr>";
  echo "</table>";
}
echo "</div>";
echo "</body>";
echo "</html>";
include "include_png_replace.php";
?>