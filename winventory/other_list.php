<?php 
$page = "other";
$extra = "";

include "include.php";

if (isset($_GET["id"])) {$id = $_GET["id"];} else {$id = "1";}

if (isset($_GET['sort'])) {$sort = $_GET['sort'];} else {$sort= "other_ip";}

if (isset($_GET["show_all"])){ $count_system = '10000'; } else {}
if (isset($_GET["page_count"])){ $page_count = $_GET["page_count"]; } else { $page_count = 0;}
$page_prev = $page_count - 1;
if ($page_prev < 0){ $page_prev = 0; } else {}
$page_next = $page_count + 1;
$page_current = $page_count;
$page_count = $page_count * $count_system;

echo "<div class=\"main_each\">";

if ($id == "1"){
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
echo "<tr><td align=\"left\" class=\"contenthead\">List All Other Equipment.</td></tr>\n";
if ($count_system <> "10000"){
  echo "<tr><td align=\"right\">\n";
  echo "<a href=\"other_list.php?sub=" . $sub . "&amp;page_count=" . $page_prev . "&amp;sort=" . $sort . "\"><img src=\"" . $but_bac . "\" border=\"0\" alt=\"Previous " . $count_system . " Systems\" title=\"Previous " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
  echo "<a href=\"other_list.php?sub=" . $sub . "&amp;page_count=0&amp;show_all=1&amp;sort=" . $sort . "\"><img src=\"" . $but_all . "\" border=\"0\" alt=\"All Systems\" title=\"All Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
  echo "<a href=\"other_list.php?sub=" . $sub . "&amp;page_count=" . $page_next . "&amp;sort=" . $sort . "\"><img src=\"" . $but_for . "\" border=\"0\" alt=\"Next " . $count_system . " Systems\" title=\"Next " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a></td></tr>\n"; 
} else {}
echo "</table>\n";

echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
echo "<tr>\n";
echo "<td>&nbsp;&nbsp;<a href=\"other_list.php?sort=other_ip&amp;pc=\">IP Address</a>&nbsp;&nbsp;</td>\n";
echo "<td align=\"center\"><a href=\"other_list.php?sort=other_type&amp;pc=\">Type</a>&nbsp;&nbsp;</td>\n";
echo "<td>&nbsp;&nbsp;<a href=\"other_list.php?sort=other_name&amp;pc=\">Name</a>&nbsp;&nbsp;</td>\n";
echo "<td>&nbsp;&nbsp;<a href=\"other_list.php?sort=other_description&amp;pc=\">Description</a>&nbsp;&nbsp;</td>\n";
echo "</tr>\n";
$SQL = "SELECT * FROM other ORDER BY " . $sort . " LIMIT " . $page_count . "," . $count_system;
$SQL_count = "SELECT * FROM other";
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>&nbsp;" . ip_trans($myrow["other_ip"]) . "&nbsp;</td>\n";
	echo "<td align=\"center\"><img src=\"images/other_devices/" . url_clean($myrow["other_type"]) . ".png\" width=\"32\" height=\"32\" alt=\"" . $myrow["other_type"] . "\" title=\"". $myrow["other_type"] ."\" />&nbsp;</td>\n";
	echo "<td>&nbsp;<a href=\"other_summary.php?other=" . $myrow["other_id"] . "&amp;sub=1\">" . $myrow["other_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
	echo "<td>&nbsp;" . $myrow["other_description"] . "&nbsp;&nbsp;&nbsp;</td>\n";
	echo "</tr>";

} while ($myrow = mysql_fetch_array($result));
$total = mysql_query($SQL_count, $db);
$num_rows = mysql_num_rows($total);
echo "<tr><td colspan=\"3\"><b>Total Other Items: " . $num_rows . "</b></td></tr>\n";
echo "</table>\n";
} else {}
} else {}

