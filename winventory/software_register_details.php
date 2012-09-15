<?php 
$page = "register";
include "include.php"; 
$bgcolor = "#FFFFFF";
$count = -1;
echo "<div class=\"main_each\">";



$SQL = "select * from software_register WHERE software_reg_id = '" . $_GET["id"] . "'";
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
    $name = $myrow["software_title"];
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\" class=\"content\">\n";
	echo "<tr><td class=\"contenthead\" colspan=\"2\">Software License Register Details for " . $myrow["software_title"] . "</td></tr>\n";
	echo "<tr><td class=\"contenthead\"><br />Usage Details.</td></tr>\n";
    echo "<tr>\n";
    echo "<td><b>Package Name&nbsp;&nbsp;</b></td>\n";
    echo "<td align=\"center\"><b>&nbsp;&nbsp;Purchased&nbsp;&nbsp;</b></td>\n";
    echo "<td align=\"center\"><b>&nbsp;&nbsp;Used&nbsp;&nbsp;</b></td>\n";
    echo "<td align=\"center\"><b>&nbsp;&nbsp;Audit&nbsp;&nbsp;</b></td>\n";
    echo "</tr>";
    do {
	  $sql3 = "SELECT SUM(license_purchase_number) AS number_purchased FROM software_licenses WHERE license_software_id = '" . $myrow["software_reg_id"] . "'";
	  $result3 = mysql_query($sql3, $db);
	  $myrow3 = mysql_fetch_array($result3);
	  
	  $sql4 = "SELECT count(software_name) AS number_used FROM software WHERE software_name = '" . addslashes($myrow["software_title"]) . "'"; 
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

      echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
      echo "<td>" . $myrow["software_title"] . "&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\">" . $number_purchased . "</td>\n";
      echo "<td align=\"center\">" . $number_used . "</td>\n";
      echo "<td align=\"center\">" . $font . $number_audit . "</font></td>\n";
      echo "</tr>\n";
      echo "</table>\n";
	  echo "<table bgcolor=\"" . $bgcolor . "\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\" class=\"content\">\n";
      echo "<tr>\n";
      echo "<td width=\"150\">Comments:<br /><br /><form name=\"Edit_Comments\" action=\"software_register_edit_comments.php?id=" . $_GET["id"] . "\" method=\"post\"><input name=\"Submit\" value=\"Edit Comments\" type=\"submit\" /></form></td>\n";
      echo "<td valign=\"top\">" . $myrow["software_comments"] . "</td>";
      echo "</tr>\n";
	  echo "<tr>\n";
	  echo "<td><form name=\"Add_License\" action=\"software_add_license.php?id=" . $_GET["id"] . "\" method=\"post\"><input name=\"Submit\" value=\"Add License\" type=\"submit\" /></form><br />&nbsp;</td>\n";
	  echo "</tr>\n";
      echo "</table>\n";
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
    } while ($myrow = mysql_fetch_array($result));
} else {}


echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\" class=\"content\">\n";
echo "<tr><td class=\"contenthead\">Software Licenses Purchased.</td></tr>\n";
$sql2 = "SELECT * FROM software_licenses WHERE license_software_id = '" . $_GET["id"] . "'";
$result2 = mysql_query($sql2, $db);
if ($myrow2 = mysql_fetch_array($result2)){
  do {
    echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Purchase Date:&nbsp;</td><td>" . $myrow2["license_purchase_date"] . "</td>\n";
    echo "<td rowspan=\"5\" valign=\"top\">Comments:&nbsp;<br />" . $myrow2["license_comments"] . "</td></tr>\n";
    echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Number Purchased:&nbsp;</td><td>" . $myrow2["license_purchase_number"] . "</td></tr>\n";
    echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Vendor:&nbsp;</td><td>" . $myrow2["license_purchase_vendor"] . "</td></tr>\n";
    echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Cost (each):&nbsp;</td><td>" . $myrow2["license_purchase_cost_each"] . "</td></tr>\n";
    echo "<tr bgcolor=\"" . $bgcolor . "\"><td>License Type:&nbsp;</td><td>" . $myrow2["license_purchase_type"] . "</td></tr>\n";
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td><a href=\"software_register_del_license.php?id=" . $myrow2["license_id"] . "&amp;id2=" . $_GET["id"] . "\" onclick=\"return confirm('Do you really want to DELETE this license ?','software_register_del_license.php?id=" . $myrow2["license_id"] . "&amp;id2=" . $_GET["id"] . "')\">\n";
    echo "<input name=\"Submit\" value=\"Delete This License\" type=\"submit\" /></a><br />&nbsp;</td><td></td><td></td>\n";
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
  } while ($myrow2 = mysql_fetch_array($result2));
  
} else {}
echo "</table>";



  $SQL = "select sys.system_uuid, sys.system_description, sys.net_ip_address, sys.system_name, sw.software_name from software sw, system sys where sw.software_name = '" . addslashes($name) . "' AND sw.software_uuid = sys.system_uuid ORDER BY sys.system_name";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\" class=\"content\">\n";
	echo "<tr><td class=\"contenthead\" colspan=\"3\"><br />Systems with \"" . $name . "\" installed.</td></tr>\n";
    echo "<tr><td>&nbsp;&nbsp;IP Address</td><td>&nbsp;&nbsp;Name</td><td>&nbsp;&nbsp;Description</td></tr>\n";
    do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
      echo "<td>&nbsp;&nbsp;" . $myrow["net_ip_address"] . "&nbsp;&nbsp;</td><td>&nbsp;&nbsp;<a href=\"system_summary.php?pc=" . $myrow["system_uuid"] . "\" class=\"content\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;" . $myrow["system_description"] . "</td>\n";
      echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
  } else {
    echo "No Systems have this software installed.";
  }
echo "</table>\n";

?>
</div>
</div>
</body>
</html> 