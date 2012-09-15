<?php 
$page = "";
$extra = "";
$software = "";
$count = 0;
if (isset($_GET['software'])) {$software = $_GET['software'];} else {}
if (isset($_GET['sort'])) {$sort = $_GET['sort'];} else {$sort= "system_name";}
include "include.php"; 

$title = "";
if (isset($_GET["show_all"])){ $count_system = '10000'; } else {}
if (isset($_GET["page_count"])){ $page_count = $_GET["page_count"]; } else { $page_count = 0;}
$page_prev = $page_count - 1;
if ($page_prev < 0){ $page_prev = 0; } else {}
$page_next = $page_count + 1;
$page_current = $page_count;
$page_count = $page_count * $count_system;

if ($sub == "0") { 
if ($show_other_discovered == "y") {
  $SQL = "SELECT * FROM other WHERE (other_mac_address <> '' AND other_date_detected > '" . adjustdate(0,0,-$other_detected) . "') ORDER BY other_name";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<div class=\"main_each\">\n";
    $count = 0;
    $bgcolor = "#FFFFFF";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" >\n";
    echo "<tr>\n";
    echo " <td class=\"contenthead\" colspan=\"4\"><a href=\"javascript://\" onclick=\"switchUl('f0');\">Other Items Discovered in the last " . $other_detected . " days.</a></td>\n";
    echo " <td align=\"right\"><a href=\"javascript://\" onclick=\"switchUl('f0');\"><img src=\"" . $but_all . "\" width=\"16\" height=\"16\" border=\"0\" /></a></td>\n";
    echo "</tr>\n";
    echo "</table>";
    echo "<div style=\"display:none;\" id=\"f0\">";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr>\n";
    echo "<td width=\"150\"><b>IP Address</b></td>\n";
    echo "<td width=\"150\"><b>Name</b></td>\n";
    echo "<td width=\"100\"><b>Type</b></td>\n";
    echo "<td width=\"250\"><b>Description</b></td>\n";
    echo "</tr>";
    do {
      $count = $count + 1;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	  echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	  echo "<td>" . $myrow["other_ip"] . "&nbsp;</td>\n";
	  echo "<td><a href=\"other_summary.php?other=" . $myrow["other_id"] . "&amp;sub=1\">" . $myrow["other_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
	  echo "<td>" . $myrow["other_type"] . "&nbsp;</td>\n";
	  echo "<td>" . $myrow["other_description"] . "&nbsp;&nbsp;&nbsp;</td>\n";
      echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
    echo "</table>";
    echo "</div>";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr><td colspan=\"3\"><b>Other Devices: " . $count . "</b></td></tr>\n";
    echo "</table>";
    echo "</div>";
  } else {}
} else {}

if ($show_system_discovered == "y") {
  $SQL = "select * from system  where date_first_audited > '" . adjustdate(0,0,-$system_detected) . "' ORDER BY net_ip_address";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<div class=\"main_each\">\n";
    $count = 0;
    $bgcolor = "#FFFFFF";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
    echo "<tr>\n";
    echo "  <td class=\"contenthead\" colspan=\"3\"><a href=\"javascript://\" onclick=\"switchUl('f1');\">Systems discovered in the last " . $system_detected . " days.</a></td>\n";
    echo "  <td align=\"right\"><a href=\"javascript://\" onclick=\"switchUl('f1');\"><img src=\"" . $but_all . "\" width=\"16\" height=\"16\" border=\"0\" /></a></td>\n";
    echo "</tr>\n";
    echo "</table>";
    echo "<div style=\"display:none;\" id=\"f1\">";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr>\n";
    echo "<td width=\"150\"><b>IP Address</b></td>\n";
    echo "<td width=\"150\"><b>System Name</b></td>\n";
    echo "<td><b>Audit Date</b></td>\n";
    echo "</tr>\n";
    do {
      $count = $count + 1;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>" . ip_trans($myrow["net_ip_address"]) . "</td>\n";
	echo "<td><a href=\"system_summary.php?pc=" . $myrow["net_mac_address"] . "\">" . $myrow["system_name"] . "</a></td>\n";
	echo "<td>" . $myrow["date_audited"] . "</td>\n";
	echo "</tr>";
    } while ($myrow = mysql_fetch_array($result));
    echo "</table>";
    echo "</div>";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr><td colspan=\"3\"><b>Systems: " . $count . "</b></td></tr>\n";
    echo "</table>";
    echo "</div>";
  } else {}
} else {}

if ($show_systems_not_audited == "y") {
  $SQL = "select * from system  where date_audited < '" . adjustdate(0,0,-$days_systems_not_audited) . "' ORDER BY system_name";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<div class=\"main_each\">\n";
    $count = 0;
    $bgcolor = "#FFFFFF";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
    echo "<tr>\n";
    echo "  <td class=\"contenthead\" colspan=\"3\"><a href=\"#\" onclick=\"switchUl('f2')\">Systems not audited in " . $days_systems_not_audited . " days.</a></td>\n";
    echo "  <td align=\"right\"><a href=\"#\" onclick=\"switchUl('f2');\"><img src=\"" . $but_all . "\" width=\"16\" height=\"16\" border=\"0\" /></a></td>\n";
    echo "</tr>\n";
    echo "</table>";
    echo "<div style=\"display:none;\" id=\"f2\">";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr>\n";
    echo "<td width=\"150\"><b>IP Address</b></td>\n";
    echo "<td width=\"150\"><b>System Name</b></td>\n";
    echo "<td><b>Audit Date</b></td>\n";
    echo "</tr>\n";
    do {
      $count = $count + 1;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	  echo "<tr bgcolor=\"" . $bgcolor . "\">";
	  echo "<td>" . ip_trans(ip_trans($myrow["net_ip_address"])) . "</td>";
	  echo "<td><a href=\"system_summary.php?pc=" . $myrow["net_mac_address"] . "\">" . $myrow["system_name"] . "</a></td>\n";
	  echo "<td>" . $myrow["date_audited"] . "</td>\n";
	  echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
    echo "</table>";
    echo "</div>";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr><td colspan=\"3\"><b>Total Systems: " . $count . "</b></td></tr>\n";
    echo "</table>";
    echo "</div>";
  } else {}
} else {}
  
if ($show_partition_usage == "y") {
  $SQL = "select sys.net_ip_address, sys.system_name, par.partition_volume_name, par.partition_caption, par.partition_mac_address, par.partition_free_space, par.partition_size from partition par, system sys where ( partition_free_space < ( (1-($percent_partition_usage / 100)) * partition_size)) and  sys.system_uuid = par.partition_uuid ORDER BY sys.net_ip_address, par.partition_caption";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<div class=\"main_each\">\n";
    $count = 0;
    $bgcolor = "#FFFFFF";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr>\n";
    echo "  <td class=\"contenthead\"><a href=\"javascript://\" onclick=\"switchUl('f3');\">Partition usage greater than " . $percent_partition_usage . "%.</a></td>\n";
    echo "  <td align=\"right\"><a href=\"javascript://\" onclick=\"switchUl('f3');\"><img src=\"" . $but_all . "\" width=\"16\" height=\"16\" border=\"0\" /></a></td>\n";
    echo "</tr>\n";
    echo "</table>";
    echo "<div style=\"display:none;\" id=\"f3\">";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr>\n";
    echo "<td width=\"150\"><b>IP Address</b></td>\n";
    echo "<td width=\"150\"><b>System Name</b></td>\n";
    echo "<td width=\"130\"><b>Free Mb</b></td>\n";
    echo "<td width=\"120\"><b>Free %</b></td>\n";
    echo "<td width=\"100\"><b>Letter</b></td>\n";
    echo "<td width=\"150\"><b>Name</b></td>\n";
    echo "</tr>\n";
    do {
      $count = $count + 1;
      $percent_used = round((($myrow["partition_free_space"] / $myrow["partition_size"]) * 100),1);
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>" . ip_trans($myrow["net_ip_address"]) . "</td>\n";
	echo "<td><a href=\"system_summary.php?pc=" . $myrow["partition_mac_address"] . "\">" . $myrow["system_name"] . "</a></td>\n";
    echo "<td>" . $myrow["partition_free_space"] . " Mb</td>\n";
	echo "<td>" . $percent_used . " %</td>\n";
    echo "<td>" . $myrow["partition_caption"] . " </td>\n";
    echo "<td>" . $myrow["partition_volume_name"] . " </td>\n";
	echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
    echo "</table>";
    echo "</div>";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr><td colspan=\"3\"><b>Total Partitions: " . $count . "</b></td></tr>\n";
    echo "</table>";
    echo "</div>";
  } else {} 
} else {}

if ($show_software_detected == "y"){
  $SQL = "select sys.net_ip_address,sys.system_name,svr.software_name, svr.software_mac, svr.software_detect_date from software svr, system sys where software_detect_date >= '" . adjustdate(0,0,-$days_software_detected) . "' AND svr.software_no_detect_date = '1111-11-11' and  svr.software_mac = sys.net_mac_address AND sys.date_first_audited < '" . adjustdate(0,0,-$days_software_detected) . "' AND sys.audit_type = 'Online' AND svr.software_name NOT LIKE '%Hotfix%' AND svr.software_name NOT LIKE '%Update%' ORDER BY sys.system_name, svr.software_name";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<div class=\"main_each\">\n";
    $count = 0;
    $bgcolor = "#FFFFFF";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr>\n";
    echo "  <td class=\"contenthead\"><a href=\"javascript://\" onclick=\"switchUl('f4');\">Software detected in the last " . $days_software_detected . " days.</a></td>\n";
    echo "  <td align=\"right\"><a href=\"javascript://\" onclick=\"switchUl('f4');\"><img src=\"" . $but_all . "\" width=\"16\" height=\"16\" border=\"0\" /></a></td>\n";
    echo "</tr>\n";
    echo "</table>";
    echo "<div style=\"display:none;\" id=\"f4\">";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr>\n";
    echo "<td width=\"120\"><b>IP Address</b></td>\n";
    echo "<td width=\"150\"><b>System Name</b></td>\n";
    echo "<td width=\"100\"><b>Detected</b></td>\n";
    echo "<td><b>Software Title</b></td>\n";
    echo "</tr>\n";
    do {
      $count = $count + 1;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>" . ip_trans($myrow["net_ip_address"]) . "</td>\n";
	echo "<td><a href=\"system_summary.php?pc=" . $myrow["software_mac"] . "\">" . $myrow["system_name"] . "</a></td>\n";
	echo "<td>" . $myrow["software_detect_date"] . "</td>\n";
	echo "<td>" . $myrow["software_name"] . "</td>\n";
	echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
    echo "</table>";
    echo "</div>";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr><td colspan=\"3\"><b>Total Packages: " . $count . "</b></td></tr>\n";
    echo "</table>";
    echo "</div>";
  } else {} 
} else {}
  
  
if ($show_patches_not_detected == "y"){
  $SQL = "DELETE FROM system_security_temp";
  $result = mysql_query($SQL, $db);
  $SQL = "insert into system_security_temp SELECT count(ss_qno) as count, ss_qno as qno from system_security WHERE (ss_status = 'NOT FOUND' OR ss_status = 'Warning') group by ss_qno";
  $result = mysql_query($SQL, $db);
  $SQL = "SELECT * FROM system_security_temp where qno <> '' order by count desc LIMIT " . $number_patches_not_detected;
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<div class=\"main_each\">\n";
    $count = 0;
    $bgcolor = "#FFFFFF";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr>\n";
    echo " <td class=\"contenthead\"><a href=\"javascript://\" onclick=\"switchUl('f5');\">Top  " . $number_patches_not_detected . " missing patches.</a></td>\n";
    echo " <td align=\"right\"><a href=\"javascript://\" onclick=\"switchUl('f5');\"><img src=\"" . $but_all . "\" width=\"16\" height=\"16\" border=\"0\" /></a></td>\n";
    echo "</tr>\n";
    echo "</table>";
    echo "<div style=\"display:none;\" id=\"f5\">";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr>\n";
    echo "<td width=\"150\" align=\"center\"><b>PCs without patch</b></td>\n";
    echo "<td width=\"150\" align=\"center\"><b>Q Number</b></td>\n";
    echo "<td width=\"150\" align=\"center\"><b>Link</b></td>\n";
    echo "</tr>\n";
    do {
      $count = $count + 1;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
      echo "<td align=\"center\"><a href=\"list_missing_patches.php?sub=sw1&amp;name=" . url_clean($myrow["qno"]) . "\" class=\"content\">" . $myrow["count"] . "</a></td>\n";
      echo "<td align=\"center\"><a href=\"list_missing_patches.php?sub=sw2&amp;name=" . url_clean($myrow["qno"]) . "\" class=\"content\">" . $myrow["qno"] . "</a></td>\n";
      echo "<td align=\"center\"><a href=\"http://www.google.com/search?num=30&amp;hl=en&amp;lr=lang_en&amp;ie=UTF-8&amp;oe=UTF-8&amp;safe=off&amp;q=%22" . $myrow["qno"] . "%22&amp;btnG=Search\"><img border=0 alt=\"Google Search\" title=\"Google Search\" src=\"images/button_kb.gif\" /></a></td>\n";
      echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
    echo "</table>";
    echo "</div>";
  } else {}
    echo "</div>";
} else {}



    echo "<div class=\"main_each\">\n";
    $count = 0;
    $bgcolor = "#FFFFFF";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr>\n";
    echo " <td class=\"contenthead\" colspan=\"4\"><a href=\"javascript://\" onclick=\"switchUl('f6');\">Web Servers Detected.</a></td>\n";
    echo " <td align=\"right\"><a href=\"javascript://\" onclick=\"switchUl('f6');\"><img src=\"" . $but_all . "\" width=\"16\" height=\"16\" border=\"0\" /></a></td>\n";
    echo "</tr>\n";
    echo "</table>";
    echo "<div style=\"display:none;\" id=\"f6\">";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr>\n";
    echo "<td width=\"150\"><b>IP Address</b></td>\n";
    echo "<td width=\"150\"><b>Name</b></td>\n";
    echo "</tr>";
  $SQL = "select sys.net_ip_address,sys.system_name,sys.net_mac_address from system sys, nmap_other_ports port where port.nmap_port_number = '80' AND port.nmap_other_id = sys.net_mac_address";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    do {
      $count = $count + 1;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>" . ip_trans($myrow["net_ip_address"]) . "&nbsp;</td>\n";
	echo "<td><a href=\"system_summary.php?pc=" . $myrow["net_mac_address"] . "&amp;sub=1\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
	echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
  } else {}

  $SQL = "select oth.other_id, oth.other_ip, oth.other_name, oth.other_mac_address from other oth, nmap_other_ports port where port.nmap_port_number = '80' AND port.nmap_other_id = oth.other_mac_address";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    if ($bgcolor == "#F1F1F1") {
      $bgcolor = "#FFFFFF"; }
    else { $bgcolor = "#F1F1F1"; }
    echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
    echo "<td width=\"150\"><b>IP Address</b></td>\n";
    echo "<td width=\"150\"><b>Name</b></td>\n";
    echo "</tr>";
    do {
      $count = $count + 1;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>" . ip_trans($myrow["other_ip"]) . "&nbsp;</td>\n";
	echo "<td><a href=\"other_summary.php?other=" . $myrow["other_id"] . "&amp;sub=1\">" . $myrow["other_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
	echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
  } else {}

  echo "</table>\n";
  echo "</div>\n";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
  echo "<tr><td colspan=\"3\"><b>Web Servers: " . $count . "</b></td></tr>\n";
  echo "</table>\n";
  echo "</div>\n";


  echo "<div class=\"main_each\">\n";
  $count = 0;
  $bgcolor = "#FFFFFF";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
  echo "<tr>\n";
  echo " <td class=\"contenthead\" colspan=\"4\"><a href=\"javascript://\" onclick=\"switchUl('f7');\">FTP Servers Detected.</a></td>\n";
  echo " <td align=\"right\"><a href=\"javascript://\" onclick=\"switchUl('f7');\"><img src=\"" . $but_all . "\" width=\"16\" height=\"16\" border=\"0\" /></a></td>\n";
  echo "</tr>\n";
  echo "</table>";
  echo "<div style=\"display:none;\" id=\"f7\">";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
  
  $SQL = "select sys.net_ip_address,sys.system_name,sys.net_mac_address from system sys, nmap_other_ports port where port.nmap_port_number = '21' AND port.nmap_other_id = sys.net_mac_address";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<tr>\n";
    echo "<td width=\"150\"><b>IP Address</b></td>\n";
    echo "<td width=\"150\"><b>Name</b></td>\n";
    echo "</tr>";
    do {
      $count = $count + 1;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>" . ip_trans($myrow["net_ip_address"]) . "&nbsp;</td>\n";
	echo "<td><a href=\"system_summary.php?pc=" . $myrow["net_mac_address"] . "&amp;sub=1\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
	echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
  } else {}

  $SQL = "select oth.other_id, oth.other_ip, oth.other_name, oth.other_mac_address from other oth, nmap_other_ports port where port.nmap_port_number = '21' AND port.nmap_other_id = oth.other_mac_address";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    if ($bgcolor == "#F1F1F1") {
      $bgcolor = "#FFFFFF"; }
    else { $bgcolor = "#F1F1F1"; }
    echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
    echo "<td width=\"150\"><b>IP Address</b></td>\n";
    echo "<td width=\"150\"><b>Name</b></td>\n";
    echo "</tr>";
    do {
      $count = $count + 1;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>" . ip_trans($myrow["other_ip"]) . "&nbsp;</td>\n";
	echo "<td><a href=\"other_summary.php?other=" . $myrow["other_id"] . "&amp;sub=1\">" . $myrow["other_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
	echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
  } else {}

  echo "</table>\n";
  echo "</div>\n";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
  echo "<tr><td colspan=\"3\"><b>FTP Servers: " . $count . "</b></td></tr>\n";
  echo "</table>\n";
  echo "</div>\n";
} else {


if ($sub == "1") { 
  $SQL = "SELECT * FROM system ORDER BY " . $sort . " LIMIT " . $page_count . "," . $count_system;
  $SQL_count = "SELECT DISTINCT system_uuid FROM system";
  $title = "List all Windows Systems.";
} else {}
if ($sub == "2") { 
  $SQL = "SELECT * FROM system ORDER BY " . $sort . " LIMIT " . $page_count . "," . $count_system;
  $SQL_count = "SELECT net_mac_address FROM system";
  $title = "List All PCs by Physical Memory.";
} else {}
if ($sub == "4") { 
  $SQL = "SELECT * FROM system WHERE system_os_name LIKE '%Server%' ORDER BY " . $sort . ", system_name LIMIT " . $page_count . "," . $count_system;
  $SQL_count = "SELECT * FROM system WHERE system_os_name LIKE '%Server%'";
  $title = "List all Servers.";
} else {}
if ($sub == "5") { 
  $SQL = "SELECT * FROM system WHERE (system_os_name LIKE 'Microsoft Windows 2000 Professional' OR system_os_name LIKE 'Microsoft Windows XP Professional') AND battery_description IS NULL ORDER BY " . $sort . ", system_name LIMIT " . $page_count . "," . $count_system;
  $SQL_count = "SELECT * FROM system WHERE (system_os_name LIKE 'Microsoft Windows 2000 Professional' OR system_os_name LIKE 'Microsoft Windows XP Professional') AND battery_description IS NULL";
  $title = "List All Desktop Systems.";
  } else {}
if ($sub == "6") { 
  $SQL = "select sys.net_mac_address,sys.net_ip_address,sys.system_name,cdkey.ms_keys_cd_key,cdkey.ms_keys_name from ms_keys cdkey, system sys where cdkey.ms_keys_key_type LIKE 'windows%' and  cdkey.ms_keys_mac_address = sys.net_mac_address ORDER BY " . $sort . ", sys.system_name LIMIT " . $page_count . "," . $count_system;
  $SQL_count = "select sys.net_mac_address,sys.net_ip_address,sys.system_name,cdkey.ms_keys_cd_key,cdkey.ms_keys_name from ms_keys cdkey, system sys where cdkey.ms_keys_key_type LIKE 'windows%' and  cdkey.ms_keys_mac_address = sys.net_mac_address";
  $title = "All MS Windows CD Keys.";
} else {}
if ($sub == "7") { 
  $SQL = "select sys.net_mac_address,sys.net_ip_address,sys.system_name,cdkey.ms_keys_cd_key,cdkey.ms_keys_name from ms_keys cdkey, system sys where cdkey.ms_keys_key_type LIKE 'office%' and  cdkey.ms_keys_mac_address = sys.net_mac_address ORDER BY " . $sort .", sys.system_name LIMIT " . $page_count . "," . $count_system; 
  $SQL_count = "select sys.net_mac_address,sys.net_ip_address,sys.system_name,cdkey.ms_keys_cd_key,cdkey.ms_keys_name from ms_keys cdkey, system sys where cdkey.ms_keys_key_type LIKE 'office%' and  cdkey.ms_keys_mac_address = sys.net_mac_address";
  $title = "All MS Office CD Keys.";
} else {}
if ($sub == "8") { 
    $SQL = "SELECT * FROM system WHERE (system_system_type = 'Laptop' OR system_system_type = 'Notebook' or system_system_type = 'Sub Notebook' OR system_system_type = 'Portable' OR system_system_type = 'Docking Station') ORDER BY " . $sort . ", system_name LIMIT " . $page_count . "," . $count_system;
    $SQL_count = "SELECT * FROM system WHERE (system_system_type = 'Laptop' OR system_system_type = 'Notebook' or system_system_type = 'Sub Notebook' OR system_system_type = 'Portable' OR system_system_type = 'Docking Station')";
    $title = "List All Laptop Systems.";
  } else {}
if ($sub == "9") { 
  $SQL = "SELECT * FROM system WHERE (system_os_name LIKE 'Microsoft Windows 2000 Professional' OR system_os_name LIKE 'Microsoft Windows XP Professional') ORDER BY " . $sort . ", system_name LIMIT " . $page_count . "," . $count_system;
  $SQL_count = "SELECT * FROM system WHERE (system_os_name LIKE 'Microsoft Windows 2000 Professional' OR system_os_name LIKE 'Microsoft Windows XP Professional')";
  $title = "List All Workstation OS Systems.";
  } else {}
if ($sub == "10"){ 
  $SQL = "select sys.net_mac_address,sys.net_ip_address,sys.system_name,cdkey.ms_keys_cd_key,cdkey.ms_keys_name from ms_keys cdkey, system sys where (cdkey.ms_keys_key_type NOT LIKE 'office%' AND cdkey.ms_keys_key_type NOT LIKE 'windows%') AND cdkey.ms_keys_mac_address = sys.net_mac_address ORDER BY " . $sort .", sys.system_name";
  $SQL_count = "select sys.net_mac_address,sys.net_ip_address,sys.system_name,cdkey.ms_keys_cd_key,cdkey.ms_keys_name from ms_keys cdkey, system sys where (cdkey.ms_keys_key_type NOT LIKE 'office%' AND cdkey.ms_keys_key_type NOT LIKE 'windows%') AND cdkey.ms_keys_mac_address = sys.net_mac_address";
  $title = "All Other CD Keys.";
} else {}
if ($sub == "11"){ 
  $SQL = "select * from system where system_name LIKE '%" . $_POST["system_name"] . "%' ORDER BY system_name";
  $SQL_count = "select net_mac_address from system where system_name LIKE '%" . $_POST["system_name"] . "%'";
  $title = "Systems with name like " . $_POST["system_name"] . ".";
} else {}

echo "<div class=\"main_each\">";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
echo "<tr><td align=\"left\" class=\"contenthead\" >" . $title . "<br />&nbsp;</td>\n";
if ($count_system <> "10000"){
  echo "<td align=\"right\">\n";
  echo "<a href=\"index.php?sub=" . $sub . "&amp;page_count=" . $page_prev . "&amp;sort=" . $sort . "\"><img src=\"" . $but_bac . "\" alt=\"Previous " . $count_system . " Systems\" title=\"Previous " . $count_system . " Systems\" border=\"0\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
  echo "<a href=\"index.php?sub=" . $sub . "&amp;page_count=0&amp;show_all=1&amp;sort=" . $sort . "\"><img src=\"" . $but_all . "\" alt=\"All Systems\" title=\"All Systems\" border=\"0\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
  echo "<a href=\"index.php?sub=" . $sub . "&amp;page_count=" . $page_next . "&amp;sort=" . $sort . "\"><img src=\"" . $but_for . "\" alt=\"Next " . $count_system . " Systems\" title=\"Next " . $count_system . " Systems\" border=\"0\" width=\"16\" height=\"16\" /></a>&nbsp;<br />&nbsp;</td>\n"; 
} else {}
echo "</tr></table>\n";

if (($sub == "1") OR ($sub == "2") OR ($sub == "4") OR ($sub == "5") OR ($sub == "8")  OR ($sub == "11") OR ($sub == "9")){
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">";
    echo "<tr>\n";
    if ($show_mac == "y")          { echo "<td align=\"center\"><a href=\"index.php?sub=" . $sub . "&amp;sort=net_mac_address&amp;page_count=" . $page_current . "\">MAC Address</a></td>\n"; } else {}
    echo "<td align=\"center\"><a href=\"index.php?sub=" . $sub . "&amp;sort=net_ip_address&amp;page_count=" . $page_current . "\">IP Address</a></td>\n";
    echo "<td align=\"center\"><a href=\"index.php?sub=" . $sub . "&amp;sort=system_name&amp;page_count=" . $page_current . "\">Name</a></td>\n";
    if ($show_os == "y")           { echo "<td align=\"center\"><a href=\"index.php?sub=" . $sub . "&amp;sort=system_os_name&amp;page_count=" . $page_current . "\">OS</a></td>\n"; } else {}
    if ($show_date_audited == "y") { echo "<td align=\"center\"><a href=\"index.php?sub=" . $sub . "&amp;sort=date_audited&amp;page_count=" . $page_current . "\">Date Audited</a></td>\n"; } else {}
    if ($show_type == "y")         { echo "<td align=\"center\"><a href=\"index.php?sub=" . $sub . "&amp;sort=system_system_type&amp;page_count=" . $page_current . "\">&nbsp;System Type&nbsp;</a></td>\n"; } else {}
    if (($show_description == "y") AND ($sub <> "8"))  { echo "<td align=\"center\"><a href=\"index.php?sub=" . $sub . "&amp;sort=system_description&amp;page_count=" . $page_current . "\">&nbsp;System Description&nbsp;</a></td>\n"; } else {}
	if ($show_domain == "y") { echo "<td align=\"center\"><a href=\"index.php?sub=" . $sub . "&amp;sort=net_domain\">&nbsp;Domain&nbsp;</a></td>\n"; } else {}
	if ($show_service_pack == "y") { echo "<td align=\"center\"><a href=\"index.php?sub=" . $sub . "&amp;sort=system_service_pack\">&nbsp;Service Pack&nbsp;</a></td>\n"; } else {}
    if ($sub == "2") { echo "<td align=\"center\"><a href=\"index.php?sub=" . $sub . "&amp;sort=system_memory\">&nbsp;Memory&nbsp;</a></td>\n"; } else {}
    if ($sub == "8") { echo "<td align=\"center\"><a href=\"index.php?sub=" . $sub . "&amp;sort=system_vendor\">&nbsp;Vendor&nbsp;</a></td>\n"; } else {}
    if ($sub == "8") { echo "<td align=\"center\"><a href=\"index.php?sub=" . $sub . "&amp;sort=system_model\">&nbsp;Model&nbsp;</a></td>\n"; } else {}
    echo "</tr>\n";
    do {
      $os_name = determine_os($myrow["system_os_name"]);
      $img = determine_img($myrow["system_os_name"],$myrow["system_system_type"]);

      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }

      echo "<tr>";
      if ($show_mac == "y")          { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;<a href=\"system_summary.php?pc=" . $myrow["net_mac_address"] . "&amp;sub=all\">" . $myrow["net_mac_address"] . "&nbsp;&nbsp;</td>\n"; } else {}
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . ip_trans($myrow["net_ip_address"]) . "&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;<a href=\"system_summary.php?pc=" . $myrow["system_uuid"] . "&amp;sub=all\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;</td>\n";
      if ($show_os == "y")           { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $os_name . "&nbsp;&nbsp;</td>\n"; } else {}
      if ($show_date_audited == "y") { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . substr($myrow["date_audited"],0,10) . "&nbsp;&nbsp;</td>\n"; } else {}
      if ($show_type == "y")         { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $img . "&nbsp;&nbsp;</td>\n"; } else {}
      if (($show_description == "y") AND ($sub <> "8"))  { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow["system_description"] . "&nbsp;&nbsp;</td>\n"; } else {}
      if ($show_domain == "y")       { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow["net_domain"] . "&nbsp;&nbsp;</td>\n"; } else {}
      if ($show_service_pack == "y")       { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow["system_service_pack"] . "&nbsp;&nbsp;</td>\n"; } else {}
      if ($sub == "2")               { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow["system_memory"] . "&nbsp;&nbsp;</td>\n"; } else {}
      if ($sub == "8") {
	    echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow["system_vendor"] . "&nbsp;&nbsp;</td>\n";
        if ($myrow["system_vendor"] == "IBM") {
          $model = "<a href=\"http://www-307.ibm.com/pc/support/site.wss/quickPath.do?quickPathEntry=" . $myrow["system_model"] . "\">" . $myrow["system_model"] . "</a>"; }
        else {}
        if ($myrow["system_vendor"] == "Dell Computer Corporation") {
          $model = "<a href=\"http://search.dell.com/results.aspx?c=us&l=en&s=bsd&cat=sup&cs=04&k=%22" . $myrow["system_model"] . "%22&img=True&sum=True&ssum=False&qmp=10\">" . $myrow["system_model"] . "</a>"; }
        else {  }
        if ($myrow["system_vendor"] == "FUJITSU SIEMENS") {
          $model = "<a href=\"http://www.computers.us.fujitsu.com/www/products_notebooks.shtml?products/notebooks/tech_specs/" . $myrow["system_model"] . "_ts\">" . $myrow["system_model"] . "</a>"; }
        else {  }
        if ($myrow["system_vendor"] == "Hewlett-Packard") {
          $model = "<a href=\"http://search.hp.com/query.html?hpvc=US+-+English&amp;lang=en&amp;submit.x=0&amp;submit.y=0&amp;qt=%22" . $myrow["system_model"] . "HP+OmniBook+PC%22&amp;la=en&amp;cc=us\">" . $myrow["system_model"] . "</a>"; }
        else {  }
        if ($myrow["system_vendor"] == "Sony Corporation") {
          $model = "<a href=\"http://esupport.sony.com/perl/select-p-n.pl\">" . $myrow["system_model"] . "</a>"; }
        else {  }
        if ($model == "") {
          $model = $myrow["system_model"]; }
        else {}
        echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;" . $model . "&nbsp;</td>\n";
        $model = "";
      } else {}	  
      echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
	$total = mysql_query($SQL_count, $db);
	$num_rows = mysql_num_rows($total);
    echo "<tr><td colspan=\"2\"><br /><b>Total Computers: " . $num_rows . "</b></td></tr>\n";
	echo "</table>";
    $show_icons = 1;
  } 
  else {
    echo "No Systems have been audited.\n";
    $show_icons = 0;
  }
} else {}


if (($sub == "6") OR ($sub == "7") OR ($sub == "10")){
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
    echo "<tr>\n";
    echo "<td align=\"center\"><a href=\"index.php?sub=" . $sub . "&amp;sort=sys.net_ip_address\" class=\"content\">IP Address </a></td>\n";
    echo "<td align=\"center\"><a href=\"index.php?sub=" . $sub . "&amp;sort=sys.system_name\" class=\"content\">Name</a></td>\n";
    echo "<td align=\"center\"><a href=\"index.php?sub=" . $sub . "&amp;sort=cdkey.ms_keys_name\" class=\"content\">Package</a></td>\n";
    echo "<td align=\"center\"><a href=\"index.php?sub=" . $sub . "&amp;sort=cdkey.ms_keys_cd_key\" class=\"content\">CD Key</a></td>\n";
    echo "</tr>\n";
    do {
	  $os = determine_os($myrow["ms_keys_name"]);
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo "<tr bgcolor=\"" . $bgcolor . "\">";
      echo "<td align=\"center\">&nbsp;&nbsp;" . ip_trans($myrow["net_ip_address"]) . "&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\">&nbsp;&nbsp;<a href=\"system_summary.php?pc=" . $myrow["net_mac_address"] . "&amp;sub=all\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\">&nbsp;&nbsp;" . $myrow["ms_keys_name"] . "&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\">&nbsp;&nbsp;" . $myrow["ms_keys_cd_key"] . "&nbsp;&nbsp;</td>\n";
      echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
	echo "</table>\n";
    $show_icons = 1;
  } 
  else 
  {
    echo "No CD Keys have been detected.";
    echo "</table>";
    $show_icons = 0;
  }
} else {}


if ($show_icons == 1) {
echo "<br />";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
  echo "<tr>";
  if (($sub <> "6") AND ($sub <> "7") AND ($sub <> "10")) {
    echo "<td align=\"left\">";
	echo "<img src=\"images/inv_small_desktop.png\" width=\"22\" height=\"22\" alt=\"\" /> - Desktop PCs";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<img src=\"images/inv_small_laptop.png\" width=\"22\" height=\"22\" alt=\"\" /> - Laptop PCs";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<img src=\"images/inv_small_server.png\" width=\"22\" height=\"22\" alt=\"\" /> - Servers</td>\n";
  } else {}
  if ($count_system <> "10000"){
    echo "<td align=\"right\">\n";
    echo "<a href=\"index.php?sub=" . $sub . "&amp;page_count=" . $page_prev . "&amp;sort=" . $sort . "\"><img src=\"" . $but_bac . "\" alt=\"Previous " . $count_system . " Systems\" title=\"Previous " . $count_system . " Systems\" border=\"0\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
    echo "<a href=\"index.php?sub=" . $sub . "&amp;page_count=0&amp;show_all=1&amp;sort=" . $sort . "\"><img src=\"" . $but_all . "\" alt=\"All Systems\" title=\"All Systems\" border=\"0\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
    echo "<a href=\"index.php?sub=" . $sub . "&amp;page_count=" . $page_next . "&amp;sort=" . $sort . "\"><img src=\"" . $but_for . "\" alt=\"Next " . $count_system . " Systems\" title=\"Next " . $count_system . " Systems\" border=\"0\" width=\"16\" height=\"16\" /></a>&nbsp;</td>\n"; 
  } else {}
  echo "</tr>\n";
  echo "</table>\n";
} else {}
echo "</div>\n";
}
include "include_png_replace.php";

function adjustdate($years=0,$months=0,$days=0) 
{
  $todayyear=date('Y');
  $todaymonth=date('m');
  $todayday=date('d');
  return date("Y-m-d",mktime(0,0,0,$todaymonth+$months,$todayday+$days,$todayyear+ $years));
}

?>
</body>
</html> 