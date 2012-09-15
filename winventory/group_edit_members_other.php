<?php 
$page = "groups";
$extra = "";
$software = "";
$count = "0";
$SQL2 = "";

if (isset($_GET['software'])) {$software = $_GET['software'];} else {}
if (isset($_GET['sort'])) {$sort = $_GET['sort'];} else {$sort= "other_name";}
include "include.php";

if (count($_POST)>0) {
  $response = $_POST;
  $SQL = "DELETE FROM group_members WHERE group_mac LIKE 'oth-%' AND group_names_id = '" . $_POST["group"] . "'";
  $result = mysql_query($SQL, $db);
  foreach ($response as $key => $val) {
    if(strpos($key,"oth-") === 0) {
      $mac = $key;
      $SQL = "INSERT INTO group_members (group_mac, group_names_id) VALUES ('" . $mac . "', '" . $_POST["group"] . "')";
      $result = mysql_query($SQL, $db);
    } else {}
     header("Location: group_list.php?pc=");
    }
  } else {

  $SQL = "SELECT * from group_names WHERE group_id = '" . $_GET["group"] . "'";
  $result = mysql_query($SQL, $db);
  $myrow = mysql_fetch_array($result);
  echo "<div class=\"main_each\">\n";
  echo "<form method=\"post\" action=\"" . $_SERVER["PHP_SELF"] . "\" name=\"edit_group_members\">";
  echo "<input type=\"hidden\" name=\"group\" value=\"" . $_GET["group"] . "\" />";
  echo "<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" width=\"700\" class=\"content\">";
  echo "<tr><td colspan=\"4\" class=\"contenthead\">Edit PCs in group " . $myrow["group_name"] . ".</td></tr>";
  $SQL = "SELECT * FROM other ORDER BY " . $sort;
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<tr>";
    echo "<td align=\"center\"><a href=\"group_edit_members_other.php?sub=e1&amp;sort=other_ip&amp;group=" . $_GET["group"] . "\">IP Address</a></td>";
    echo "<td align=\"center\"><a href=\"group_edit_members_other.php?sub=e1&amp;sort=other_type&amp;group=" . $_GET["group"] . "\">Type</a></td>";
    echo "<td align=\"center\"><a href=\"group_edit_members_other.php?sub=e1&amp;sort=other_name&amp;group=" . $_GET["group"] . "\">Name</a></td>";
    echo "<td align=\"center\"><a href=\".\">In Group</a></td>";
    echo "</tr>";
    do {
	  $sql2 = "SELECT count(*) AS count FROM group_members WHERE group_mac = 'oth-" . $myrow["other_id"] . "' AND group_names_id = '" . $_GET["group"] . "'";
      $result2 = mysql_query($sql2, $db);
      $myrow2 = mysql_fetch_array($result2);
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo "<tr>";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow["other_ip"] . "&nbsp;&nbsp;</td>";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow["other_type"] . "&nbsp;&nbsp;</td>";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow["other_name"] . "&nbsp;&nbsp;</td>";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;<input type=\"checkbox\" name=\"oth-" . $myrow["other_id"] . "\" value=\"y\" ";
	  if ($myrow2["count"] == "1"){ echo "checked=\"checked\"";} 
	  echo " />&nbsp;&nbsp;</td></tr>";

    } while ($myrow = mysql_fetch_array($result));
	echo "<tr><td><input type=\"submit\" value=\"Submit\" name=\"submit_button\" /></td></tr>";
	echo "</table>";
  } 
  else {
    echo "No other items have been added to this group.";
    echo "</table>";
  }

}
echo "</form>";
echo "</div>";
include "include_png_replace.php";
echo "</body>";
echo "</html>"; 