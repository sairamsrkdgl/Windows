<?php 
$page = "no";
include "include.php"; 

echo "<div class=\"main_each\">";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
echo "<tr>\n";
echo "<td align=\"left\" class=\"contenthead\">Passwords for " . $name . "<br />&nbsp;</td>\n";
echo "</tr>\n";
echo "</table>\n";

$SQL = "SELECT * FROM passwords WHERE passwords_uuid = '$pc' ORDER BY passwords_id";
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
  echo "<tr><td class=\"menuhead\" colspan=\"2\"><img src=\"images/inv_passwords" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />Passwords</td></tr>\n";
  do {
    echo "<tr bgcolor=\"" . $bgcolor . "\"><td width=\"20\"><a href=\"system_passwords_del.php?pass=" . $myrow["passwords_id"] . "&amp;pc=" . $pc . "\" onclick=\"return confirm('Do you really want to DELETE this note ?','system_passwords_del.php?')\"><img src=\"images/button_cancel.gif\" border=\"0\" title=\"Delete this Password.\" alt=\"Delete this Password.\" height=\"16\" width=\"16\" /></a>\n";
	echo "</td><td width=\"120\">Application Name:&nbsp;</td><td >" . $myrow["passwords_application"] . "</td><td></td></tr>\n";
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td></td><td>User:&nbsp;</td><td>" . $myrow["passwords_user"] . "</td><td></td></tr>\n";
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td></td><td>Password:&nbsp;</td><td>" . $myrow["passwords_password"] . "</td><td></td></tr>\n";
	if ($bgcolor == "#F1F1F1") {
		$bgcolor = "#FFFFFF"; }
	else { $bgcolor = "#F1F1F1"; }
  } while ($myrow = mysql_fetch_array($result));
  echo "</table>\n";
} else {}
echo "<form action=\"system_passwords_add.php\" method=\"post\">\n";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"700\">\n";
echo "<tr><td><br />Add a password below.</td></tr>\n";
echo "<tr><td>Application Name:</td><td><input type=\"text\" name=\"app\" size=\"20\" /></td></tr>\n";
echo "<tr><td>User:</td><td><input type=\"text\" name=\"usr\" size=\"20\" /></td></tr>\n";
echo "<tr><td>Password:</td><td><input type=\"text\" name=\"pas\" size=\"20\" /></td></tr>\n";
echo "<tr><td><input type=\"submit\" value=\"submit\" name=\"submit\" /></td></tr>\n";
echo "</table>\n";
echo "<input type=\"hidden\" value=\"" . $pc . "\" name=\"pc\" />\n";
echo "</form>\n";
echo "</div>\n";
echo "</body>\n";
echo "</html>\n";
include "include_png_replace.php";
?>