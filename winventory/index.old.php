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


if ($show_other_discovered == "y") {
  $SQL = "SELECT * FROM other WHERE (other_mac_address <> '' AND other_date_detected > '" . adjustdate(0,0,-$other_detected) . "') ORDER BY other_ip";
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
	  echo "<td>" . ip_trans($myrow["other_ip"]) . "&nbsp;</td>\n";
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
  $sql = "SELECT system_name, net_ip_address, system_uuid, MIN(system_timestamp) FROM system GROUP BY system_uuid HAVING MIN(system_timestamp) > '" . adjustdate(0,0,-$system_detected) . "000000' ORDER BY system_name";
  $result = mysql_query($sql, $db);
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
    echo "<td><b>IP Address</b></td>\n";
    echo "<td><b>System Name</b></td>\n";
    echo "<td><b>Audit Date &amp; Time</b></td>\n";
    echo "</tr>\n";
    do {
      $sys_uuid = $myrow["system_uuid"];    
      $sql2 = "SELECT system_name FROM system where system_timestamp = (SELECT MAX(system_timestamp) FROM system WHERE system_uuid = '$sys_uuid') AND system_uuid = '$sys_uuid'";
      $result2 = mysql_query($sql2, $db);
      $myrow2 = mysql_fetch_array($result2);
      $sys_name = $myrow2["system_name"];
      $count = $count + 1;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>" . ip_trans($myrow["net_ip_address"]) . "</td>\n";
	echo "<td><a href=\"system_summary.php?pc=" . $myrow["system_uuid"] . "\">$sys_name</a></td>\n";
	echo "<td>" . substr($myrow["MIN(system_timestamp)"],0,4) . "-" . substr($myrow["MIN(system_timestamp)"],4,2) . "-" . substr($myrow["MIN(system_timestamp)"],6,2) . "&nbsp;&nbsp;&nbsp;" . substr($myrow["MIN(system_timestamp)"],8,2) . ":" . substr($myrow["MIN(system_timestamp)"],10,2) . "</td>\n";
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
  $sql = "SELECT system_name, net_ip_address, system_uuid, MAX(system_timestamp) FROM system GROUP BY system_uuid HAVING MAX(system_timestamp) < '" . adjustdate(0,0,-$days_systems_not_audited) . "000000' ORDER BY system_name";
  $result = mysql_query($sql, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<div class=\"main_each\">\n";
    $count = 0;
    $bgcolor = "#FFFFFF";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
    echo "<tr>\n";
    echo "  <td class=\"contenthead\" colspan=\"3\"><a href=\"javascript://\" onclick=\"switchUl('f2');\">Systems not audited in the last " . $days_systems_not_audited . " days.</a></td>\n";
    echo "  <td align=\"right\"><a href=\"javascript://\" onclick=\"switchUl('f2');\"><img src=\"" . $but_all . "\" width=\"16\" height=\"16\" border=\"0\" /></a></td>\n";
    echo "</tr>\n";
    echo "</table>";
    echo "<div style=\"display:none;\" id=\"f2\">";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr>\n";
    echo "<td><b>IP Address</b></td>\n";
    echo "<td><b>System Name</b></td>\n";
    echo "<td><b>Audit Date</b></td>\n";
    echo "<td><b>Audit Time</b></td>\n";
    echo "</tr>\n";
    do {
      $count = $count + 1;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>" . ip_trans($myrow["net_ip_address"]) . "</td>\n";
	echo "<td><a href=\"system_summary.php?pc=" . $myrow["system_uuid"] . "\">" . $myrow["system_name"] . "</a></td>\n";
	echo "<td>" . substr($myrow["MAX(system_timestamp)"],0,4) . "-" . substr($myrow["MAX(system_timestamp)"],4,2) . "-" . substr($myrow["MAX(system_timestamp)"],6,2) . "</td>\n";
	echo "<td>" . substr($myrow["MAX(system_timestamp)"],8,2) . ":" . substr($myrow["MAX(system_timestamp)"],10,2) . "</td>\n";
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
  
if ($show_partition_usage == "y") {
  $SQL = "SELECT sys.system_name, sys.net_ip_address, par.partition_uuid, par.partition_volume_name, par.partition_caption, par.partition_free_space, par.partition_size, MAX(par.partition_timestamp) FROM system sys, partition par WHERE par.partition_free_space < '$partition_free_space' AND sys.system_uuid = par.partition_uuid GROUP BY par.partition_device_id ORDER BY sys.system_name";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<div class=\"main_each\">\n";
    $count = 0;
    $bgcolor = "#FFFFFF";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr>\n";
    echo "  <td class=\"contenthead\"><a href=\"javascript://\" onclick=\"switchUl('f3');\">Partition free space less than $partition_free_space MB.</a></td>\n";
    echo "  <td align=\"right\"><a href=\"javascript://\" onclick=\"switchUl('f3');\"><img src=\"" . $but_all . "\" width=\"16\" height=\"16\" border=\"0\" /></a></td>\n";
    echo "</tr>\n";
    echo "</table>";
    echo "<div style=\"display:none;\" id=\"f3\">";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr>\n";
    echo "<td width=\"150\"><b>IP Address</b></td>\n";
    echo "<td width=\"150\"><b>System Name</b></td>\n";
    echo "<td width=\"130\"><b>Free MB</b></td>\n";
    echo "<td width=\"130\"><b>Size</b></td>\n";
    echo "<td width=\"120\"><b>Free %</b></td>\n";
    echo "<td width=\"100\"><b>Letter</b></td>\n";
    echo "<td width=\"150\"><b>Name</b></td>\n";
    echo "</tr>\n";
    do {
      $count = $count + 1;
      $percent_free = round((($myrow["partition_free_space"] / $myrow["partition_size"]) * 100),1);
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>" . ip_trans($myrow["net_ip_address"]) . "</td>\n";
	echo "<td><a href=\"system_summary.php?pc=" . $myrow["partition_uuid"] . "\">" . $myrow["system_name"] . "</a></td>\n";
    echo "<td>" . $myrow["partition_free_space"] . " Mb</td>\n";
    echo "<td>" . $myrow["partition_size"] . " Mb</td>\n";
	echo "<td>" . $percent_free . " %</td>\n";
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
  $SQL = "SELECT MIN(system_timestamp), system_name, net_ip_address, system_uuid FROM system GROUP BY system_name";
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
      if ($myrow["MIN(system_timestamp)"] < (adjustdate(0,0,-$days_software_detected) . "000000")) { 
        $sql2 = "SELECT software_uuid, software_first_timestamp, software_name FROM software WHERE software_uuid = '" . $myrow["system_uuid"] . "' AND software_first_timestamp >= '" . adjustdate(0,0,-$days_software_detected) . "000000' AND software_name NOT LIKE '%Hotfix%' AND software_name NOT LIKE '%Update%'";
        $result2 = mysql_query($sql2, $db);
        if ($myrow2 = mysql_fetch_array($result2)){
          do {
            $count = $count + 1;
            if ($bgcolor == "#F1F1F1") {
              $bgcolor = "#FFFFFF"; }
            else { $bgcolor = "#F1F1F1"; }
	        echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	        echo "<td>" . ip_trans($myrow["net_ip_address"]) . "</td>\n";
	        echo "<td><a href=\"system_summary.php?pc=" . $myrow2["software_uuid"] . "\">" . $myrow["system_name"] . "</a></td>\n";
	        echo "<td>" . return_date($myrow2["software_first_timestamp"]) . "</td>\n";
	        echo "<td>" . $myrow2["software_name"] . "</td>\n";
	        echo "</tr>\n";
          } while ($myrow2 = mysql_fetch_array($result2));
        } else {}
      } else {}
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

if ($show_detected_servers == "y"){








  //// WEB Servers Detected
  echo "<div class=\"main_each\">\n";
  $count = 0;
  $bgcolor = "#FFFFFF";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
  echo "<tr>\n";
  echo " <td class=\"contenthead\" colspan=\"4\"><a href=\"javascript://\" onclick=\"switchUl('f6');\">WEB Servers Detected.</a></td>\n";
  echo " <td align=\"right\"><a href=\"javascript://\" onclick=\"switchUl('f6');\"><img src=\"" . $but_all . "\" width=\"16\" height=\"16\" border=\"0\" /></a></td>\n";
  echo "</tr>\n";
  echo "</table>";
  echo "<div style=\"display:none;\" id=\"f6\">";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
  echo "<tr><td colspan=\"2\"><b>Service Detected</b></td></tr>";
  echo "<tr>\n";
  echo "<td><b>IP Address</b></td>\n";
  echo "<td><b>Name</b></td>\n";
  echo "<td><b>Service</b></td>\n";
  echo "<td><b>Running</b></td>\n";
  echo "</tr>";
  $SQL = "SELECT service_uuid, MAX(service_timestamp) AS timestamp FROM service GROUP BY service_uuid";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    do {
      // Service Detected
      $sql2 = "SELECT service_uuid, service_display_name, service_started FROM service WHERE (service_display_name LIKE 'IIS Admin%' OR service_display_name LIKE 'Apache%') AND service_timestamp = '" . $myrow["timestamp"] . "' AND service_uuid = '" . $myrow["service_uuid"] . "'";
      $result2 = mysql_query($sql2, $db);
      if ($myrow2 = mysql_fetch_array($result2)){
        do {
          if ($bgcolor == "#F1F1F1") {
            $bgcolor = "#FFFFFF"; }
          else { $bgcolor = "#F1F1F1"; }
          $SQL3 = "SELECT net_ip_address, system_name FROM system WHERE system_uuid = '" . $myrow2["service_uuid"] . "' AND system_timestamp = '" . $myrow["timestamp"] . "'";
          $result3 = mysql_query($SQL3, $db);
          $myrow3 = mysql_fetch_array($result3);
          $count = $count + 1;
          echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
          echo "<td>" . ip_trans($myrow3["net_ip_address"]) . "&nbsp;</td>\n";
          echo "<td><a href=\"system_summary.php?pc=" . $myrow2["service_uuid"] . "&amp;sub=1\">" . $myrow3["system_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
          echo "<td>" . $myrow2["service_display_name"] . "</td>\n";
          echo "<td>" . $myrow2["service_started"] . "</td>\n";
          echo "</tr>\n";
        } while ($myrow2 = mysql_fetch_array($result2));
      } else {}
    } while ($myrow = mysql_fetch_array($result));
    echo "<tr><td><br />&nbsp;</td></tr>\n";
  } else {}
  // Nmap discovered on Audited PC
  $SQL = "select sys.net_ip_address,sys.system_name,sys.system_uuid from system sys, nmap_other_ports port where port.nmap_port_number = '80' AND port.nmap_other_id = sys.system_uuid";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<tr><td colspan=\"2\"><b>Nmap discovered on Audited PC</b></td></tr>";
    echo "<tr>\n";
    echo "<td width=\"150\"><b>IP Address</b></td>\n";
    echo "<td width=\"150\"><b>Name</b></td>\n";
    echo "</tr>\n";
    do {
      $count = $count + 1;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>" . ip_trans($myrow["net_ip_address"]) . "&nbsp;</td>\n";
	echo "<td><a href=\"system_summary.php?pc=" . $myrow["system_uuid"] . "&amp;sub=1\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
    echo "<td></td>\n";
	echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
    echo "<tr><td><br />&nbsp;</td></tr>\n";
  } else {}
  // Nmap discovered on Other equipment
  $SQL = "select oth.other_id, oth.other_ip, oth.other_name, oth.other_mac_address from other oth, nmap_other_ports port where port.nmap_port_number = '80' AND port.nmap_other_id = oth.other_mac_address";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    if ($bgcolor == "#F1F1F1") {
      $bgcolor = "#FFFFFF"; }
    else { $bgcolor = "#F1F1F1"; }
    echo "<tr><td colspan=\"2\"><b>Nmap discovered on Other equipment</b></td></tr>\n";
    echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
    echo "<td width=\"150\"><b>IP Address</b></td>\n";
    echo "<td width=\"150\"><b>Name</b></td>\n";
    echo "</tr>\n";
    do {
      $count = $count + 1;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>" . ip_trans($myrow["other_ip"]) . "&nbsp;</td>\n";
	echo "<td><a href=\"other_summary.php?other=" . $myrow["other_id"] . "&amp;sub=1\">" . $myrow["other_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
    echo "<td></td>\n";
	echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
    echo "<tr><td><br />&nbsp;</td></tr>\n";
  } else {}
  echo "</table>\n";
  echo "</div>\n";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
  echo "<tr><td colspan=\"3\"><b>Web Servers: " . $count . "</b></td></tr>\n";
  echo "</table>\n";
  echo "</div>\n";













  //// FTP Servers Detected
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
  echo "<tr><td colspan=\"2\"><b>Service Detected</b></td></tr>";
  echo "<tr>\n";
  echo "<td><b>IP Address</b></td>\n";
  echo "<td><b>Name</b></td>\n";
  echo "<td><b>Service</b></td>\n";
  echo "<td><b>Running</b></td>\n";
  echo "</tr>";
  $SQL = "SELECT service_uuid, MAX(service_timestamp) AS timestamp FROM service GROUP BY service_uuid";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    do {
      // Service Detected
      $sql2 = "SELECT service_uuid, service_display_name, service_started FROM service WHERE service_display_name = 'FTP Publishing Service' AND service_timestamp = '" . $myrow["timestamp"] . "' AND service_uuid = '" . $myrow["service_uuid"] . "'";
      $result2 = mysql_query($sql2, $db);
      if ($myrow2 = mysql_fetch_array($result2)){
        do {
          if ($bgcolor == "#F1F1F1") {
            $bgcolor = "#FFFFFF"; }
          else { $bgcolor = "#F1F1F1"; }
          $SQL3 = "SELECT net_ip_address, system_name FROM system WHERE system_uuid = '" . $myrow2["service_uuid"] . "' AND system_timestamp = '" . $myrow["timestamp"] . "'";
          $result3 = mysql_query($SQL3, $db);
          $myrow3 = mysql_fetch_array($result3);
          $count = $count + 1;
          echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
          echo "<td>" . ip_trans($myrow3["net_ip_address"]) . "&nbsp;</td>\n";
          echo "<td><a href=\"system_summary.php?pc=" . $myrow2["service_uuid"] . "&amp;sub=1\">" . $myrow3["system_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
          echo "<td>" . $myrow2["service_display_name"] . "</td>\n";
          echo "<td>" . $myrow2["service_started"] . "</td>\n";
          echo "</tr>\n";
        } while ($myrow2 = mysql_fetch_array($result2));
      } else {}
    } while ($myrow = mysql_fetch_array($result));
    echo "<tr><td><br />&nbsp;</td></tr>\n";
  } else {}
  // Nmap discovered on Audited PC
  $SQL = "select sys.net_ip_address,sys.system_name,sys.system_uuid from system sys, nmap_other_ports port where port.nmap_port_number = '21' AND port.nmap_other_id = sys.system_uuid";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<tr><td colspan=\"2\"><b>Nmap discovered on Audited PC</b></td></tr>";
    echo "<tr>\n";
    echo "<td width=\"150\"><b>IP Address</b></td>\n";
    echo "<td width=\"150\"><b>Name</b></td>\n";
    echo "</tr>\n";
    do {
      $count = $count + 1;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>" . ip_trans($myrow["net_ip_address"]) . "&nbsp;</td>\n";
	echo "<td><a href=\"system_summary.php?pc=" . $myrow["system_uuid"] . "&amp;sub=1\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
    echo "<td></td>\n";
	echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
    echo "<tr><td><br />&nbsp;</td></tr>\n";
  } else {}
  // Nmap discovered on Other equipment
  $SQL = "select oth.other_id, oth.other_ip, oth.other_name, oth.other_mac_address from other oth, nmap_other_ports port where port.nmap_port_number = '21' AND port.nmap_other_id = oth.other_mac_address";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    if ($bgcolor == "#F1F1F1") {
      $bgcolor = "#FFFFFF"; }
    else { $bgcolor = "#F1F1F1"; }
    echo "<tr><td colspan=\"2\"><b>Nmap discovered on Other equipment</b></td></tr>\n";
    echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
    echo "<td width=\"150\"><b>IP Address</b></td>\n";
    echo "<td width=\"150\"><b>Name</b></td>\n";
    echo "</tr>\n";
    do {
      $count = $count + 1;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>" . ip_trans($myrow["other_ip"]) . "&nbsp;</td>\n";
	echo "<td><a href=\"other_summary.php?other=" . $myrow["other_id"] . "&amp;sub=1\">" . $myrow["other_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
    echo "<td></td>\n";
	echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
    echo "<tr><td><br />&nbsp;</td></tr>\n";
  } else {}
  echo "</table>\n";
  echo "</div>\n";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
  echo "<tr><td colspan=\"3\"><b>FTP Servers: " . $count . "</b></td></tr>\n";
  echo "</table>\n";
  echo "</div>\n";












  //// Telnet Servers Detected
  echo "<div class=\"main_each\">\n";
  $count = 0;
  $bgcolor = "#FFFFFF";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
  echo "<tr>\n";
  echo " <td class=\"contenthead\" colspan=\"4\"><a href=\"javascript://\" onclick=\"switchUl('f8');\">Active Telnet Servers Detected.</a></td>\n";
  echo " <td align=\"right\"><a href=\"javascript://\" onclick=\"switchUl('f8');\"><img src=\"" . $but_all . "\" width=\"16\" height=\"16\" border=\"0\" /></a></td>\n";
  echo "</tr>\n";
  echo "</table>";
  echo "<div style=\"display:none;\" id=\"f8\">";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
  echo "<tr><td colspan=\"2\"><b>Service Detected and Started</b></td></tr>";
  echo "<tr>\n";
  echo "<td><b>IP Address</b></td>\n";
  echo "<td><b>Name</b></td>\n";
  echo "<td><b>Service</b></td>\n";
  echo "<td><b>Running</b></td>\n";
  echo "</tr>";
  $SQL = "SELECT service_uuid, MAX(service_timestamp) AS timestamp FROM service GROUP BY service_uuid";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    do {
      // Service Detected and Started
      $sql2 = "SELECT service_uuid, service_display_name, service_started FROM service WHERE service_display_name = 'Telnet' AND service_started = 'True' AND service_timestamp = '" . $myrow["timestamp"] . "' AND service_uuid = '" . $myrow["service_uuid"] . "'";
      $result2 = mysql_query($sql2, $db);
      if ($myrow2 = mysql_fetch_array($result2)){
        do {
          if ($bgcolor == "#F1F1F1") {
            $bgcolor = "#FFFFFF"; }
          else { $bgcolor = "#F1F1F1"; }
          $SQL3 = "SELECT net_ip_address, system_name FROM system WHERE system_uuid = '" . $myrow2["service_uuid"] . "' AND system_timestamp = '" . $myrow["timestamp"] . "'";
          $result3 = mysql_query($SQL3, $db);
          $myrow3 = mysql_fetch_array($result3);
          $count = $count + 1;
          echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
          echo "<td>" . ip_trans($myrow3["net_ip_address"]) . "&nbsp;</td>\n";
          echo "<td><a href=\"system_summary.php?pc=" . $myrow2["service_uuid"] . "&amp;sub=1\">" . $myrow3["system_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
          echo "<td>" . $myrow2["service_display_name"] . "</td>\n";
          echo "<td>" . $myrow2["service_started"] . "</td>\n";
          echo "</tr>\n";
        } while ($myrow2 = mysql_fetch_array($result2));
      } else {}
    } while ($myrow = mysql_fetch_array($result));
    echo "<tr><td><br />&nbsp;</td></tr>\n";
  } else {}
  // Nmap discovered on Audited PC
  $SQL = "select sys.net_ip_address,sys.system_name,sys.system_uuid from system sys, nmap_other_ports port where port.nmap_port_number = '23' AND port.nmap_other_id = sys.system_uuid";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<tr><td colspan=\"2\"><b>Nmap discovered on Audited PC</b></td></tr>";
    echo "<tr>\n";
    echo "<td width=\"150\"><b>IP Address</b></td>\n";
    echo "<td width=\"150\"><b>Name</b></td>\n";
    echo "</tr>\n";
    do {
      $count = $count + 1;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>" . ip_trans($myrow["net_ip_address"]) . "&nbsp;</td>\n";
	echo "<td><a href=\"system_summary.php?pc=" . $myrow["system_uuid"] . "&amp;sub=1\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
    echo "<td></td>\n";
	echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
    echo "<tr><td><br />&nbsp;</td></tr>\n";
  } else {}
  // Nmap discovered on Other equipment
  $SQL = "select oth.other_id, oth.other_ip, oth.other_name, oth.other_mac_address from other oth, nmap_other_ports port where port.nmap_port_number = '23' AND port.nmap_other_id = oth.other_mac_address";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    if ($bgcolor == "#F1F1F1") {
      $bgcolor = "#FFFFFF"; }
    else { $bgcolor = "#F1F1F1"; }
    echo "<tr><td colspan=\"2\"><b>Nmap discovered on Other equipment</b></td></tr>\n";
    echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
    echo "<td width=\"150\"><b>IP Address</b></td>\n";
    echo "<td width=\"150\"><b>Name</b></td>\n";
    echo "</tr>\n";
    do {
      $count = $count + 1;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>" . ip_trans($myrow["other_ip"]) . "&nbsp;</td>\n";
	echo "<td><a href=\"other_summary.php?other=" . $myrow["other_id"] . "&amp;sub=1\">" . $myrow["other_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
    echo "<td></td>\n";
	echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
    echo "<tr><td><br />&nbsp;</td></tr>\n";
  } else {}
  echo "</table>\n";
  echo "</div>\n";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
  echo "<tr><td colspan=\"3\"><b>Telnet Servers: " . $count . "</b></td></tr>\n";
  echo "</table>\n";
  echo "</div>\n";











  //// Email Servers Detected
  echo "<div class=\"main_each\">\n";
  $count = 0;
  $bgcolor = "#FFFFFF";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
  echo "<tr>\n";
  echo " <td class=\"contenthead\" colspan=\"4\"><a href=\"javascript://\" onclick=\"switchUl('f9');\">Email Servers Detected.</a></td>\n";
  echo " <td align=\"right\"><a href=\"javascript://\" onclick=\"switchUl('f9');\"><img src=\"" . $but_all . "\" width=\"16\" height=\"16\" border=\"0\" /></a></td>\n";
  echo "</tr>\n";
  echo "</table>";
  echo "<div style=\"display:none;\" id=\"f9\">";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
  echo "<tr><td colspan=\"2\"><b>Service Detected</b></td></tr>";
  echo "<tr>\n";
  echo "<td><b>IP Address</b></td>\n";
  echo "<td><b>Name</b></td>\n";
  echo "<td><b>Service</b></td>\n";
  echo "<td><b>Running</b></td>\n";
  echo "</tr>";
  $SQL = "SELECT service_uuid, MAX(service_timestamp) AS timestamp FROM service GROUP BY service_uuid";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    do {
      // Service Detected
      $sql2 = "SELECT service_uuid, service_display_name, service_started FROM service WHERE (service_display_name = 'Microsoft Exchange Information Store' OR service_display_name = 'Simple Mail Transport Protocol (SMTP)' OR service_display_name = 'Simple Mail Transfer Protocol (SMTP)') AND service_timestamp = '" . $myrow["timestamp"] . "' AND service_uuid = '" . $myrow["service_uuid"] . "'";
      $result2 = mysql_query($sql2, $db);
      if ($myrow2 = mysql_fetch_array($result2)){
        do {
          if ($bgcolor == "#F1F1F1") {
            $bgcolor = "#FFFFFF"; }
          else { $bgcolor = "#F1F1F1"; }
          $SQL3 = "SELECT net_ip_address, system_name FROM system WHERE system_uuid = '" . $myrow2["service_uuid"] . "' AND system_timestamp = '" . $myrow["timestamp"] . "'";
          $result3 = mysql_query($SQL3, $db);
          $myrow3 = mysql_fetch_array($result3);
          $count = $count + 1;
          echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
          echo "<td>" . ip_trans($myrow3["net_ip_address"]) . "&nbsp;</td>\n";
          echo "<td><a href=\"system_summary.php?pc=" . $myrow2["service_uuid"] . "&amp;sub=1\">" . $myrow3["system_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
          echo "<td>" . $myrow2["service_display_name"] . "</td>\n";
          echo "<td>" . $myrow2["service_started"] . "</td>\n";
          echo "</tr>\n";
        } while ($myrow2 = mysql_fetch_array($result2));
      } else {}
    } while ($myrow = mysql_fetch_array($result));
    echo "<tr><td><br />&nbsp;</td></tr>\n";
  } else {}
  // Nmap discovered on Audited PC
  $SQL = "select sys.net_ip_address,sys.system_name,sys.system_uuid from system sys, nmap_other_ports port where port.nmap_port_number = '25' AND port.nmap_other_id = sys.system_uuid";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<tr><td colspan=\"2\"><b>Nmap discovered on Audited PC</b></td></tr>";
    echo "<tr>\n";
    echo "<td width=\"150\"><b>IP Address</b></td>\n";
    echo "<td width=\"150\"><b>Name</b></td>\n";
    echo "</tr>\n";
    do {
      $count = $count + 1;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>" . ip_trans($myrow["net_ip_address"]) . "&nbsp;</td>\n";
	echo "<td><a href=\"system_summary.php?pc=" . $myrow["system_uuid"] . "&amp;sub=1\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
    echo "<td></td>\n";
	echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
    echo "<tr><td><br />&nbsp;</td></tr>\n";
  } else {}
  // Nmap discovered on Other equipment
  $SQL = "select oth.other_id, oth.other_ip, oth.other_name, oth.other_mac_address from other oth, nmap_other_ports port where port.nmap_port_number = '25' AND port.nmap_other_id = oth.other_mac_address";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    if ($bgcolor == "#F1F1F1") {
      $bgcolor = "#FFFFFF"; }
    else { $bgcolor = "#F1F1F1"; }
    echo "<tr><td colspan=\"2\"><b>Nmap discovered on Other equipment</b></td></tr>\n";
    echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
    echo "<td width=\"150\"><b>IP Address</b></td>\n";
    echo "<td width=\"150\"><b>Name</b></td>\n";
    echo "</tr>\n";
    do {
      $count = $count + 1;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>" . ip_trans($myrow["other_ip"]) . "&nbsp;</td>\n";
	echo "<td><a href=\"other_summary.php?other=" . $myrow["other_id"] . "&amp;sub=1\">" . $myrow["other_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
    echo "<td></td>\n";
	echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
    echo "<tr><td><br />&nbsp;</td></tr>\n";
  } else {}
  echo "</table>\n";
  echo "</div>\n";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
  echo "<tr><td colspan=\"3\"><b>Email Servers: " . $count . "</b></td></tr>\n";
  echo "</table>\n";
  echo "</div>\n";









  //// VNC Servers Detected
  echo "<div class=\"main_each\">\n";
  $count = 0;
  $bgcolor = "#FFFFFF";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
  echo "<tr>\n";
  echo " <td class=\"contenthead\" colspan=\"4\"><a href=\"javascript://\" onclick=\"switchUl('f10');\">Acitve VNC Servers Detected.</a></td>\n";
  echo " <td align=\"right\"><a href=\"javascript://\" onclick=\"switchUl('f10');\"><img src=\"" . $but_all . "\" width=\"16\" height=\"16\" border=\"0\" /></a></td>\n";
  echo "</tr>\n";
  echo "</table>";
  echo "<div style=\"display:none;\" id=\"f10\">";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
  echo "<tr><td colspan=\"2\"><b>Service Detected</b></td></tr>";
  echo "<tr>\n";
  echo "<td><b>IP Address</b></td>\n";
  echo "<td><b>Name</b></td>\n";
  echo "<td><b>Service</b></td>\n";
  echo "<td><b>Running</b></td>\n";
  echo "</tr>";
  $SQL = "SELECT service_uuid, MAX(service_timestamp) AS timestamp FROM service GROUP BY service_uuid";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    do {
      // Service Detected
      $sql2 = "SELECT service_uuid, service_display_name, service_started FROM service WHERE service_display_name LIKE '%VNC%' AND service_started = 'True' AND service_timestamp = '" . $myrow["timestamp"] . "' AND service_uuid = '" . $myrow["service_uuid"] . "'";
      $result2 = mysql_query($sql2, $db);
      if ($myrow2 = mysql_fetch_array($result2)){
        do {
          if ($bgcolor == "#F1F1F1") {
            $bgcolor = "#FFFFFF"; }
          else { $bgcolor = "#F1F1F1"; }
          $SQL3 = "SELECT net_ip_address, system_name FROM system WHERE system_uuid = '" . $myrow2["service_uuid"] . "' AND system_timestamp = '" . $myrow["timestamp"] . "'";
          $result3 = mysql_query($SQL3, $db);
          $myrow3 = mysql_fetch_array($result3);
          $count = $count + 1;
          echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
          echo "<td>" . ip_trans($myrow3["net_ip_address"]) . "&nbsp;</td>\n";
          echo "<td><a href=\"system_summary.php?pc=" . $myrow2["service_uuid"] . "&amp;sub=1\">" . $myrow3["system_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
          echo "<td>" . $myrow2["service_display_name"] . "</td>\n";
          echo "<td>" . $myrow2["service_started"] . "</td>\n";
          echo "</tr>\n";
        } while ($myrow2 = mysql_fetch_array($result2));
      } else {}
    } while ($myrow = mysql_fetch_array($result));
    echo "<tr><td><br />&nbsp;</td></tr>\n";
  } else {}
  // Nmap discovered on Audited PC
  $SQL = "select sys.net_ip_address,sys.system_name,sys.system_uuid from system sys, nmap_other_ports port where port.nmap_port_number = '5900' AND port.nmap_other_id = sys.system_uuid";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<tr><td colspan=\"2\"><b>Nmap discovered on Audited PC</b></td></tr>";
    echo "<tr>\n";
    echo "<td width=\"150\"><b>IP Address</b></td>\n";
    echo "<td width=\"150\"><b>Name</b></td>\n";
    echo "</tr>\n";
    do {
      $count = $count + 1;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>" . ip_trans($myrow["net_ip_address"]) . "&nbsp;</td>\n";
	echo "<td><a href=\"system_summary.php?pc=" . $myrow["system_uuid"] . "&amp;sub=1\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
    echo "<td></td>\n";
	echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
    echo "<tr><td><br />&nbsp;</td></tr>\n";
  } else {}
  // Nmap discovered on Other equipment
  $SQL = "select oth.other_id, oth.other_ip, oth.other_name, oth.other_mac_address from other oth, nmap_other_ports port where port.nmap_port_number = '5900' AND port.nmap_other_id = oth.other_mac_address";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    if ($bgcolor == "#F1F1F1") {
      $bgcolor = "#FFFFFF"; }
    else { $bgcolor = "#F1F1F1"; }
    echo "<tr><td colspan=\"2\"><b>Nmap discovered on Other equipment</b></td></tr>\n";
    echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
    echo "<td width=\"150\"><b>IP Address</b></td>\n";
    echo "<td width=\"150\"><b>Name</b></td>\n";
    echo "</tr>\n";
    do {
      $count = $count + 1;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>" . ip_trans($myrow["other_ip"]) . "&nbsp;</td>\n";
	echo "<td><a href=\"other_summary.php?other=" . $myrow["other_id"] . "&amp;sub=1\">" . $myrow["other_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
    echo "<td></td>\n";
	echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
    echo "<tr><td><br />&nbsp;</td></tr>\n";
  } else {}
  echo "</table>\n";
  echo "</div>\n";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
  echo "<tr><td colspan=\"3\"><b>VNC Servers: " . $count . "</b></td></tr>\n";
  echo "</table>\n";
  echo "</div>\n";


} else {}


include "include_png_replace.php";

function adjustdate($years=0,$months=0,$days=0) 
{
  $todayyear=date('Y');
  $todaymonth=date('m');
  $todayday=date('d');
  return date("Ymd",mktime(0,0,0,$todaymonth+$months,$todayday+$days,$todayyear+ $years));
}

?>
</body>
</html> 