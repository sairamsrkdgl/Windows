<?php 
$sql = "";
$page = "other";
include "include.php"; 
$SQL = "SELECT * FROM printer WHERE printer_id = '" . $_GET['printer'] . "'";
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
echo "<div class=\"main_each\">";
echo "<form action=\"other_edit_2.php?sub=no&amp;other=" . $_GET['printer'] . "\" method=\"post\">";
echo "<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
echo "<tr><td colspan=\"2\" class=\"contenthead\"><img src=\"images/inv_printer" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />&nbsp;" . $myrow["printer_caption"] . "</td></tr>";
echo "<tr><td>Name:&nbsp;</td><td><input type=\"text\" name=\"name\" size=\"30\" value=\"" . $myrow['printer_caption'] . "\" class=\"content\" /></td></tr>";
echo "<tr><td>Location:&nbsp;</td><td><input type=\"text\" name=\"location\" size=\"30\" value=\"" . $myrow['printer_location'] . "\" class=\"content\" /></td></tr>";
if ($myrow["printer_ip"]) {
  echo "<tr><td>Network Address:&nbsp;</td><td><input type=\"text\" name=\"ip\" size=\"30\" value=\"" . ip_trans($myrow["printer_ip"]) . "\" class=\"content\" /></td></tr>";
  echo "<tr><td>MAC Address:&nbsp;</td><td>" . $myrow['printer_mac_address'] . "</td></tr>\n";
} else {
  echo "<tr><td>Attached with PC:&nbsp;</td><td>" . $myrow["printer_system_name"] . "</td></tr>\n";
}
echo "<tr><td>Date Discovered:&nbsp;</td><td>" . return_date($myrow["printer_first_timestamp"]) . "</td></tr>\n";
echo "<tr><td>Manufacturer:&nbsp;</td><td><input type=\"text\" name=\"manufacturer\" size=\"30\" value=\"" . $myrow['printer_manufacturer'] . "\" class=\"content\" /></td></tr>\n";
echo "<tr><td>Model Number:&nbsp;</td><td><input type=\"text\" name=\"model\" size=\"30\" value=\"" . $myrow['printer_model'] . "\" class=\"content\" /></td></tr>\n";
echo "<tr><td>Serial Number:&nbsp;</td><td><input type=\"text\" name=\"serial\" size=\"30\" value=\"" . $myrow['printer_serial'] . "\" class=\"content\" /></td></tr>\n";
echo "<tr><td>Physical Location:&nbsp;</td><td><input type=\"text\" name=\"location\" size=\"30\" value=\"" . $myrow['printer_location'] . "\" class=\"content\" /></td></tr>\n";
echo "<tr><td>Date of Purchase:&nbsp;(yyyy-mm-dd)&nbsp;</td><td><input type=\"text\" name=\"date_purchased\" size=\"30\" value=\"" . $myrow['printer_date_purchased'] . "\" class=\"content\" /> (yyyy-mm-dd)</td></tr>\n";
echo "<tr><td>Dollar Value:&nbsp;</td><td>$<input type=\"text\" name=\"value\" size=\"29\" value=\"" . $myrow['printer_value'] . "\" class=\"content\" /></td></tr>\n";
echo "<tr><td valign=\"top\">Description:&nbsp;</td><td><input type=\"text\" name=\"description\" size=\"30\" value=\"" . $myrow['printer_description'] . "\" class=\"content\" /></td></tr>\n";
echo "<tr><td><input name=\"Submit\" value=\"Submit\" type=\"Submit\" /></td></tr>\n";
} else {}
echo "</table>";
echo "</div>";
echo "</body>";
echo "</html> ";
include "include_png_replace.php";
?>