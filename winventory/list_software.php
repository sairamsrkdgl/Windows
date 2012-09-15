<?php 
$page = "";
$extra = "";
include "include.php";

if (isset($_GET['sort'])){ $sort = $_GET['sort']; } else { $sort = 'software_name';}
if (isset($_GET['show_all'])){ $count_system = '10000'; } else {}
if (isset($_GET['page_count'])){ $page_count = $_GET['page_count']; } else { $page_count = 0;}
$page_prev = $page_count - 1;
if ($page_prev < 0){ $page_prev = 0; } else {}
$page_next = $page_count + 1;
$page_current = $page_count;
$page_count = $page_count * $count_system;

if ($sub <> "sw1"){
  $sql = "DELETE FROM software_temp";
  $result = mysql_query($sql, $db);
  $sql = "select system_uuid, system_timestamp from system";
  $result = mysql_query($sql, $db);
  if ($myrow = mysql_fetch_array($result)){
    do {
      $sql2 = "INSERT into software_temp SELECT software_name, software_timestamp, software_uuid, software_version FROM software WHERE software_uuid = '" . $myrow["system_uuid"] . "' AND software_name NOT LIKE '%hotfix%' AND software_timestamp = '" . $myrow["system_timestamp"] . "'";
      $result2 = mysql_query($sql2, $db);
	} while ($myrow = mysql_fetch_array($result));
  } else {}
  $SQL = "SELECT count(software_name) software_count, software_name from software_temp group by software_name ORDER BY " . $sort . " LIMIT " . $page_count . "," . $count_system;
  $SQL_count = "SELECT DISTINCT software_name from software_temp WHERE software_name NOT LIKE '%hotfix%'";
  echo "<div class=\"main_each\">\n";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
  echo " <tr>\n  <td align=\"left\" class=\"contenthead\" colspan=\"2\">List All Software<br />&nbsp;</td>\n";
  if ($count_system <> "10000"){
    echo "  <td align=\"center\">\n";
    echo "    <a href=\"list_software.php?sub=" . $sub . "&amp;page_count=" . $page_prev . "&amp;sort=" . $sort . "\"><img src=\"" . $but_bac . "\" border=0 alt=\"Previous " . $count_system . " Systems\" title=\"Previous " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
    echo "    <a href=\"list_software.php?sub=" . $sub . "&amp;page_count=0&amp;show_all=1&amp;sort=" . $sort . "\"><img src=\"" . $but_all . "\" border=0 alt=\"All Systems\" title=\"All Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
    echo "    <a href=\"list_software.php?sub=" . $sub . "&amp;page_count=" . $page_next . "&amp;sort=" . $sort . "\"><img src=\"" . $but_for . "\" border=0 alt=\"Next " . $count_system . " Systems\" title=\"Next " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a><br />&nbsp;\n";
	echo "  </td>\n";
  } else {
    echo "  <td></td>\n";
  }
  echo " </tr>\n";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo " <tr>\n";
	echo "  <td align=\"center\" width=\"100\"><a href=\"list_software.php?sub=" . $sub . "&amp;page_count=" . $page_current . "&amp;sort=software_count\"><b>Count</b></a></td>\n";
	echo "  <td width=\"450\"><a href=\"list_software.php?sub=" . $sub . "&amp;page_count=" . $page_current . "&amp;sort=software_name\"><b>Package Name</b></a></td>\n";
	echo "  <td align=\"center\" width=\"150\"><b>Google Search</b></td></tr>\n";
    do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo " <tr bgcolor=\"" . $bgcolor . "\">\n";
      echo "  <td align=\"center\"><a href=\"list_software.php?sub=sw1&amp;name=" . url_clean($myrow["software_name"]) . "\" title=\"Show All Systems with this software\">" . $myrow["software_count"] . "</a></td>\n";
      echo "  <td>" . $myrow["software_name"] . "</td>\n";
      echo "  <td align=\"center\"><a href=\"http://www.google.com/search?num=30&amp;hl=en&amp;lr=lang_en&amp;ie=UTF-8&amp;oe=UTF-8&amp;safe=off&amp;q=%22" . url_clean($myrow["software_name"]) . "%22&amp;btnG=Search\"><img border=0 alt=\"Google Search\" title=\"Google Search\" src=\"images/button_google.gif\" /></a></td>\n";
      echo " </tr>\n";
    } while ($myrow = mysql_fetch_array($result));
  $total = mysql_query($SQL_count, $db);
  $num_rows = mysql_num_rows($total);
  echo " <tr>\n  <td colspan=2><br /><b>Total Software Packages: " . $num_rows . "</b></td>\n";
  } else {
    echo "<tr><td><br />No Software in database.</td></tr>";
  }
  if ($count_system <> "10000"){
    echo "  <td align=\"center\"><br />\n";
    echo "    <a href=\"list_software.php?sub=" . $sub . "&amp;page_count=" . $page_prev . "&amp;sort=" . $sort . "\"><img src=\"" . $but_bac . "\" border=0 alt=\"Previous " . $count_system . " Systems\" title=\"Previous " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
    echo "    <a href=\"list_software.php?sub=" . $sub . "&amp;page_count=0&amp;show_all=1&amp;sort=" . $sort . "\"><img src=\"" . $but_all . "\" border=0 alt=\"All Systems\" title=\"All Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
    echo "    <a href=\"list_software.php?sub=" . $sub . "&amp;page_count=" . $page_next . "&amp;sort=" . $sort . "\"><img src=\"" . $but_for . "\" border=0 alt=\"Next " . $count_system . " Systems\" title=\"Next " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a>\n";
	echo "  </td>\n";
  } else {
    echo "<td></td>\n";
  }
  echo "</tr>\n";
  echo "</table>\n";
} else {}



