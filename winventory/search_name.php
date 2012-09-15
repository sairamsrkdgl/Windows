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

echo "<div class=\"main_each\">";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
echo "<tr><td align=\"left\" class=\"contenthead\" >Systems with a name like " . $_POST["system_name"] . ".<br />&nbsp;</td>\n";
if ($count_system <> "10000"){
  echo "<td align=\"right\">\n";
  echo "<a href=\"list_desktops.php?page_count=" . $page_prev . "&amp;sort=" . $sort . "\"><img src=\"" . $but_bac . "\" alt=\"Previous " . $count_system . " Systems\" title=\"Previous " . $count_system . " Systems\" border=\"0\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
  echo "<a href=\"list_desktops.php?page_count=0&amp;show_all=1&amp;sort=" . $sort . "\"><img src=\"" . $but_all . "\" alt=\"All Systems\" title=\"All Systems\" border=\"0\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
  echo "<a href=\"list_desktops.php?page_count=" . $page_next . "&amp;sort=" . $sort . "\"><img src=\"" . $but_for . "\" alt=\"Next " . $count_system . " Systems\" title=\"Next " . $count_system . " Systems\" border=\"0\" width=\"16\" height=\"16\" /></a>&nbsp;<br />&nbsp;</td>\n"; 
} else {}
echo "</tr></table>\n";

$sql = "SELECT MAX(system_timestamp) FROM system WHERE system_name LIKE '%" . $_POST["system_name"] . "%' group by system_uuid";
$result = mysql_query($sql, $db);
if ($myrow = mysql_fetch_array($result)){
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">";
  echo "<tr>\n";
  echo "<td align=\"center\"><a href=\"list_desktops.php?sort=net_ip_address&amp;page_count=" . $page_current . "\">IP Address</a></td>\n";
  echo "<td align=\"center\"><a href=\"list_desktops.php?sort=system_name&amp;page_count=" . $page_current . "\">Name</a></td>\n";
  if ($show_os == "y")           { echo "<td align=\"center\"><a href=\"list_desktops.php?sort=system_os_name&amp;page_count=" . $page_current . "\">OS</a></td>\n"; } else {}
  if ($show_date_audited == "y") { echo "<td align=\"center\"><a href=\"list_desktops.php?sort=system_timestamp&amp;page_count=" . $page_current . "\">Date Audited</a></td>\n"; } else {}
  if ($show_type == "y")         { echo "<td align=\"center\"><a href=\"list_desktops.php?sort=system_system_type&amp;page_count=" . $page_current . "\">&nbsp;System Type&nbsp;</a></td>\n"; } else {}
  if ($show_description == "y")  { echo "<td align=\"center\"><a href=\"list_desktops.php?sort=system_description&amp;page_count=" . $page_current . "\">&nbsp;System Description&nbsp;</a></td>\n"; } else {}
  if ($show_domain == "y")       { echo "<td align=\"center\"><a href=\"list_desktops.php?sort=net_domain\">&nbsp;Domain&nbsp;</a></td>\n"; } else {}
  if ($show_service_pack == "y") { echo "<td align=\"center\"><a href=\"list_desktops.php?sort=system_service_pack\">&nbsp;Service Pack&nbsp;</a></td>\n"; } else {}
  echo "</tr>";
  do {
    $sql2 = "SELECT system_name, net_ip_address, system_uuid, system_timestamp, system_description, net_domain, system_service_pack, system_os_name, system_system_type FROM system where system_timestamp = '" . $myrow["MAX(system_timestamp)"] . "' AND system_name LIKE '%" . $_POST["system_name"] . "%'";
    $result2 = mysql_query($sql2, $db);
    if ($myrow2 = mysql_fetch_array($result2)){
      do {
      $os_name = determine_os($myrow2["system_os_name"]);
      $img = determine_img($myrow2["system_os_name"],$myrow2["system_system_type"]);
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo "<tr>";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . ip_trans($myrow2["net_ip_address"]) . "&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;<a href=\"system_summary.php?pc=" . $myrow2["system_uuid"] . "&amp;sub=all\">" . $myrow2["system_name"] . "</a>&nbsp;&nbsp;</td>\n";
      if ($show_os == "y")           { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $os_name . "&nbsp;&nbsp;</td>\n"; } else {}
      if ($show_date_audited == "y") { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . return_date($myrow2["system_timestamp"]) . "&nbsp;&nbsp;</td>\n"; } else {}
      if ($show_type == "y")         { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $img . "&nbsp;&nbsp;</td>\n"; } else {}
      if ($show_description == "y")  { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow2["system_description"] . "&nbsp;&nbsp;</td>\n"; } else {}
      if ($show_domain == "y")       { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow2["net_domain"] . "&nbsp;&nbsp;</td>\n"; } else {}
      if ($show_service_pack == "y") { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow2["system_service_pack"] . "&nbsp;&nbsp;</td>\n"; } else {}
      } while ($myrow2 = mysql_fetch_array($result2));
	} else {}
  } while ($myrow = mysql_fetch_array($result));
} else {}