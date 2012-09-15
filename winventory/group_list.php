<?php 
$page = "groups";
$extra = "";

include "include.php"; 
$bgcolor = "#FFFFFF";

echo "<div class=\"main_each\">\n";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\" class=\"content\">";
//echo "<tr><td colspan=\"6\" class=\"contenthead\">List All Groups.</td></tr>";
echo "<tr><td colspan=\"6\" class=\"contenthead\">List All Hardware Groups.</td></tr>";
$SQL = "SELECT * FROM group_names ORDER BY group_name";
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>&nbsp;" . $myrow["group_name"] . "&nbsp;</td>\n";
    //echo "<td><a href=\"group_members_list.php?sub=e1&amp;group=" . $myrow["group_id"] . "\">List Members</a></td>\n";
    //echo "<td><a href=\"group_edit_members.php?sub=e1&amp;group=" . $myrow["group_id"] . "\">Edit Members PCs</a></td>\n";
    //echo "<td><a href=\"group_edit_members_other.php?sub=e1&amp;group=" . $myrow["group_id"] . "\">Edit Members Other</a></td>\n";
    echo "<td><a href=\"group_members_list.php?sub=e1&amp;group=" . $myrow["group_id"] . "\">List</a></td>\n";
    echo "<td><a href=\"group_edit_members.php?sub=e1&amp;group=" . $myrow["group_id"] . "\">Edit</a></td>\n";
    echo "<td><a href=\"group_edit_members_other.php?sub=e1&amp;group=" . $myrow["group_id"] . "\">Edit Other</a></td>\n";
    //echo "<td><a href=\"group_edit_member_software.php?group=" . $myrow["group_id"] . "\">Edit Members Software</a></td>\n";
	echo "<td><a href=\"group_edit.php?sub=e1&amp;group=" . $myrow["group_id"] . "\">Edit Group</a></td>\n";
	echo "<td><a href=\"group_delete.php?sub=e1&amp;group=" . $myrow["group_id"] . "\" onclick=\"Javascript:return confirm('Do you really want to DELETE this group ?');\">Delete Group</a></td>\n";
	echo "</tr>\n";
	if ($myrow["group_desc"] <> "") {
	  echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	  echo "<td colspan=\"6\">&nbsp;&nbsp;" . $myrow["group_desc"] . "</td>\n";
	  echo "</tr>\n";
	} else {}

} while ($myrow = mysql_fetch_array($result));
//} else {}
}

echo "<tr><td colspan=\"6\">&nbsp;</td></tr>";
echo "<tr><td colspan=\"6\" class=\"contenthead\">List All Software Groups.</td></tr>";
$SQL = "SELECT * FROM software_group_names ORDER BY group_name";
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	echo "<td>&nbsp;" . $myrow["group_name"] . "&nbsp;</td>\n";
	echo "<td><a href=\"group_members_list_software.php?sub=e1&amp;group=" . $myrow["group_id"] . "\">List</a></td>\n";
	echo "<td><a href=\"group_edit_member_software.php?sub=e1&amp;group=" . $myrow["group_id"] . "\">Edit</a></td>\n";
	echo "<td>&nbsp;</td>\n";
	echo "<td>&nbsp;</td>\n";
	echo "<td><a href=\"group_delete_software.php?sub=e1&amp;group=" . $myrow["group_id"] . "\" onclick=\"Javascript:return confirm('Do you really want to DELETE this group ?');\">Delete Group</a></td>\n";
	echo "</tr>\n";
	if ($myrow["group_desc"] <> "") {
	  echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	  echo "<td colspan=\"6\">&nbsp;&nbsp;" . $myrow["group_desc"] . "</td>\n";
	  echo "</tr>\n";
	} else {}

} while ($myrow = mysql_fetch_array($result));
}





echo "</table>\n";
echo "</div>\n";
include "include_png_replace.php";
echo "</body>\n";
echo "</html>\n";