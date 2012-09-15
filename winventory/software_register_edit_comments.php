<?php 
$page = "register";
include "include.php"; 
$bgcolor = "#FFFFFF";
$count = -1;

echo "<div class=\"main_each\">";
echo "<p class=\"contenthead\">Software License Register.</p>";
$SQL = "select * from software_register WHERE software_reg_id = '" . $_GET["id"] . "'";
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\" class=\"content\">";
    echo "<tr>";
    echo "<td><b>&nbsp;&nbsp;Package&nbsp;&nbsp;</b></td>";
    echo "<td align=\"center\"><b>&nbsp;&nbsp;Purchased&nbsp;&nbsp;</b></td>";
    echo "<td align=\"center\"><b>&nbsp;&nbsp;Used&nbsp;&nbsp;</b></td>";
    echo "<td align=\"center\"><b>&nbsp;&nbsp;Audit&nbsp;&nbsp;</b></td>";
    echo "</tr>";
    do {
	  $sql3 = "SELECT SUM(license_purchase_number) AS number_purchased FROM software_licenses WHERE license_software_id = '" . $myrow["software_reg_id"] . "'";
	  $result3 = mysql_query($sql3, $db);
	  $myrow3 = mysql_fetch_array($result3);
	  
	  $sql4 = "SELECT count(software_name) AS number_used FROM software WHERE software_name = '" . $myrow["software_title"] . "'";
	  $result4 = mysql_query($sql4, $db);
	  $myrow4 = mysql_fetch_array($result4);
	  
	  if ($myrow3["number_purchased"] == "") { $number_purchased = 0; } else { $number_purchased = $myrow3["number_purchased"]; }
	  if ($myrow4["number_used"] == "") { $number_used = 0; } else { $number_used = $myrow4["number_used"]; }
	  settype($number_purchased, "integer");
	  settype($number_used, "integer");
	  $number_audit = $number_purchased - $number_used;

	  $font = "<font>";
	  if ($number_audit < "0") { $font = "<font color=\"red\">";}
	  if ($number_audit == "0") { $font = "<font color=\"blue\">";}
	  if ($number_audit > "0") { $font = "<font color=\"green\">";}
	  
      $count = $count + 1;

      echo "<tr bgcolor=\"" . $bgcolor . "\">";
      echo "<td>" . $myrow["software_title"] . "&nbsp;&nbsp;</td>";
      echo "<td align=\"center\">" . $number_purchased . "</td>";
      echo "<td align=\"center\">" . $number_used . "</td>";
      echo "<td align=\"center\">" . $font . $number_audit . "</font></td>";
      echo "</tr>";
      echo "</table>";
	  echo "<form action=\"software_register_edit_comments_2.php?id=" . $_GET["id"] . "\" method=\"post\">";
	  echo "<table bgcolor=\"" . $bgcolor . "\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\" class=\"content\">";
      echo "<tr>";
      echo "<td valign=\"top\"><textarea rows=\"4\" name=\"comments\" cols=\"60\">" . $myrow["software_comments"] . "</textarea></td>";
      echo "</tr>";
      echo "<tr>";
	  echo "<td><input name=\"Submit\" value=\"Submit\" type=\"submit\" /></td>";
	  echo "</tr>";
      echo "</table>";
	  echo "</form>";
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
    } while ($myrow = mysql_fetch_array($result));
} else {}


echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\" class=\"content\">";
$sql2 = "SELECT * FROM software_licenses WHERE license_software_id = '" . $_GET["id"] . "'";
$result2 = mysql_query($sql2, $db);
if ($myrow2 = mysql_fetch_array($result2)){
  do {
    echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Purchase Date:&nbsp;</td><td>" . $myrow2["license_purchase_date"] . "</td>";
    echo "    <td rowspan=5 valign=\"top\">Comments:&nbsp;" . $myrow2["license_comments"] . "</td></tr>";
    echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Number Purchased:&nbsp;</td><td>" . $myrow2["license_purchase_number"] . "</td></tr>";
    echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Vendor:&nbsp;</td><td>" . $myrow2["license_purchase_vendor"] . "</td></tr>";
    echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Cost (each):&nbsp;</td><td>" . $myrow2["license_purchase_cost_each"] . "</td></tr>";
    echo "<tr bgcolor=\"" . $bgcolor . "\"><td>License Type:&nbsp;<br>&nbsp;</td><td>" . $myrow2["license_purchase_type"] . "<br>&nbsp;</td></tr>";
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
  } while ($myrow2 = mysql_fetch_array($result2));
  echo "<td colspan=3><br />&nbsp;<a href=\"software_add_license.php?id=" . $_GET["id"] . "\"><input name=\"Submit\" value=\"Add License\" type=\"submit\" /></a></td></tr>";
  echo "</td></tr>";
} else {
  echo "<tr><td><br />&nbsp;No licenses purchased.<br /><a href=\"software_add_license.php?id=" . $_GET["id"] . "\"><input name=\"Submit\" value=\"Add License\" type=\"submit\" /></a></td></tr>";
}
echo "</table>";

?>
</div>
</body>
</html> 