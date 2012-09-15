<?php 
$page = "groups";
$extra = "";
$count = 0;
include "include.php";

$title = "";
if (isset($_GET["show_all"])){ $count_system = '10000'; } else {}
if (isset($_GET["page_count"])){ $page_count = $_GET["page_count"]; } else { $page_count = 0;}
$page_prev = $page_count - 1;
if ($page_prev < 0){ $page_prev = 0; } else {}
$page_next = $page_count + 1;
$page_current = $page_count;
$page_count = $page_count * $count_system;

$SQL = "SELECT * from software_group_names WHERE group_id = '" . $_GET["group"] . "'";
$result = mysql_query($SQL, $db);
$myrow = mysql_fetch_array($result);
$title = "Group Members of Software Group " . $myrow["group_name"];
  echo "<div class=\"main_each\">";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
  echo "<tr><td class=\"contenthead\" colspan=\"4\">Group Members of " . $myrow["group_name"] . "</td></tr>\n";
  echo "<tr>\n";
  echo "<td align=\"left\">Software Title</td>\n";
  echo "</tr>\n";
  $SQL2 = "SELECT group_software_title FROM software_group_members WHERE group_id = '" . $_GET["group"] . "' ORDER BY group_software_title";
  $result2 = mysql_query($SQL2, $db);
  if ($myrow2 = mysql_fetch_array($result2)){
  do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	      
      echo "<tr>\n";
      echo "<td align=\"left\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;<a href=\"list_software.php?sub=sw1&amp;name=" . url_clean($myrow2["group_software_title"]) . "\" title=\"Show All Systems with this software\" class=\"content\">" . $myrow2["group_software_title"] . "</a>&nbsp;&nbsp;</td>\n";
      echo "</tr>";
  } while ($myrow2 = mysql_fetch_array($result2));
  echo "<tr><td colspan=\"3\"><b>Total Software Titles: " . mysql_num_rows($result2) . "</b><br />&nbsp;</td></tr>\n";
} else {}

echo "</table>";
echo "</div>\n";
include "include_png_replace.php";
echo "</body>\n";
echo "</html>\n"; 