if ($id == "2") {
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
echo "<tr><td align=\"left\" colspan=\"4\" class=\"contenthead\">List All Network Equipment.</td></tr>\n";
echo "<tr>\n";
echo "<td>&nbsp;&nbsp;<a href=\"other_list.php?sort=other_ip&amp;id=2\">IP Address</a>&nbsp;&nbsp;</td>\n";
echo "<td>&nbsp;&nbsp;<a href=\"other_list.php?sort=other_type&amp;id=2\">Type</a>&nbsp;&nbsp;</td>\n";
echo "<td>&nbsp;&nbsp;<a href=\"other_list.php?sort=other_name&amp;id=2\">Name</a>&nbsp;&nbsp;</td>\n";
echo "<td>&nbsp;&nbsp;<a href=\"other_list.php?sort=other_description&amp;id=2\">Description</a>&nbsp;&nbsp;</td>\n";
echo "</tr>\n";
if (isset($_GET['sort'])) {$sort = $_GET['sort'];} else {$sort= "other_ip";}
$SQL = "SELECT * FROM other WHERE other_mac_address <> '' ORDER BY " . $sort;
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">";
	echo "<td>&nbsp;" . ip_trans($myrow["other_ip"]) . "&nbsp;</td>\n";
	echo "<td align=\"center\"><img src=\"images/other_devices/" . url_clean($myrow["other_type"]) . ".png\" width=\"32\" height=\"32\" alt=\"" . $myrow["other_type"] . "\" title=\"". $myrow["other_type"] ."\" />&nbsp;</td>\n";
	echo "<td>&nbsp;<a href=\"other_summary.php?other=" . $myrow["other_id"] . "&amp;sub=1\">" . $myrow["other_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
	echo "<td>&nbsp;" . $myrow["other_description"] . "&nbsp;&nbsp;&nbsp;</td>\n";
	echo "</tr>";

} while ($myrow = mysql_fetch_array($result));
echo "</table>";
} else {}
} else {}

if ($id == "3") {
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
echo "<tr><td align=\"left\" colspan=\"4\" class=\"contenthead\">List All Non-Network Equipment.</td></tr>\n";
echo "<tr>\n";
echo "<td>&nbsp;&nbsp;<a href=\"other_list.php?sort=other_type&amp;pc=\">Type</a>&nbsp;&nbsp;</td>\n";
echo "<td>&nbsp;&nbsp;<a href=\"other_list.php?sort=other_name&amp;pc=\">Name</a>&nbsp;&nbsp;</td>\n";
echo "<td>&nbsp;&nbsp;<a href=\"other_list.php?sort=other_description&amp;pc=\">Description</a>&nbsp;&nbsp;</td>\n";
        echo "<td>&nbsp;&nbsp;<a href=\"other_list.php?id=6amp;&amp;sort=other_model&amp;pc=\">Model</a>&nbsp;&nbsp;</td>\n";
echo "</tr>\n";
if (isset($_GET['sort'])) {$sort = $_GET['sort'];} else {$sort= "other_ip";}
$SQL = "SELECT * FROM other WHERE other_mac_address IS NULL ORDER BY " . $sort;
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td align=\"center\"><img src=\"images/other_devices/" . url_clean($myrow["other_type"]) . ".png\" width=\"33\" height=\"33\" alt=\"" . $myrow["other_type"] . "\" title=\"". $myrow["other_type"] ."\" />&nbsp;</td>\n";
	echo "<td>&nbsp;<a href=\"other_summary.php?other=" . $myrow["other_id"] . "&amp;sub=1\">" . $myrow["other_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
	echo "<td>&nbsp;" . $myrow["other_description"] . "&nbsp;&nbsp;&nbsp;</td>\n";
	echo "<td>&nbsp;" . $myrow["other_model"] . "</td>\n";
	echo "</tr>\n";

} while ($myrow = mysql_fetch_array($result));
echo "</table>";
} else {}
} else {}

