<?php 
$page = "admin";

include "include.php"; 

$SQL = "SELECT * FROM system ORDER BY system_name";
echo "<div class=\"main_each\">";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
echo "<tr><td colspan=\"4\" class=\"contenthead\">Delete a PC.</td></tr>";


$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
  echo "<tr><td><b>IP Address</b></td><td><b>Name</b></td><td><b>Date Last Audited</b></td><td></td></tr>"; 
  do {
  if ($bgcolor == "#F1F1F1") {
    $bgcolor = "#FFFFFF"; }
  else { $bgcolor = "#F1F1F1"; }
  echo "<tr bgcolor=\"" . $bgcolor . "\" height=\"24\">";
  echo "<td>" . $myrow["net_ip_address"] . "</td>\n";
  echo "<td>" . $myrow["system_name"] . "</td>\n";
  echo "<td>" . return_date_time($myrow["system_timestamp"]) . "</td>\n";
  echo "<td><a href=\"admin_pc_delete_2.php?pc=" . $myrow["system_uuid"] . "&amp;sub=no\"";
  echo " onmouseover=\"document.button" . str_replace("-","",$myrow["system_name"]) . ".src='images/button_delete_over.png'\" ";
  echo " onmousedown=\"document.button" . str_replace("-","",$myrow["system_name"]) . ".src='images/button_delete_down.png'\"";
  echo " onmouseout=\"document.button" . str_replace("-","",$myrow["system_name"]) . ".src='images/button_delete_out.png'\"";
  echo " onclick=\"Javascript:return confirm('Do you really want to DELETE this PC ?');\">";
  echo "<img src=\"images/button_delete_out.png\" name=\"button" . str_replace("-","",$myrow["system_name"]) . "\" width=\"58\" height=\"22\" border=\"0\" alt=\"\" />";
  echo "</a></td></tr>\n\n";

} while ($myrow = mysql_fetch_array($result));

} else {echo "<p class=\"contenthead\">No PCs have been audited.</p>"; }
echo "</table>";

?>
</div>
</body>
</html> 