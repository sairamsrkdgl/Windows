<?php 
$page = "us";
include "include.php"; 
$bgcolor = "#FFFFFF";

echo "<div class=\"main_each\">";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">";
echo "<tr>";
echo "<td align=\"left\" class=\"contenthead\">Users &amp; Groups for " . $name . "<br />&nbsp;</td>";
echo "</tr>";
echo "</table>";

if (($sub == "us") or ($sub == "all")){
  $SQL = "SELECT * FROM users WHERE users_uuid = '$pc' AND users_timestamp = '$timestamp' ORDER BY users_name";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    ?>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="content">
    <tr><td class="contenthead"><img src="images/inv_user<?php echo $pic_style; ?>.png" width="64" height="64" alt="" />Users</td></tr>
    <?php
    do {
      $SQL2 = "SELECT * FROM users_detail WHERE ud_name = '" . $myrow["users_name"] . "'";
      $result2 = mysql_query($SQL2, $db);
      $myrow2 = mysql_fetch_array($result2);
      echo "<tr bgcolor=\"" . $bgcolor . "\"><td>User Name:&nbsp;</td><td>" . $myrow["users_name"] . "</td></tr>";
      echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Full Name:&nbsp;</td><td>" . $myrow["users_full_name"] . "</td></tr>";
      echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Disabled:&nbsp;</td><td>" . $myrow["users_disabled"] . "</td></tr>";
      echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Password Changeable:&nbsp;</td><td>" . $myrow["users_password_changeable"] . "</td></tr>";
      echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Password Required:&nbsp;</td><td>" . $myrow["users_password_required"] . "</td></tr>";
      echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Description:&nbsp;</td><td>" . $myrow2["ud_description"] . "</td></tr>";
      echo "<tr bgcolor=\"" . $bgcolor . "\"><td colspan=\"2\"><br /></td></tr>";
  	  if ($bgcolor == "#F1F1F1") {
	    $bgcolor = "#FFFFFF"; }
	  else { $bgcolor = "#F1F1F1"; }
    } while ($myrow = mysql_fetch_array($result));
    echo "</table>";
  } else {
    echo "<p class=\"menuhead\">&nbsp;&nbsp;No Local Users (Domain Only).</p>"; 
  }
} else {}

echo "<br /><br />";

if (($sub == "gr") or ($sub == "all")){
  $SQL = "SELECT * FROM groups WHERE groups_uuid = '$pc' AND groups_timestamp = '$timestamp' ORDER BY groups_name";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    ?>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="content">
    <tr><td class="contenthead" colspan="2"><img src="images/inv_group<?php echo $pic_style; ?>.png" width="64" height="64" alt="" />Groups&nbsp;&nbsp;</td></tr>
    <?php
    do {
      $SQL2 = "SELECT * FROM groups_details WHERE gd_name = '" . $myrow["groups_name"] . "'";
      $result2 = mysql_query($SQL2, $db);
      $myrow2 = mysql_fetch_array($result2);
      echo "<tr bgcolor=\"" . $bgcolor . "\"><td width=\"150\">Group Name:&nbsp;</td><td>" . $myrow["groups_name"] . "</td></tr>";
      echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Members:&nbsp;</td><td>" . $myrow["groups_members"] . "</td></tr>";
      echo "<tr bgcolor=\"" . $bgcolor . "\"><td valign=\"top\">Description:&nbsp;</td><td>" . $myrow2["gd_description"] . "</td></tr>";
      echo "<tr bgcolor=\"" . $bgcolor . "\"><td colspan=\"2\"><br /></td></tr>";
  	  if ($bgcolor == "#F1F1F1") {
	    $bgcolor = "#FFFFFF"; }
	  else { $bgcolor = "#F1F1F1"; }
    } while ($myrow = mysql_fetch_array($result));
    echo "</table>";
  } else {
    echo "<p class=\"section_header_3\">No Local Groups (Domain Only).</p>"; 
  }
} else {}
?>

</div>
</body>
</html> 
<?php
include "include_png_replace.php";
?>