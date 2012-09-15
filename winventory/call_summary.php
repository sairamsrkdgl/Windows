<?php 

if (isset($_GET["id"])) { $id=$_GET["id"]; } else { header("Location: call_home.php"); }

$page = "call";
include "include.php"; 

echo "<div class=\"main_each\">";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\" class=\"content\">";

$sql = "SELECT * from call WHERE call_id = '$id'";
$result = mysql_query($sql, $db);
if ($myrow = mysql_fetch_array($result)){
  $sql2 = "SELECT * FROM call_priority WHERE call_priority = '" . $myrow["call_logged_priority"] . "'";
  $result2 = mysql_query($sql2, $db);
  $myrow2 = mysql_fetch_array($result2);
  $call_priority = $myrow2["call_priority_name"];
  $sql2 = "SELECT * FROM call_status WHERE call_status_id = '" . $myrow["call_status"] . "'";
  $result2 = mysql_query($sql2, $db);
  $myrow2 = mysql_fetch_array($result2);
  $call_status = $myrow2["call_status_name"];
  echo "<tr><td colspan=\"2\" align=\"left\" class=\"contenthead\">Call Summary for call #$id</td></tr>\n";
  echo "<tr><td colspan=\"2\" class=\"contenthead\"><img src=\"images/inv_action_sysinfo" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />&nbsp;&nbsp;" . $myrow["call_short_description"] . "</td></tr>\n";
  echo "<tr><td>Call Status:&nbsp;</td><td>$call_status</td></tr>";
  echo "<tr><td>Call Logged Date:&nbsp;</td><td>" . $myrow["call_logged_date"] . "</td></tr>";
  echo "<tr><td>Call Logged By:&nbsp;</td><td>" . $myrow["call_logged_person"] . "</td></tr>";
  echo "<tr><td>Call Logged Priority:&nbsp;</td><td>$call_priority</td></tr>";
  echo "<tr><td>Call Assigned To:&nbsp;</td><td>" . $myrow["call_assigned_person"] . "</td></tr>";
  echo "<tr><td valign=\"top\">Call Logged Description:&nbsp;</td><td>" . nl2br($myrow["call_detailed_description"]) . "</td></tr>";
}



echo "<tr><td><a href=\"call_edit.php?id=" .  $id . "\">Edit</a></td></tr>";
?>

</table>
</div>
</body>
</html> 
<?php
include "include_png_replace.php";
?>