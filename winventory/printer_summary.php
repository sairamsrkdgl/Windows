<?php 
$sql = "";
$page = "other";
include "include.php"; 
$SQL = "SELECT * FROM printer WHERE printer_id = '" . $_GET['printer'] . "'";
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
do {
  echo "<div class=\"main_each\">";
  echo "<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
  echo "<tr><td colspan=\"2\" class=\"contenthead\"><img src=\"images/inv_printer" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />&nbsp;" . $myrow["printer_caption"] . "</td></tr>";
  echo "<tr><td>Name:&nbsp;</td><td>" . $myrow["printer_caption"] . "</td></tr>";
  echo "<tr><td>Location:&nbsp;</td><td>" . $myrow["printer_location"] . "</td></tr>";
  if ($myrow["printer_ip"]) {
    echo "<tr><td>Network Address:&nbsp;</td><td>" . ip_trans($myrow["printer_ip"]) . "</td></tr>";
	echo "<tr><td>MAC Address:&nbsp;</td><td>" . return_unknown($myrow["printer_mac_address"]) . "</td></tr>\n";
  } else {
	echo "<tr><td>Attached with PC:&nbsp;</td><td>" . $myrow["printer_system_name"] . "</td></tr>\n";
  }
	echo "<tr><td>Date Discovered:&nbsp;</td><td>" . return_date($myrow["printer_first_timestamp"]) . "</td></tr>\n";
	echo "<tr><td>Manufacturer:&nbsp;</td><td>" . $myrow["printer_manufacturer"] . "</td></tr>\n";
	echo "<tr><td>Model Number:&nbsp;</td><td>" . $myrow["printer_model"] . "</td></tr>\n";
	echo "<tr><td>Serial Number:&nbsp;</td><td>" . $myrow["printer_serial"] . "</td></tr>\n";
	echo "<tr><td>Physical Location:&nbsp;</td><td>" . $myrow["printer_location"] . "</td></tr>\n";
	echo "<tr><td>Date of Purchase:&nbsp;(yyyy-mm-dd)&nbsp;</td><td>" . $myrow["printer_date_purchased"] . "</td></tr>\n";
	echo "<tr><td>Dollar Value:&nbsp;</td><td>$" . $myrow["printer_value"] . "</td></tr>\n";
	echo "<tr><td valign=\"top\">Description:&nbsp;</td><td>" . $myrow["printer_description"] . "</td></tr>\n";
	echo "<tr><td><form action=\"printer_edit.php?printer=" . $_GET['printer'] . "\" method=\"post\"><input name=\"Submit\" value=\" Edit \" type=\"submit\" class=\"content\" /></form></td></tr>\n";
	$SQL2 = "SELECT * from nmap_other_ports WHERE nmap_other_id = '" . $myrow["printer_mac_address"] . "' ORDER BY nmap_port_number";
	$result2 = mysql_query($SQL2, $db);
	if ($myrow2 = mysql_fetch_array($result2)){
	echo "<tr><td class=\"contenthead\" colspan=\"2\"><br /><img src=\"images/inv_nmap" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />&nbsp;Nmap detected open ports</td></tr>\n";
	echo "<tr><td>Port Number</td><td>Port Name</td></tr>\n";
	  do {
		  echo "<tr bgcolor=\"" . $bgcolor . "\"><td>" . $myrow2["nmap_port_number"] . "</td><td>" . $myrow2["nmap_port_name"] . "</td></tr>";
	  } while ($myrow2 = mysql_fetch_array($result2));
	} else {
	echo "<tr><td><br />No open ports detected by Nmap.</td></tr>";
	}
  } while ($myrow = mysql_fetch_array($result));
} else {}
echo "</table>";
echo "</div>";
echo "</body>";
echo "</html> ";
include "include_png_replace.php";
?>