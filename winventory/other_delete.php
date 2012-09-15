<?php 
$page = "other";
include "include.php"; 

$bgcolor = "#FFFFFF";
$SQL = "SELECT * FROM other ORDER BY other_ip, other_name"; 
echo "<div class=\"main_each\">";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\" class=\"content\">\n";
echo "<tr><td colspan=\"4\" class=\"contenthead\">Delete Other Item.</td></tr>\n";
echo "<tr>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
echo "<td>&nbsp;&nbsp;IP Address&nbsp;&nbsp;</td>\n";
echo "<td>&nbsp;&nbsp;Type&nbsp;&nbsp;</td>\n";
echo "<td>&nbsp;&nbsp;Name&nbsp;&nbsp;</td>\n";
echo "<td>&nbsp;&nbsp;Description&nbsp;&nbsp;</td>\n";
echo "</tr>";
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
do {
  if ($bgcolor == "#F1F1F1") {
    $bgcolor = "#FFFFFF"; }
  else { $bgcolor = "#F1F1F1"; }
  echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
  echo "<td><a href=\"other_delete_2.php?mac=" . $myrow["other_id"] . "\" ";
  echo " onmouseover=\"document.button" . $myrow["other_id"] . ".src='images/button_delete_over.png'\" ";
  echo " onmousedown=\"document.button" . $myrow["other_id"] . ".src='images/button_delete_down.png'\"";
  echo " onmouseout=\"document.button" . $myrow["other_id"] . ".src='images/button_delete_out.png'\"";
  echo " onclick=\"Javascript:return confirm('Do you really want to DELETE this item ?');\">";
  echo " <img src=\"images/button_delete_out.png\" name=\"button" . $myrow["other_id"] . "\" width=\"58\" height=\"22\" border=\"0\" alt=\"\" /></a></td>";
  echo "<td>&nbsp;" . $myrow["other_ip"] . "&nbsp;</td>\n";
  echo "<td align=\"center\"><img src=\"images/other_devices/" . url_clean($myrow["other_type"]) . ".png\" width=\"33\" height=\"33\" alt=\"" . $myrow["other_type"] . "\" title=\"". $myrow["other_type"] ."\" />&nbsp;</td>\n";
  echo "<td>&nbsp;<a href=\"other_summary.php?other=" . $myrow["other_id"] . "&amp;sub=1\">" . $myrow["other_name"] . "</a>&nbsp;&nbsp;&nbsp;</td>\n";
  echo "<td>&nbsp;" . $myrow["other_description"] . "&nbsp;&nbsp;&nbsp;</td>\n";
  echo "</tr>\n\n";

} while ($myrow = mysql_fetch_array($result));

} else {echo "There are no 'other' items to delete."; }
echo "</table>";

include "include_png_replace.php";
?>

</div>
</body>
</html> 