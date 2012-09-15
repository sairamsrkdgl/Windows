<?php 
$page = "calls";
$extra = "";

include "include.php";

if (isset($_GET['sort'])) {$sort = $_GET['sort'];} else {$sort= "call_logged_date";}
if (isset($_GET["show_all"])){ $count_system = '10000'; } else {}
if (isset($_GET["page_count"])){ $page_count = $_GET["page_count"]; } else { $page_count = 0;}
$page_prev = $page_count - 1;
if ($page_prev < 0){ $page_prev = 0; } else {}
$page_next = $page_count + 1;
$page_current = $page_count;
$page_count = $page_count * $count_system;


echo "<div class=\"main_each\">";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
echo "<tr><td align=\"left\" class=\"contenthead\">List Open Calls.</td></tr>";
if ($count_system <> "10000"){
  echo "<td align=\"right\">";
  echo "<a href=\"calls_home.php?sub=" . $sub . "&amp;page_count=" . $page_prev . "&amp;sort=" . $sort . "\"><img src=\"" . $but_bac . "\" border=\"0\" alt=\"Previous " . $count_system . " Systems\" title=\"Previous " . $count_system . " Systems\" /></a>&nbsp;&nbsp;&nbsp;"; 
  echo "<a href=\"calls_home.php?sub=" . $sub . "&amp;page_count=0&amp;show_all=1&amp;sort=" . $sort . "\"><img src=\"" . $but_all . "\" border=\"0\" alt=\"All Systems\" title=\"All Systems\" /></a>&nbsp;&nbsp;&nbsp;"; 
  echo "<a href=\"calls_home.php?sub=" . $sub . "&amp;page_count=" . $page_next . "&amp;sort=" . $sort . "\"><img src=\"" . $but_for . "\" border=\"0\" alt=\"Next " . $count_system . " Systems\" title=\"Next " . $count_system . " Systems\" /></a></td>"; 
} else {}
echo "</tr></table>";

$sql = "SELECT * FROM config WHERE config_name = ''";

echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
echo "<tr>";
echo "<td align=\"center\" >&nbsp;&nbsp;<a href=\"calls_home.php?sort=call_id\">Call Id</a>&nbsp;&nbsp;</td>";
echo "<td align=\"center\" >&nbsp;&nbsp;<a href=\"calls_home.php?sort=call_logged_date\">Date Logged</a>&nbsp;&nbsp;</td>";
echo "<td align=\"center\" >&nbsp;&nbsp;<a href=\"calls_home.php?sort=call_priority\">Logged Priority</a>&nbsp;&nbsp;</td>";
echo "<td align=\"center\" >&nbsp;&nbsp;<a href=\"calls_home.php?sort=call_logged_person\">Logged By</a>&nbsp;&nbsp;</td>";
echo "<td align=\"center\" >&nbsp;&nbsp;<a href=\"calls_home.php?sort=call_assigned_person\">Assigned</a>&nbsp;&nbsp;</td>";
echo "<td>&nbsp;&nbsp;<a href=\"calls_home.php?sort=call_short_description\">Description</a>&nbsp;&nbsp;</td>";
echo "</tr>";
$SQL = "SELECT * FROM call ORDER BY " . $sort . " LIMIT " . $page_count . "," . $count_system;
$SQL_count = "SELECT * FROM call";
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
do {
    $sql2 = "SELECT * FROM call_priority WHERE call_priority = '" . $myrow["call_logged_priority"] . "'";
	$result2 = mysql_query($sql2, $db);
	$myrow2 = mysql_fetch_array($result2);
    if ($bgcolor == "#F1F1F1") {
      $bgcolor = "#FFFFFF"; }
    else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">";
	echo "<td align=\"center\" >&nbsp;<a href=\"call_summary.php?id=" . $myrow["call_id"] . "\">" . $myrow["call_id"] . "&nbsp;</td>";
	echo "<td align=\"center\" >&nbsp;" . $myrow["call_logged_date"] . "&nbsp;</td>";
	echo "<td align=\"center\" bgcolor=\"" . $myrow2["call_priority_colour"] . "\">&nbsp;<font color=\"" . $myrow2["call_priority_font_colour"] . "\">" . $myrow2["call_priority_name"] . "</font>&nbsp;</td>";
	echo "<td align=\"center\" >&nbsp;" . $myrow["call_logged_person"] . "&nbsp;</td>";
	echo "<td align=\"center\" >&nbsp;" . $myrow["call_assigned_person"] . "&nbsp;</td>";
	echo "<td>&nbsp;" . $myrow["call_short_description"] . "&nbsp;</td>";
	echo "</tr>";
} while ($myrow = mysql_fetch_array($result));
$total = mysql_query($SQL_count, $db);
$num_rows = mysql_num_rows($total);
echo "<tr><td colspan=\"3\"><br /><b>Total Outstanding Calls: " . $num_rows . "</b></td></tr>";
echo "</table>";
} else {}



?>
</div>
<?php
include "include_png_replace.php";
?>
</body>
</html> 