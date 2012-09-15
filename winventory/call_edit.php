<?php 
if ($_SERVER['AUTH_USER'] <> NULL){
  $user_explode = explode("\\\\",$_SERVER['AUTH_USER'],2);
  $user_name = $user_explode[1];
} else {
  $user_name = "";
}
$page = "calls";
include "include.php"; 

$sql = "SELECT call_tech_first_name, call_tech_surname FROM call_technician WHERE call_tech_ad_name = '" . $user_name . "'";
$result = mysql_query($sql, $db);
if (!$myrow = mysql_fetch_array($result)) { header("Location: call_home.php"); }
$user_name = $myrow["call_tech_first_name"] . " " . $myrow["call_tech_surname"];

if (isset($_GET["id"])) { $id=$_GET["id"]; } else { header("Location: call_home.php"); }





echo "<div class=\"main_each\">";
echo "<form action=\"call_edit_2.php\" method=\"post\">";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
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
  echo "<tr><td colspan=\"2\" align=\"left\" class=\"contenthead\">Edit call #$id</td></tr>\n";
  echo "<tr><td colspan=\"2\" class=\"contenthead\"><img src=\"images/inv_action_sysinfo" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />&nbsp;&nbsp;" . $myrow["call_short_description"] . "<br />&nbsp;</td></tr>\n";
  echo "<tr><td width=\"200\">Logged By:&nbsp;</td><td width=\"200\">" . $myrow["call_logged_person"] . "</td><td>&nbsp;</td></tr>";
  echo "<tr><td>Date Logged:&nbsp;</td><td>" . $myrow["call_logged_date"] . "</td><td>&nbsp;</td></tr>";
  echo "<tr><td>Customer Priority:&nbsp;</td><td>";
  $SQL2 = "SELECT call_priority_name FROM call_priority WHERE call_priority = '" . $myrow["call_logged_priority"] . "'";
  $result2 = mysql_query($SQL2, $db);
  $myrow2 = mysql_fetch_array($result2);
  echo $myrow2["call_priority_name"] . "</td><td>&nbsp;</td></tr>";
  echo "<tr><td>Internal Priority:&nbsp;</td><td><select size=\"1\" name=\"priority\" class=\"content\" style=\"width:200px;\">\n";
  $SQL2 = "SELECT * FROM call_priority ORDER BY call_priority DESC";
  $result2 = mysql_query($SQL2, $db);
  if ($myrow2 = mysql_fetch_array($result2)){
    do {
      echo "<option value=\"" . $myrow2["call_priority_id"] . "\"";
      if ($myrow["call_priority"] == $myrow2["call_priority"]) {echo " selected>";} else {echo ">";}
      echo $myrow2["call_priority_name"] . "</option>\n";
    } while ($myrow2 = mysql_fetch_array($result2));
  } else {}
  echo "</select></td><td>&nbsp;</td></tr>";
  echo "<tr><td>Call Assigned To:&nbsp;</td><td><select size=\"1\" name=\"technician\" class=\"content\" style=\"width:200px;\">\n";
  $SQL2 = "SELECT * FROM call_technician ORDER BY call_tech_first_name";
  $result2 = mysql_query($SQL2, $db);
  if ($myrow2 = mysql_fetch_array($result2)){
    do {
      echo "<option value=\"" . $myrow2["call_tech_id"] . "\"";
      if ($myrow["call_assigned_person"] == $myrow2["call_tech_id"]) {echo " selected>";} else {echo ">";}
      echo $myrow2["call_tech_first_name"] . " " . $myrow2["call_tech_surname"] . "</option>\n";
    } while ($myrow2 = mysql_fetch_array($result2));
  } else {}
  echo "</select></td><td>&nbsp;</td></tr>";
  echo "<tr><td>Very short description:&nbsp;</td><td><input style=\"width:200px;\" type=\"text\" name=\"short_desc\" size=\"30\" value=\"" . $myrow["call_short_description"] . "\" class=\"content\" /></td><td>&nbsp;</td></tr>";
  echo "<tr><td>Details Supplied:&nbsp;</td><td>" . $myrow["call_detailed_description"] . "</td><td>&nbsp;</td></tr>";
  echo "<tr><td></td><td></td><td>&nbsp;</td></tr>";
  $SQL2 = "SELECT * FROM call_comment WHERE call_id = '" . $myrow["call_id"] . "' ORDER BY call_comment_timestamp";
  $result2 = mysql_query($SQL2, $db);
  if ($myrow2 = mysql_fetch_array($result2)){
    do {
      echo "<tr><td>Comment By:&nbsp;</td><td>" . $myrow2["call_comment_by"] . "</td><td>&nbsp;</td></tr>";
      echo "<tr><td>Comment Time:&nbsp;</td><td>" . $myrow2["call_comment_timestamp"] . "</td><td>&nbsp;</td></tr>";
      echo "<tr><td>Comment:&nbsp;</td><td>" . $myrow2["call_comment"] . "</td><td>&nbsp;</td></tr>";
      echo "<tr><td></td><td></td><td>&nbsp;</td></tr>";
    } while ($myrow2 = mysql_fetch_array($result2));
  } else {}
  echo "<tr><td valign=\"top\">Add Comment:</td>";
  echo "<td><textarea rows=\"3\" name=\"comment\" cols=\"40\" class=\"content\"></textarea></td></tr>";
  echo "<tr><td>User:&nbsp;</td><td>" . $user_name . "</td></tr>";
  
  echo "<tr><td><input type=\"submit\" name=\"submit\" value=\"Submit\" /></td></tr>";
}
echo "</table>";
echo "</form>";
echo "</div>";
echo "</body>";
echo "</html>";
include "include_png_replace.php";
?>