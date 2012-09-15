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

echo "<div class=\"main_each\">\n";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
echo " <tr>\n  <td align=\"left\" class=\"contenthead\" >List all Other CD Keys.<br />&nbsp;</td>\n";
if ($count_system <> "10000"){
  echo "  <td align=\"right\">\n";
  echo "    <a href=\"list_other_keys.php?page_count=" . $page_prev . "&amp;sort=" . $sort . "\"><img src=\"" . $but_bac . "\" alt=\"Previous " . $count_system . " Systems\" title=\"Previous " . $count_system . " Systems\" border=\"0\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
  echo "    <a href=\"list_other_keys.php?page_count=0&amp;show_all=1&amp;sort=" . $sort . "\"><img src=\"" . $but_all . "\" alt=\"All Systems\" title=\"All Systems\" border=\"0\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
  echo "    <a href=\"list_other_keys.php?page_count=" . $page_next . "&amp;sort=" . $sort . "\"><img src=\"" . $but_for . "\" alt=\"Next " . $count_system . " Systems\" title=\"Next " . $count_system . " Systems\" border=\"0\" width=\"16\" height=\"16\" /></a>&nbsp;<br />&nbsp;\n  </td>\n"; 
} else {}
echo " </tr>\n</table>\n";

if (($sort == "system_name") OR ($sort == "net_ip_address")) {
  $sql = "SELECT system_uuid, net_ip_address, system_name, MAX(system_timestamp) FROM system GROUP BY system_uuid ORDER BY " . $sort;
} else {
  $sql = "SELECT ms_keys_uuid, ms_keys_name, ms_keys_cd_key, MAX(ms_keys_timestamp) FROM ms_keys WHERE ms_keys_key_type NOT LIKE 'office%' AND ms_keys_key_type NOT LIKE 'windows%' GROUP BY ms_keys_uuid ORDER BY " . $sort;
}

$result = mysql_query($sql, $db);
if ($myrow = mysql_fetch_array($result)){
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
  echo " <tr>\n";
  echo "  <td align=\"center\"><a href=\"list_other_keys.php?sub=" . $sub . "&amp;sort=net_ip_address\">IP Address </a></td>\n";
  echo "  <td align=\"center\"><a href=\"list_other_keys.php?sub=" . $sub . "&amp;sort=system_name\">Name</a></td>\n";
  echo "  <td align=\"center\"><a href=\"list_other_keys.php?sub=" . $sub . "&amp;sort=ms_keys_name\">Package</a></td>\n";
  echo "  <td align=\"center\"><a href=\"list_other_keys.php?sub=" . $sub . "&amp;sort=ms_keys_cd_key\">CD Key</a></td>\n";
  echo " </tr>\n";
  do {
    if (($sort == "system_name") OR ($sort == "net_ip_address")) {
      $sql2 = "SELECT * FROM ms_keys where ms_keys_uuid = '" . $myrow["system_uuid"] . "' AND ms_keys_key_type NOT LIKE 'office%' AND ms_keys_key_type NOT LIKE 'windows%' AND ms_keys_timestamp = '" . $myrow["MAX(system_timestamp)"] . "'";
    } else {
	  $sql2 = "SELECT system_uuid, net_ip_address, system_name FROM system WHERE system_uuid = '" . $myrow["ms_keys_uuid"] . "' AND system_timestamp ='" . $myrow["MAX(ms_keys_timestamp)"] . "'";
	}
    $result2 = mysql_query($sql2, $db);
    if ($myrow2 = mysql_fetch_array($result2)){
      do {
        if ($bgcolor == "#F1F1F1") {
          $bgcolor = "#FFFFFF"; }
        else { $bgcolor = "#F1F1F1"; }
		if (($sort == "system_name") OR ($sort == "net_ip_address")) {
		  $ip = ip_trans($myrow["net_ip_address"]);
		  $name = $myrow["system_name"];
		  $uuid = $myrow["system_uuid"];
		  $key = $myrow2["ms_keys_cd_key"];
		  $app_name = $myrow2["ms_keys_name"];
		} else {
		  $ip = ip_trans($myrow2["net_ip_address"]);
		  $name = $myrow2["system_name"];
		  $uuid = $myrow2["system_uuid"];
		  $key = $myrow["ms_keys_cd_key"];
		  $app_name = $myrow["ms_keys_name"];
		}	
        echo " <tr bgcolor=\"$bgcolor\">\n";
        echo "  <td align=\"center\">&nbsp;&nbsp;$ip&nbsp;&nbsp;</td>\n";
        echo "  <td align=\"center\">&nbsp;&nbsp;<a href=\"system_summary.php?pc=$uuid&amp;sub=all\">$name</a>&nbsp;&nbsp;</td>\n";
        echo "  <td align=\"center\">&nbsp;&nbsp;$app_name&nbsp;&nbsp;</td>\n";
        echo "  <td align=\"center\">&nbsp;&nbsp;$key&nbsp;&nbsp;</td>\n";
        echo " </tr>\n";
      } while ($myrow2 = mysql_fetch_array($result2));
	} else {}
  } while ($myrow = mysql_fetch_array($result));
  echo "</table>\n";
} else {
  echo "No CD Keys found.";
}
echo "</div>\n";
echo "</body>\n";
echo "</html>\n";