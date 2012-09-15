<?php 
$page = "su";
include "include.php"; 

echo "<div class=\"main_each\">";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">";
echo "<tr>";
echo "<td align=\"left\" class=\"contenthead\">Manual Entries for " . $name . "<br />&nbsp;</td>";
echo "</tr>";
$SQL = "SELECT * FROM system_man WHERE system_man_uuid = '$pc'";
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
  do {
    echo "<tr><td class=\"contenthead\" colspan=\"2\"><img src=\"images/inv_summary$pic_style.png\" width=\"64\" height=\"64\" alt=\"\" />Entries</td></tr>\n";
    echo "<tr><td>Description:</td><td>" . $myrow["system_man_description"] . "</td></tr>\n";
    echo "<tr bgcolor=\"$bg1\"><td>Location:</td><td>" . $myrow["system_man_location"] . "</td></tr>\n";
    echo "<tr><td>Serial Number:</td><td>" . $myrow["system_man_serial_number"] . "</td></tr>\n";
    echo "<tr bgcolor=\"$bg1\"><td>Vendor:</td><td>" . $myrow["system_man_vendor"] . "</td></tr>\n";
    echo "<tr><td>Purchase Order Number:</td><td>" . $myrow["system_man_purchase_order_number"] . "</td></tr>\n";
    echo "<tr bgcolor=\"$bg1\"><td>Ethernet Wall Socket:</td><td>" . $myrow["system_man_ethernet_socket"] . "</td></tr>\n";
    echo "<tr><td>Phone Number:</td><td>" . $myrow["system_man_phone_number"] . "</td></tr>\n";
    echo "<tr bgcolor=\"$bg1\"><td>Date of Purchase:</td><td>" . $myrow["system_man_date_of_purchase"] . "</td></tr>\n";
    echo "<tr><td>Terminal Number:</td><td>" . $myrow["system_man_terminal_number"] . "</td></tr>\n";
  } while ($myrow = mysql_fetch_array($result));
} else {}
echo "<tr><td>&nbsp;</td></tr>";
echo "</table>";
echo "</div>";
echo "</body>";
echo "</html> ";
include "include_png_replace.php";
?>