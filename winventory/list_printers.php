<?php 
$page = "other";
$extra = "";
include "include.php";

if ($sort == "system_name") {$sort = 'printer_system_name';} else {}
if (isset($_GET["show_all"])){ $count_system = '10000'; } else {}
if (isset($_GET["page_count"])){ $page_count = $_GET["page_count"]; } else { $page_count = 0;}
$page_prev = $page_count - 1;
if ($page_prev < 0){ $page_prev = 0; } else {}
$page_next = $page_count + 1;
$page_current = $page_count;
$page_count = $page_count * $count_system;

  $SQL = "SELECT * FROM printer ORDER by $sort LIMIT " . $page_count . "," . $count_system;
  echo "<br />";
  echo "<div class=\"main_each\">";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
  echo "<tr><td align=\"left\" class=\"contenthead\">List All Printers<br />&nbsp;</td>\n";
  if ($count_system <> "10000"){
    echo "<td align=\"right\">\n";
    echo "<a href=\"list_printers.php?sort=$sort&amp;page_count=" . $page_prev . "\" class=\"content\"><img src=\"" . $but_bac . "\" border=0 alt=\"Previous " . $count_system . " Systems\" title=\"Previous " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
    echo "<a href=\"list_printers.php?sort=$sort&amp;page_count=0&amp;show_all=1\" class=\"content\"><img src=\"" . $but_all . "\" border=0 alt=\"All Systems\" title=\"All Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
    echo "<a href=\"list_printers.php?sort=$sort&amp;page_count=" . $page_next . "\" class=\"content\"><img src=\"" . $but_for . "\" border=0 alt=\"Next " . $count_system . " Systems\" title=\"Next " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a>&nbsp;<br />&nbsp;</td>\n";
	echo "</td>\n";
  } else {}
  echo "</tr></table>\n";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<tr>";
	echo "<td><a href=\"list_printers.php?sort=printer_system_name\"><b>System</b></a></td>\n";
	echo "<td><a href=\"list_printers.php?sort=printer_caption\"><b>Caption</b></a></td>\n";
	echo "<td><a href=\"list_printers.php?sort=printer_port_name\"><b>Port</b></a></td>\n";
	echo "<td><a href=\"list_printers.php?sort=printer_location\"><b>Location</b></a></td></tr>\n";
    do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
      echo "<td>";
      if ($myrow["printer_uuid"]) { echo "<a href=\"system_summary.php?pc=" . $myrow["printer_uuid"] . "\">";}
      echo $myrow["printer_system_name"];
      if ($myrow["printer_uuid"]) { echo "</a>";}
      echo "</td>\n";
      echo "<td><a href=\"printer_summary.php?printer=" . $myrow["printer_id"] . "\">" . $myrow["printer_caption"] . "</a></td>\n";
      echo "<td>" . $myrow["printer_port_name"] . "</td>\n";
      echo "<td>" . $myrow["printer_location"] . "</td>\n";
      echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
  $num_rows = mysql_num_rows($result);
  echo "<tr><td colspan=3><br /><b>Total Printers: " . $num_rows . "</b></td>\n";
  } else {
    echo "<tr><td><br />No Printers in database.</td></tr>";
  }
  echo "</table>";
  if ($count_system <> "10000"){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
    echo "<td align=\"right\"><br />\n";
    echo "<a href=\"list_printers.php?sub=" . $sub . "&amp;page_count=" . $page_prev . "\"><img src=\"" . $but_bac . "\" border=0 alt=\"Previous " . $count_system . " Systems\" title=\"Previous " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
    echo "<a href=\"list_printers.php?sub=" . $sub . "&amp;page_count=0&amp;show_all=1\"><img src=\"" . $but_all . "\" border=0 alt=\"All Systems\" title=\"All Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
    echo "<a href=\"list_printers.php?sub=" . $sub . "&amp;page_count=" . $page_next . "\"><img src=\"" . $but_for . "\" border=0 alt=\"Next " . $count_system . " Systems\" title=\"Next " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a>&nbsp;\n";
	echo "</td>\n";
  } else {
    echo "<td></td>\n";
  }
  echo "</tr>\n";
  echo "</table>\n";




?>

</div>
<?php
include "include_png_replace.php";
?>
</body>
</html> 