<?php 
$page = "register";
include "include.php"; 
$bgcolor = "#FFFFFF";
$count = -1;

echo "<div class=\"main_each\">";
echo "<p class=\"contenthead\">Software License Register.</p>";
$SQL = "SELECT * FROM software_register ORDER BY software_title";
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\" class=\"content\">";
  echo "<tr>";
  echo "<td></td>";
  echo "<td><b>&nbsp;&nbsp;Package&nbsp;&nbsp;</b></td>";
  echo "<td align=\"center\"><b>&nbsp;&nbsp;Purchased&nbsp;&nbsp;</b></td>";
  echo "<td align=\"center\"><b>&nbsp;&nbsp;Used&nbsp;&nbsp;</b></td>";
  echo "<td align=\"center\"><b>&nbsp;&nbsp;Audit&nbsp;&nbsp;</b></td>";
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
    if ($bgcolor == "#F1F1F1") {
      $bgcolor = "#FFFFFF"; }
    else { $bgcolor = "#F1F1F1"; }
    echo "<tr bgcolor=\"" . $bgcolor . "\">";
    echo "<td><a href=\"software_register_del_2.php?id=" . $myrow["software_reg_id"] . "&amp;sub=no\" onclick=\"return confirm('Do you really want to DELETE this Package and all its associated purchases ?','software_register_del_2.php?id=" . $myrow["software_reg_id"] . "')\">";
    echo "<input name=\"Submit\" value=\"Delete\" type=\"submit\" /></a></td>";
    echo "<td><a href=\"software_register_details.php?id=" . $myrow["software_reg_id"] . "\">" . $myrow["software_title"] . "</a>&nbsp;&nbsp;</td>";
    echo "<td align=\"center\">" . $number_purchased . "</td>";
    echo "<td align=\"center\">" . $number_used . "</td>";
    echo "<td align=\"center\">" . $font . $number_audit . "</font></td>";
    echo "</tr>";
  } while ($myrow = mysql_fetch_array($result));
  echo "</table>";
} else {
  echo "No Packages in database."; 
}
?>
<script type="text/javascript">
<!--
 function switchUl(id){
  if(document.getElementById){
   a=document.getElementById(id);
   a.style.display=(a.style.display!="none")?"none":"block";
  }
 }
 for(i=0;i<<?php echo $count+1; ?>;i++)   //number of folders HERE
{
  switchDIV('f'+i);
 }
// -->
</script>
</div>
</body>
</html> 