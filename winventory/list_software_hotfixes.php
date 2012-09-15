<?php 
$page = "";
$extra = "";

include "include.php"; 
$bgcolor = "#FFFFFF";

if (isset($_GET["show_all"])){ $count_system = '10000'; } else {}
if (isset($_GET["page_count"])){ $page_count = $_GET["page_count"]; } else { $page_count = 0;}
$page_prev = $page_count - 1;
if ($page_prev < 0){ $page_prev = 0; } else {}
$page_next = $page_count + 1;
$page_current = $page_count;
$page_count = $page_count * $count_system;

if ($sub <> "sw1"){
  echo "<div class=\"main_each\">\n";
  $SQL = "SELECT count(hotfix_hot_fix_id), hotfix_hot_fix_id, hotfix_description FROM hotfix GROUP BY hotfix_hot_fix_id ORDER BY hotfix_hot_fix_id LIMIT " . $page_count . "," . $count_system;
  $SQL_count = "SELECT DISTINCT hotfix_hot_fix_id FROM hotfix";
  echo "<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
  echo " <tr>\n  <td align=\"left\" class=\"contenthead\">List All Hotifxes<br />&nbsp;</td>\n";
  if ($count_system <> "10000"){
    echo "  <td align=\"right\">";
    echo "    <a href=\"list_software_hotfixes.php?sub=" . $sub . "&amp;page_count=" . $page_prev . "\"><img src=\"" . $but_bac . "\" border=0 alt=\"Previous " . $count_system . " Systems\" title=\"Previous " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;\n"; 
    echo "    <a href=\"list_software_hotfixes.php?sub=" . $sub . "&amp;page_count=0&amp;show_all=1\"><img src=\"" . $but_all . "\" border=0 alt=\"All Systems\" title=\"All Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;\n"; 
    echo "    <a href=\"list_software_hotfixes.php?sub=" . $sub . "&amp;page_count=" . $page_next . "\"><img src=\"" . $but_for . "\" border=0 alt=\"Next " . $count_system . " Systems\" title=\"Next " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a><br />&nbsp;\n  </td>\n";
  } else {}
  echo " </tr>\n</table>\n\n";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo " <tr>\n";
	echo "  <td align=\"center\"><b>Count</b></td>\n";
	echo "  <td><b>Hotfix ID</b></td>\n";
	echo "  <td><b>Description</b></td>\n";
	echo "  <td align=\"center\"><b>Google Search</b></td>\n";
	echo "  <td align=\"center\"><b>KB Article</b>\n  </td>\n </tr>\n";
    do {
      if ($myrow['hotfix_hot_fix_id'] == "File 1") {} else {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo " <tr bgcolor=\"" . $bgcolor . "\">\n";
	  echo "  <td align=\"center\"><a href=\"list_software_hotfixes.php?sub=sw1&amp;name=" . url_clean($myrow["hotfix_hot_fix_id"]) . "\" title=\"Show All Systems with this hotfix\">" . $myrow["count(hotfix_hot_fix_id)"] . "</a></td>\n";
      echo "  <td>&nbsp;&nbsp;" . $myrow["hotfix_hot_fix_id"] . "&nbsp;&nbsp;</td>\n";
      echo "  <td>&nbsp;&nbsp;" . $myrow['hotfix_description'] . "&nbsp;&nbsp;</td>\n";
      echo "  <td align=\"center\"><a href=\"http://www.google.com/search?num=30&amp;hl=en&amp;lr=lang_en&amp;ie=UTF-8&amp;oe=UTF-8&amp;safe=off&amp;q=%22" . url_clean($myrow["hotfix_hot_fix_id"]) . "%22&amp;btnG=Search\"><img border=0 alt=\"Google Search\" title=\"Google Search\" src=\"images/button_google.gif\" /></a></td>\n";
      echo "  <td align=\"center\"><a href=\"http://support.microsoft.com/default.aspx?scid=kb;en-us;" . url_clean($myrow["hotfix_hot_fix_id"]) . "\"><img border=0 alt=\"Knowledge Base Article\" title=\"Knowledge Base Article\" src=\"images/button_kb.gif\" height=\"16\" /></a></td>\n";
      echo " </tr>\n";
      }
    } while ($myrow = mysql_fetch_array($result));
  $total = mysql_query($SQL_count, $db);
  $num_rows = mysql_num_rows($total);
  echo " <tr>\n  <td colspan=3><b>Total Hotfixes: " . $num_rows . "</b>\n  </td>\n </tr>\n";
  } else {
    echo "No hotfixes found.";
  }
  echo "</table>\n";
  echo "<table width=\"100%\">\n";
  echo " <tr>\n";
  if ($count_system <> "10000"){
    echo "  <td align=\"right\">";
    echo "    <a href=\"list_software_hotfixes.php?sub=" . $sub . "&amp;page_count=" . $page_prev . "\"><img src=\"" . $but_bac . "\" border=\"0\" alt=\"Previous " . $count_system . " Systems\" title=\"Previous " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
    echo "    <a href=\"list_software_hotfixes.php?sub=" . $sub . "&amp;page_count=0&amp;show_all=1\"><img src=\"" . $but_all . "\" border=\"0\" alt=\"All Systems\" title=\"All Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
    echo "    <a href=\"list_software_hotfixes.php?sub=" . $sub . "&amp;page_count=" . $page_next . "\"><img src=\"" . $but_for . "\" border=\"0\" alt=\"Next " . $count_system . " Systems\" title=\"Next " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a></td>\n";
  } else {}
  echo " </tr>";
  echo "</table>";
} else {}



if ($sub == "sw1"){
  echo "<div class=\"main_each\">\n";
  $SQL = "select sys.system_uuid, sys.system_description, sys.net_ip_address, sys.system_name, hf.hotfix_hot_fix_id, hf.hotfix_description from hotfix hf, system sys where hf.hotfix_hot_fix_id = '" . $_GET["name"] . "' and hf.hotfix_uuid = sys.system_uuid ORDER BY sys.system_name";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
	echo " <tr>\n  <td colspan=\"3\" class=\"contenthead\">List Systems with \"" . $_GET["name"] . " - " . $myrow["hotfix_description"] . "\" installed.<br />&nbsp;</td></tr>\n";
    echo " <tr>\n  <td>&nbsp;&nbsp;IP Address</td>\n  <td>&nbsp;&nbsp;Name</td>\n  <td>&nbsp;&nbsp;Description</td>\n </tr>\n";
    do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo " <tr bgcolor=\"" . $bgcolor . "\">\n";
      echo "  <td>&nbsp;&nbsp;" . ip_trans($myrow["net_ip_address"]) . "&nbsp;&nbsp;</td>\n";
	  echo "  <td>&nbsp;&nbsp;<a href=\"system_summary.php?pc=" . $myrow["system_uuid"] . "\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;</td>\n";
	  echo "  <td>&nbsp;&nbsp;" . $myrow["system_description"] . "</td>\n";
      echo " </tr>\n";
    } while ($myrow = mysql_fetch_array($result));
    echo "</table>\n";
  } else {
    echo "No systems with this hotfix found.";
  }
} else {}



echo "</div>\n";
include "include_png_replace.php";
echo "</body>\n";
echo "</html>\n";