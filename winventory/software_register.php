<?php 
$page = "register";
include "include.php"; 
$bgcolor = "#FFFFFF";
$count = -1;
  echo "<div class=\"main_each\">";
  echo "<p class=\"contenthead\">Software License Register.</p>";


  $SQL = "select * from software_register ORDER BY software_title";
  //$SQL = "select * from software_register left outer join group_names on software_register.group_id = group_names.group_id ORDER BY group_names.group_id, software_title";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    $group_id = $myrow["group_id"];
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\" class=\"content\">";
    echo "<tr>";
    echo "<td><b>&nbsp;&nbsp;Package&nbsp;&nbsp;</b></td>";
    echo "<td align=\"center\"><b>&nbsp;&nbsp;Purchased&nbsp;&nbsp;</b></td>";
    echo "<td align=\"center\"><b>&nbsp;&nbsp;Used&nbsp;&nbsp;</b></td>";
    echo "<td align=\"center\"><b>&nbsp;&nbsp;Audit&nbsp;&nbsp;</b></td>";
    echo "</tr>";
    echo "<tr><td colspan=\"4\">Group: " . $myrow["group_name"] . "</td></tr>\n";
    do {
      if ($group_id != $myrow['group_id']) {
	    echo "<tr><td colspan=\"4\">&nbsp;</td></tr>\n";
	    echo "<tr><td colspan=\"4\">Group: " . $myrow["group_name"] . "</td></tr>\n";
	    $bgcolor = "#FFFFFF";
	    $group_id = $myrow['group_id'];
	  } else {}
	  $sql3 = "SELECT SUM(license_purchase_number) AS number_purchased FROM software_licenses WHERE license_software_id = '" . $myrow["software_reg_id"] . "'";
	  $result3 = mysql_query($sql3, $db);
	  $myrow3 = mysql_fetch_array($result3);
	  
      //$sql4 = "SELECT count(software_name) AS number_used FROM software WHERE software_name = '" . addslashes($myrow["software_title"]) . "' AND software_no_detect_date = '1111-11-11' "; 
      $sql4 = "SELECT count(software_name) AS number_used FROM software left outer join group_members on concat('mac-',software.software_uuid) = group_members.group_uuid left outer join software_group_members sgm on sgm.group_software_title = software.software_name left outer join software_group_names sgn on sgn.group_id = sgm.group_id WHERE (software_name = '". addslashes($myrow["software_title"]) . "' or sgn.group_name = '". addslashes($myrow["software_title"]) . "') AND group_names_id = '" . $group_id . "'";
      $result4 = mysql_query($sql4, $db);
	  $myrow4 = mysql_fetch_array($result4);
	  
	  if ($myrow3["number_purchased"] == "") { $number_purchased = 0; } else { $number_purchased = $myrow3["number_purchased"]; }
	  if ($myrow4["number_used"] == "") { $number_used = 0; } else { $number_used = $myrow4["number_used"]; }
	  settype($number_purchased, "integer");
	  settype($number_used, "integer");
	  $number_audit = $number_purchased - $number_used;

      //settype($number_audit, "integer");
	  $font = "<font>";
	  if ($number_audit < "0") { $font = "<font color=\"red\">";}
	  if ($number_audit == "0") { $font = "<font color=\"blue\">";}
	  if ($number_audit > "0") { $font = "<font color=\"green\">";}
	  
      $count = $count + 1;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo "<tr bgcolor=\"" . $bgcolor . "\">";
      echo "<td><a href=\"software_register_details.php?id=" . $myrow["software_reg_id"] . "\">" . $myrow["software_title"] . "</a>&nbsp;&nbsp;</td>";
      //echo "<td align=\"center\">" . $number_purchased . "</td>";
      if ($number_purchased == -1) {
        echo "<td align=\"center\">Free</td>";
      } else {
        echo "<td align=\"center\">" . $number_purchased . "</td>";
      }
      echo "<td align=\"center\">" . $number_used . "</td>";
      //echo "<td align=\"center\">" . $font . $number_audit . "</font></td>";
      if ($number_purchased == -1) {
        echo "<td align=\"center\"></td>";
      } else {
        echo "<td align=\"center\">" . $font . $number_audit . "</font></td>";
      }
      echo "</tr>";
    } while ($myrow = mysql_fetch_array($result));
    echo "</table>";

    } else {
    echo "<p class=\"content\">No Packages in database.</p>"; 
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
</div>
</body>
</html> 