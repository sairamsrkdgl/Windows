<?php 
$page = "groups";
$extra = "";
$software = "";
$count = "0";
$SQL2 = "";

if (isset($_GET['software'])) {$software = $_GET['software'];} else {}
if (isset($_GET['sort'])) {$sort = $_GET['sort'];} else {$sort= "net_ip_address";}
include "include.php";

if (count($_POST)>0) {
$response = $_POST;
$SQL = "DELETE FROM software_group_members WHERE group_id = '" . $_POST["group"] . "'";
$result = mysql_query($SQL, $db);
foreach ($response as $key => $val)
        {
		if(strpos($key,"soft-") === 0) {
		$title = base64_decode(substr($key, 5));
		$SQL = "INSERT INTO software_group_members (group_software_title, group_id) VALUES ('" . $title . "', '" . $_POST["group"] . "')";
		$result = mysql_query($SQL, $db);
		} else {}
                header("Location: group_list.php?pc=");
        }
} else {

  $SQL = "SELECT * from software_group_names WHERE group_id = '" . $_GET["group"] . "'";
  $result = mysql_query($SQL, $db);
  $myrow = mysql_fetch_array($result);
  $group_name = $myrow["group_name"];

  $SQL = "select distinct sw.software_name, sgm.group_id from software sw left outer join software_group_members sgm on sgm.group_software_title = sw.software_name order by sw.software_name";
  //select * from software_group_names sgn left join software_group_members sgm on sgn.group_id = sgm.group_id where sgn.group_id = '" . $_GET["group"] . "' order by sgm.group_software_title";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<div class=\"main_each\">\n";
    echo "<form method=\"post\" action=\"" . $_SERVER["PHP_SELF"] . "\" name=\"edit_group_members\">\n";
	echo "<input type=\"hidden\" name=\"group\" value=\"" . $_GET["group"] . "\" />\n";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr><td colspan=\"2\" class=\"contenthead\">Edit Software in group " . $group_name . ".</td></tr>\n";
    echo "<tr>\n";
    echo "<td class=\"contenthead\">Software Title</td>\n";
    echo "<td align=\"center\" class=\"contenthead\">In Group</td>\n";
    echo "</tr>\n";
    do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }

      echo "<tr>";
      echo "<td align=\"left\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow['software_name'] . "&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;<input type=\"checkbox\" name=\"soft-" . base64_encode($myrow["software_name"]) . "\" value=\"y\" ";
	  if ($myrow["group_id"] == $_GET["group"])
	  { 
	    echo "checked=\"checked\" ";
	  }
	  elseif ($myrow["group_id"] != null)
	  {
	    echo "disabled ";
	  }
	  echo "/>&nbsp;&nbsp;</td>\n";

    } while ($myrow = mysql_fetch_array($result));
	echo "<tr><td><input type=\"submit\" value=\"Submit\" name=\"submit_button\" /></td></tr>\n";
	echo "</table>\n";
	echo "</form>\n";
  } 
  else {
    echo "<tr><td>No Software has been found.</td></tr>";
    echo "</table>\n";
  }

}
?>
</div>
<?php
include "include_png_replace.php";
?>
</body>
</html> 
