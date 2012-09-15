<?php 
$sql = "";
$page = "other";
include "include.php"; 
$SQL = "SELECT * FROM other WHERE other_id = '" . $_GET['other'] . "'";
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
do {
  echo "<div class=\"main_each\">";
  echo "<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
  echo "<tr><td colspan=\"2\" class=\"contenthead\"><img src=\"images/other_devices/" . url_clean($myrow["other_type"]) . ".png\" width=\"32\" height=\"32\" alt=\"\" />&nbsp;" . $myrow["other_name"] . "</td></tr>";
  echo "<tr><td>Name:&nbsp;</td><td>" . $myrow["other_name"] . "</td></tr>";
  echo "<tr><td>Type:&nbsp;</td><td>" . $myrow["other_type"] . "</td></tr>";
  $SQL2 = "select * from system WHERE system_uuid = '" . $myrow["other_linked_pc"] . "'";
  $result2 = mysql_query($SQL2, $db);
  if ($myrow2 = mysql_fetch_array($result2)){
    do {
	    echo "<tr><td>Associated with PC:&nbsp;</td><td>" . $myrow2["net_ip_address"] . "  -  " . $myrow2["system_name"] . "</td></tr>\n";
	} while ($myrow2 = mysql_fetch_array($result2));
  } else echo "<tr><td>Associated with PC:&nbsp;</td><td>" . $myrow["other_linked_pc"] . "</td></tr>\n";
    echo "<tr><td>IP Address:&nbsp;</td><td>" . ip_trans($myrow["other_ip"]) . "</td></tr>\n";
	echo "<tr><td>MAC Address:&nbsp;</td><td>" . $myrow["other_mac_address"] . "</td></tr>\n";
	echo "<tr><td>Date Discovered:&nbsp;</td><td>" . $myrow["other_date_detected"] . "</td></tr>\n";
	echo "<tr><td>Manufacturer:&nbsp;</td><td>" . $myrow["other_manufacturer"] . "</td></tr>\n";
	echo "<tr><td>Model Number:&nbsp;</td><td>" . $myrow["other_model"] . "</td></tr>\n";
	echo "<tr><td>Serial Number:&nbsp;</td><td>" . $myrow["other_serial"] . "</td></tr>\n";
	echo "<tr><td>Physical Location:&nbsp;</td><td>" . $myrow["other_location"] . "</td></tr>\n";
	echo "<tr><td>Date of Purchase:&nbsp;(yyyy-mm-dd)&nbsp;</td><td>" . $myrow["other_date_purchase"] . "</td></tr>\n";
	echo "<tr><td>Dollar Value:&nbsp;</td><td>$" . $myrow["other_value"] . "</td></tr>\n";
	echo "<tr><td valign=\"top\">Description:&nbsp;</td><td>" . $myrow["other_description"] . "</td></tr>\n";
	echo "<tr><td><form action=\"other_edit.php?other=" . $_GET['other'] . "\" method=\"post\"><input name=\"Submit\" value=\" Edit \" type=\"submit\" class=\"content\" /></form></td></tr>\n";
	$SQL2 = "SELECT * from nmap_other_ports WHERE nmap_other_id = '" . $myrow["other_mac_address"] . "' ORDER BY nmap_port_number";
	$result2 = mysql_query($SQL2, $db);
	echo "<tr><td class=\"contenthead\" colspan=\"2\"><br /><img src=\"images/inv_nmap" . $pic_style . ".png\" width=\"32\" height=\"32\" alt=\"\" />&nbsp;Nmap detected open ports</td></tr>\n";
	echo "<tr><td>Port Number</td><td>Port Name</td></tr>\n";
	if ($myrow2 = mysql_fetch_array($result2)){
	  do {
		  echo "<tr bgcolor=\"" . $bgcolor . "\"><td>" . $myrow2["nmap_port_number"] . "</td><td>" . $myrow2["nmap_port_name"] . "</td></tr>";
	  } while ($myrow2 = mysql_fetch_array($result2));
	} else {
	echo "<tr><td>No open ports detected by Nmap.</td></tr>";
	}
  } while ($myrow = mysql_fetch_array($result));
} else {}
echo "</table>";
echo "</div>";
echo "</body>";
echo "</html> ";
include "include_png_replace.php";
?>