if ($id == "4") {
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
echo "<tr><td align=\"left\" colspan=\"4\" class=\"contenthead\">List All Network Printers.</td></tr>\n";
echo "<tr>\n";
echo "<td>&nbsp;&nbsp;<a href=\"other_list.php?id=4&amp;sort=other_ip&amp;pc=\">IP Address</a>&nbsp;&nbsp;</td>\n";
echo "<td>&nbsp;&nbsp;<a href=\"other_list.php?id=4&amp;sort=other_name&amp;pc=\">Name</a>&nbsp;&nbsp;</td>\n";
echo "<td>&nbsp;&nbsp;<a href=\"other_list.php?id=4&amp;sort=other_description&amp;pc=\">Description</a>&nbsp;&nbsp;</td>\n";
echo "</tr>\n";
if (isset($_GET['sort'])) {$sort = $_GET['sort'];} else {$sort= "other_name";}
$SQL = "SELECT * FROM other WHERE other_mac_address <> '' AND other_type = 'printer' ORDER BY " . $sort;
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>&nbsp;" . ip_trans($myrow["other_ip"]) . "&nbsp;</td>\n";
	echo "<td>&nbsp;<a href=\"other_summary.php?other=" . $myrow["other_id"] . "&amp;sub=1\">" . $myrow["other_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
	echo "<td>&nbsp;" . $myrow["other_description"] . "&nbsp;&nbsp;&nbsp;</td>\n";
	echo "</tr>";

} while ($myrow = mysql_fetch_array($result));
echo "</table>";
} else {}
} else {}

if ($id == "5") {
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
echo "<tr><td align=\"left\" colspan=\"4\" class=\"contenthead\">List All Non-Network Printers.</td></tr>\n";
echo "<tr>\n";
echo "<td width=\"200\">&nbsp;&nbsp;<a href=\"other_list.php?id=5&amp;sort=other_name&amp;pc=\">Name</a>&nbsp;&nbsp;</td>\n";
echo "<td>&nbsp;&nbsp;<a href=\"other_list.php?id=5&amp;sort=other_description&amp;pc=\">Description</a>&nbsp;&nbsp;</td>\n";
echo "<td width=\"250\">&nbsp;&nbsp;<a href=\"other_list.php?id=5&amp;sort=other_model&amp;pc=\">Model</a>&nbsp;&nbsp;</td>\n";
echo "</tr>\n";
if (isset($_GET['sort'])) {$sort = $_GET['sort'];} else {$sort= "other_name";}
$SQL = "SELECT * FROM other WHERE (other_mac_address IS NULL OR other_mac_address = '') AND other_type = 'printer' ORDER BY " . $sort;
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>&nbsp;<a href=\"other_summary.php?other=" . $myrow["other_id"] . "&amp;sub=1\">" . $myrow["other_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
	echo "<td>&nbsp;" . $myrow["other_description"] . "</td>\n";
	echo "<td>&nbsp;" . $myrow["other_model"] . "</td>\n";
	echo "</tr>\n";

} while ($myrow = mysql_fetch_array($result));
echo "</table>\n";
} else {}
} else {}

if ($id == "6") {
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
echo "<tr><td align=\"left\" colspan=\"4\" class=\"contenthead\">List All Monitors.</td></tr>\n";
echo "<tr>\n";
echo "<td width=\"200\">&nbsp;&nbsp;<a href=\"other_list.php?id=6&amp;sort=other_name&amp;pc=\">Name</a>&nbsp;&nbsp;</td>\n";
echo "<td>&nbsp;&nbsp;<a href=\"other_list.php?id=6&amp;sort=other_description&amp;pc=\">Description</a>&nbsp;&nbsp;</td>\n";
echo "<td width=\"250\">&nbsp;&nbsp;<a href=\"other_list.php?id=6&amp;sort=other_model&amp;pc=\">Model</a>&nbsp;&nbsp;</td>\n";
echo "</tr>\n";
if (isset($_GET['sort'])) {$sort = $_GET['sort'];} else {$sort= "other_name";}
$SQL = "SELECT * FROM other WHERE other_type = 'monitor' ORDER BY " . $sort;
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>&nbsp;<a href=\"other_summary.php?other=" . $myrow["other_id"] . "&amp;sub=1\">" . $myrow["other_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
	echo "<td>&nbsp;" . $myrow["other_description"] . "</td>\n";
	echo "<td>&nbsp;" . $myrow["other_model"] . "</td>\n";
	echo "</tr>";

} while ($myrow = mysql_fetch_array($result));
echo "</table>\n";
} else {}
} else {}

?>
</div>
<?php
include "include_png_replace.php";
?>
</body>
</html> 