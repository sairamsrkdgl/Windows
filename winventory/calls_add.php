<?php 
$page = "calls";
include "include.php"; 
$SQL = "SELECT count(*) as count from config where config_name = 'calls'";
$result = mysql_query($SQL, $db);
$myrow = mysql_fetch_array($result);
if ($myrow["count"] <> "1"){
  echo "<div class=\"main_each\">\n";
  echo "<p>Please setup your calls <a href=\"calls_setup.php\">HERE</a>.</p>";
  echo "</div>";
} else {

echo "<div class=\"main_each\">\n";
echo "<form action=\"call_add_2.php?sub=no\" method=\"post\">\n";
echo "<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
echo "<tr><td class=\"contenthead\">Add a Call.</td></tr>\n";
echo "<tr><td>Logged By:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select size=\"1\" name=\"logged_by\" class=\"content\">\n";
$SQL = "SELECT * FROM call_user ORDER BY call_user_surname";
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
  do {
    echo "<option value=\"" . $myrow["call_user_id"] . "\">";
    echo $myrow["call_user_first_name"] . "&nbsp;" . $myrow["call_user_surname"] . "</option>\n";
  } while ($myrow = mysql_fetch_array($result));
} else {}
echo "</select></td></tr>";
echo "<tr><td>Department:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select size=\"1\" name=\"logged_by\" class=\"content\">\n";
$SQL = "SELECT * FROM call_user ORDER BY call_user_department";
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
  do {
    echo "<option value=\"" . $myrow["call_user_department"] . "\">";
    echo $myrow["call_user_department"] . "</option>\n";
  } while ($myrow = mysql_fetch_array($result));
} else {}
echo "</select></td></tr>";
echo "<tr><td>Date Logged:&nbsp;" . date('Y-m-d H:m:s') . "</td></tr>";
echo "<tr><td>Call Priority:&nbsp;&nbsp;&nbsp;&nbsp;<select size=\"1\" name=\"priority\" class=\"content\">\n";
$SQL = "SELECT * FROM call_priority ORDER BY call_priority DESC";
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
  do {
    echo "<option value=\"" . $myrow["call_priority_id"] . "\" color=\"" . $myrow["call_priority_colour"] . "\">";
    echo $myrow["call_priority_name"] . "</option>\n";
  } while ($myrow = mysql_fetch_array($result));
} else {}
echo "</select></td></tr>";
echo "<tr><td>Enter details below:<br /><textarea rows=\"10\" name=\"detail\" cols=\"60\"></textarea><br /></td></tr>";
echo "<tr><td><input type=\"submit\" name=\"submit\" value=\"Submit Help\"></td></tr>";


echo "</table>";
echo "</form>";
echo "</div>";
echo "</body>";
echo "</html>";
include "include_png_replace.php";
}
?>