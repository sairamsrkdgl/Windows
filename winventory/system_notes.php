<?php 
$page = "no";
include "include.php"; 
$bgcolor = "#FFFFFF";

echo "<div class=\"main_each\">";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
echo "<tr>\n";
echo "<td align=\"left\" class=\"contenthead\">Notes for " . $name . "<br />&nbsp;</td>\n";
echo "</tr>\n";
echo "</table>\n";
$SQL = "SELECT * FROM notes WHERE notes_uuid = '$pc' ORDER BY notes_id";
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\" class=\"content\">";
  echo "<tr><td class=\"menuhead\"><img src=\"images/inv_notes" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />Notes</td></tr>";
  do {
    echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
    echo "<td valign=\"top\"><a href=\"system_notes_del.php?note=" . $myrow["notes_id"] . "&amp;pc=" . $pc . "&amp;sub=no\" onclick=\"return confirm('Do you really want to DELETE this note ?','system_notes_del.php?')\"><img src=\"images/button_cancel.gif\" border=\"0\" title=\"Delete this Note.\" alt=\"Delete this Note.\" height=\"16\" width=\"16\" /></a>&nbsp;Note:&nbsp;&nbsp;" . $myrow["notes_notes"] . "</td>\n";
    echo "</tr>\n";
	if ($bgcolor == "#F1F1F1") {
		$bgcolor = "#FFFFFF"; }
	else { $bgcolor = "#F1F1F1"; }
  } while ($myrow = mysql_fetch_array($result));
  echo "</table>\n";
} else {}
echo "<form action=\"system_notes_add.php?sub=no\" method=\"post\">\n";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"700\">\n";
echo "<tr><td align=\"left\"><br />Add a note below.<br />\n";
echo "<textarea rows=\"4\" name=\"note\" cols=\"60\"></textarea><br />\n";
echo "<input type=\"submit\" value=\"submit\" name=\"submit\" />\n";
echo "<input type=\"hidden\" value=\"" . $pc . "\" name=\"pc\" />\n";
echo "</td></tr>\n";
echo "</table>\n";
echo "</form>\n";
echo "</div>\n";
echo "</body>\n";
echo "</html>\n";
include "include_png_replace.php";
?>