if ($sub == "sw1"){
  $sql = "DELETE FROM software_temp";
  $result = mysql_query($sql, $db);
  $sql = "select system_uuid, system_timestamp from system group by system_uuid";
  $result = mysql_query($sql, $db);
  if ($myrow = mysql_fetch_array($result)){
    do {
      $sql2 = "INSERT into software_temp SELECT software_name, software_uuid, software_timestamp, software_version FROM software WHERE software_uuid = '" . $myrow["system_uuid"] . "' AND software_timestamp = '" . $myrow["system_timestamp"] . "'";
      $result2 = mysql_query($sql2, $db);
	} while ($myrow = mysql_fetch_array($result));
  } else {}
  $SQL = "select sys.system_uuid,sys.system_description,sys.net_ip_address,sys.system_name,sw.software_name, sw.software_version from software_temp sw, system sys where sw.software_name = '" . $_GET["name"] . "' and sw.software_uuid = sys.system_uuid GROUP BY sys.system_uuid ORDER BY sys.system_name";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<div class=\"main_each\">\n";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
    echo " <tr>\n  <td class=\"contenthead\" colspan=\"3\">List Systems with <i>\"" . $_GET["name"] . "\"</i> installed.<br />&nbsp;</td>\n </tr>\n";
    echo " <tr>";
	echo "  <td width=\"100\">&nbsp;&nbsp;<b>IP Address</b></td>\n";
	echo "  <td width=\"100\">&nbsp;&nbsp;<b>Name</b></td>\n";
	echo "  <td width=\"450\">&nbsp;&nbsp;<b>Description</b></td>";
    echo "  <td width=\"100\">&nbsp;&nbsp;<b>Version</b></td>\n";
    echo "\n </tr>\n";
    do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo " <tr bgcolor=\"" . $bgcolor . "\">\n";
      echo "  <td>&nbsp;&nbsp;" . ip_trans($myrow["net_ip_address"]) . "&nbsp;&nbsp;</td>\n";
	  echo "  <td>&nbsp;&nbsp;<a href=\"system_summary.php?pc=" . $myrow["system_uuid"] . "\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;</td>\n";
	  echo "  <td>&nbsp;&nbsp;" . $myrow["system_description"] . "</td>\n";
	  echo "  <td>&nbsp;&nbsp;" . $myrow["software_version"] . "</td>\n";
      echo " </tr>\n";
    } while ($myrow = mysql_fetch_array($result));
	echo "</div>";
  } else {
    echo "<div class=\"main_each\">\nNo Systems have this software installed.\n";
  }
} else {}


echo "</div>\n";
include "include_png_replace.php";
echo "</body>\n";
echo "</html>\n";