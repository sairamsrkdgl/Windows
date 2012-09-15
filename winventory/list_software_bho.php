<?php 
$page = "";
$extra = "";
include "include.php";

if (isset($_GET["show_all"])){ $count_system = '10000'; } else {}
if (isset($_GET["page_count"])){ $page_count = $_GET["page_count"]; } else { $page_count = 0;}
$page_prev = $page_count - 1;
if ($page_prev < 0){ $page_prev = 0; } else {}
$page_next = $page_count + 1;
$page_current = $page_count;
$page_count = $page_count * $count_system;

if ($sub <> "sw1"){
  $SQL = "SELECT count(bho_program_file), bho_program_file from browser_helper_objects group by bho_program_file ORDER BY bho_program_file LIMIT " . $page_count . "," . $count_system;
  $SQL_count = "SELECT DISTINCT bho_program_file from browser_helper_objects";
  echo "<div class=\"main_each\">\n";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
  echo " <tr>\n  <td align=\"left\" class=\"contenthead\">List All Browser Helper Objects<br />&nbsp;</td>\n";
  if ($count_system <> "10000"){
    echo "  <td align=\"right\">\n";
    echo "    <a href=\"list_software_bho.php?sub=" . $sub . "&amp;page_count=" . $page_prev . "\" class=\"content\"><img src=\"" . $but_bac . "\" border=0 alt=\"Previous " . $count_system . " Systems\" title=\"Previous " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
    echo "    <a href=\"list_software_bho.php?sub=" . $sub . "&amp;page_count=0&amp;show_all=1\" class=\"content\"><img src=\"" . $but_all . "\" border=0 alt=\"All Systems\" title=\"All Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
    echo "    <a href=\"list_software_bho.php?sub=" . $sub . "&amp;page_count=" . $page_next . "\" class=\"content\"><img src=\"" . $but_for . "\" border=0 alt=\"Next " . $count_system . " Systems\" title=\"Next " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a>&nbsp;<br />&nbsp;</td>\n";
  } else {}
  echo " </tr>\n</table>\n\n";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo " <tr>\n";
	echo "  <td align=\"center\"><b>Count</b></td>\n";
	echo "  <td><b>BHO Name</b></td>\n";
	echo "  <td align=\"center\"><b>Google Search</b></td> </tr>\n";
    do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo " <tr bgcolor=\"" . $bgcolor . "\">\n";
      echo "  <td align=\"center\"><a href=\"list_software_bho.php?sub=sw1&amp;name=" . url_clean($myrow["bho_program_file"]) . "\" title=\"Show All Systems with this software\">" . $myrow["count(bho_program_file)"] . "</a></td>\n";
      echo "  <td>" . $myrow["bho_program_file"] . "</td>\n";
      echo "  <td align=\"center\"><a href=\"http://www.google.com/search?num=30&amp;hl=en&amp;lr=lang_en&amp;ie=UTF-8&amp;oe=UTF-8&amp;safe=off&amp;q=%22" . url_clean($myrow["bho_program_file"]) . "%22&amp;btnG=Search\"><img border=0 alt=\"Google Search\" title=\"Google Search\" src=\"images/button_google.gif\" /></a></td>\n";
      echo " </tr>\n";
    } while ($myrow = mysql_fetch_array($result));
  $total = mysql_query($SQL_count, $db);
  $num_rows = mysql_num_rows($total);
  echo " <tr>\n  <td colspan=3><br /><b>Total BHO Packages: " . $num_rows . "</b></td>\n </tr>\n";
  } else {
    echo " <tr>\n  <td><br />No BHO Software in database.</td>\n </tr>\n";
  }
  echo "</table>\n";
  if ($count_system <> "10000"){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
    echo " <tr>\n  <td align=\"right\"><br />\n";
    echo "    <a href=\"list_software_bho.php?sub=" . $sub . "&amp;page_count=" . $page_prev . "\"><img src=\"" . $but_bac . "\" border=0 alt=\"Previous " . $count_system . " Systems\" title=\"Previous " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
    echo "    <a href=\"list_software_bho.php?sub=" . $sub . "&amp;page_count=0&amp;show_all=1\"><img src=\"" . $but_all . "\" border=0 alt=\"All Systems\" title=\"All Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
    echo "    <a href=\"list_software_bho.php?sub=" . $sub . "&amp;page_count=" . $page_next . "\"><img src=\"" . $but_for . "\" border=0 alt=\"Next " . $count_system . " Systems\" title=\"Next " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a>&nbsp;\n";
	echo "  </td>\n";
  } else {
    echo "<td></td>\n";
  }
  echo " </tr>\n";
  echo "</table>\n";
} else {}

if ($sub == "sw1"){
  $SQL = "select sys.system_uuid, sys.system_description, sys.net_ip_address, sys.system_name, bho.bho_program_file from browser_helper_objects bho, system sys where bho.bho_program_file = '" . $_GET["name"] . "' and bho.bho_uuid = sys.system_uuid ORDER BY sys.system_name";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<div class=\"main_each\">\n";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
    echo " <tr>\n  <td class=\"contenthead\" colspan=\"3\">List Systems with <i>\"" . $_GET["name"] . "\"</i> installed.<br />&nbsp;</td>\n </tr>\n";
    echo " <tr>";
	echo "  <td width=\"100\">&nbsp;&nbsp;<b>IP Address</b></td>\n";
	echo "  <td width=\"100\">&nbsp;&nbsp;<b>Name</b></td>\n";
	echo "  <td width=\"450\">&nbsp;&nbsp;<b>Description</b></td>\n </tr>\n";
    do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo " <tr bgcolor=\"" . $bgcolor . "\">\n";
      echo "  <td>&nbsp;&nbsp;" . ip_trans($myrow["net_ip_address"]) . "&nbsp;&nbsp;</td>\n";
	  echo "  <td>&nbsp;&nbsp;<a href=\"system_summary.php?pc=" . $myrow["system_uuid"] . "\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;</td>\n";
	  echo "  <td>&nbsp;&nbsp;" . htmlentities($myrow["system_description"]) . "</td>\n";
      echo " </tr>\n";
    } while ($myrow = mysql_fetch_array($result));
    echo "</table>\n";
  } else {
    echo "No Systems have this software installed.";
  }
} else {}

echo "</div>\n";
include "include_png_replace.php";
echo "</body>\n";
echo "</html>\n";