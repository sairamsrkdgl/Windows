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
$SQL = "DELETE FROM group_members WHERE group_uuid LIKE 'mac-%' AND group_names_id = '" . $_POST["group"] . "'";
$result = mysql_query($SQL, $db);
foreach ($response as $key => $val)
        {
		if(strpos($key,"mac-") === 0) {
		$mac = $key;
		$SQL = "INSERT INTO group_members (group_uuid, group_names_id) VALUES ('" . $mac . "', '" . $_POST["group"] . "')";
		$result = mysql_query($SQL, $db);
		} else {}
                header("Location: group_list.php?pc=");
        }
} else {



  $SQL = "SELECT * from group_names WHERE group_id = '" . $_GET["group"] . "'";
  $result = mysql_query($SQL, $db);
  $myrow = mysql_fetch_array($result);
  $group_name = $myrow["group_name"];
  // $SQL = "SELECT * FROM system ORDER BY " . $sort;
  $SQL = "select * from system left outer join group_members on group_uuid = concat('mac-',system_uuid) order by " . $sort;
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<div class=\"main_each\">\n";
    echo "<form method=\"post\" action=\"" . $_SERVER["PHP_SELF"] . "\" name=\"edit_group_members\">\n";
	echo "<input type=\"hidden\" name=\"group\" value=\"" . $_GET["group"] . "\" />\n";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\" class=\"content\">\n";
    echo "<tr><td colspan=\"4\" class=\"contenthead\">Edit PCs in group " . $group_name . ".</td></tr>\n";
    echo "<tr>\n";
    echo "<td align=\"center\"><a href=\"group_edit_members.php?sub=e1&amp;sort=net_ip_address&amp;group=" . $_GET["group"] . "\">IP Address</a></td>\n";
    echo "<td align=\"center\"><a href=\"group_edit_members.php?sub=e1&amp;sort=system_name&amp;group=" . $_GET["group"] . "\">Name</a></td>\n";
    echo "<td align=\"center\"><a href=\"group_edit_members.php?sub=e1&amp;sort=system_os_name&amp;group=" . $_GET["group"] . "\">OS</a></td>\n";
    echo "<td align=\"center\"><a href=\"group_edit_members.php?sub=e1&amp;sort=date_audited&amp;group=" . $_GET["group"] . "\">Date Audited</a></td>\n";
    //echo "<td align=\"center\"><a href=\"group_edit_members.php?sub=e1&amp;sort=system_os_name&amp;group=" . $_GET["group"] . "\">&nbsp;System Type&nbsp;</a></td>\n";
    echo "<td align=\"center\"><a href=\"group_edit_members.php?sub=e1&amp;sort=net_domain&amp;group=" . $_GET["group"] . "\">&nbsp;Domain&nbsp;</a></td>\n";
    echo "<td align=\"center\"><a href=\".\">In Group</a></td>\n";
    echo "</tr>\n";
    do {
      $sql2 = "SELECT count(*) AS count FROM group_members WHERE group_uuid = 'mac-" . $myrow["system_uuid"] . "' AND group_names_id = '" . $_GET["group"] . "'";
      $result2 = mysql_query($sql2, $db);
      $myrow2 = mysql_fetch_array($result2);
      $os_name = determine_os($myrow["system_os_name"]);
      //$img = determine_img($myrow["system_os_name"],$myrow["battery_description"]);

      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }

      echo "<tr>";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow["net_ip_address"] . "&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;<a href=\"system_summary.php?pc=" . $myrow["system_uuid"] . "&amp;sub=all\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $os_name . "&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . return_date_time($myrow['system_timestamp']) . "&nbsp;&nbsp;</td>\n";
      //echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $img . "&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow['net_domain'] . "&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;<input type=\"checkbox\" name=\"mac-" . $myrow["system_uuid"] . "\" value=\"y\" ";
	  //if ($myrow2["count"] == "1"){ echo "checked=\"checked\" ";} 
      if ($myrow["group_names_id"] == $_GET["group"]){ 
	    echo "checked=\"checked\" ";
	  } elseif ($myrow["group_names_id"] != null) {
	      echo "disabled ";
	  }
	  echo "/>&nbsp;&nbsp;</td>\n";

    } while ($myrow = mysql_fetch_array($result));
	echo "<tr><td><input type=\"submit\" value=\"Submit\" name=\"submit_button\" /></td></tr>\n";
	echo "</table>\n";
	echo "</form>\n";
  } 
  else {
    echo "<tr><td>No PCs have been audited.</td></tr>";
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