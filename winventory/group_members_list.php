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

$SQL = "SELECT * from group_names WHERE group_id = '" . $_GET["group"] . "'";
$result = mysql_query($SQL, $db);
$myrow = mysql_fetch_array($result);
$title = "Group Members of Group " . $myrow["group_name"];
if (isset($_GET['sort'])) {$sort = $_GET['sort'];} else {$sort= "sys.system_name";}
  echo "<div class=\"main_each\">\n";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\" class=\"content\">\n";
  echo "<tr><td class=\"contenthead\" colspan=\"4\">Group Members of " . $myrow["group_name"] . "</td></tr>\n";
  echo "<tr>\n";
  if ($show_mac == "y")          { echo "<td align=\"center\">MAC Address</td>\n"; } else {}
  echo "<td align=\"center\">IP Address</td>\n";
  echo "<td align=\"center\">Name</td>\n";
  if ($show_os == "y")           { echo "<td align=\"center\">OS</a></td>\n"; } else {}
  if ($show_date_audited == "y") { echo "<td align=\"center\">Date Audited</a></td>\n"; } else {}
  if ($show_type == "y")         { echo "<td align=\"center\">&nbsp;System Type&nbsp;</a></td>\n"; } else {}
  if ($show_description == "y")  { echo "<td align=\"center\">&nbsp;System Description&nbsp;</a></td>\n"; } else {}
  if ($show_domain == "y") { echo "<td align=\"center\">&nbsp;Domain&nbsp;</a></td>\n"; } else {}
  if ($sub == "8") { echo "<td align=\"center\">&nbsp;Model&nbsp;</a></td>\n"; } else {}
  if ($sub == "2") { echo "<td align=\"center\">&nbsp;Memory&nbsp;</a></td>\n"; } else {}
  echo "</tr>\n";
  $SQL2 = "SELECT group_uuid FROM group_members WHERE group_names_id = '" . $_GET["group"] . "' AND group_uuid LIKE 'mac-%'";
  $result2 = mysql_query($SQL2, $db);
  if ($myrow2 = mysql_fetch_array($result2)){
  do {
    if(strpos($myrow2["group_uuid"],"mac-") === 0) { $mac = substr($myrow2["group_uuid"], 4); } else { $mac = "000"; }
    $SQL = "SELECT DISTINCT system_uuid, system_os_name, net_ip_address, system_name, system_memory, net_domain, system_description, system_timestamp FROM system WHERE system_uuid = '" . $mac . "'";
    $result = mysql_query($SQL, $db);
    if ($myrow = mysql_fetch_array($result)){
    do {
      $os_name = determine_os($myrow["system_os_name"]);
      //$img = determine_img($myrow["system_os_name"],$myrow["battery_description"]);
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo "<tr>";
      if ($show_mac == "y")          { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;<a href=\"system_summary.php?pc=" . $myrow["net_mac_address"] . "&amp;sub=all\">" . $myrow["net_mac_address"] . "&nbsp;&nbsp;</td>\n"; } else {}
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow["net_ip_address"] . "&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;<a href=\"system_summary.php?pc=" . $myrow["system_uuid"] . "&amp;sub=all\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;</td>\n";
      if ($show_os == "y")           { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $os_name . "&nbsp;&nbsp;</td>\n"; } else {}
      if ($show_date_audited == "y") { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . return_date_time($myrow['system_timestamp']) . "&nbsp;&nbsp;</td>\n"; } else {}
    //  if ($show_type == "y")         { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $img . "&nbsp;&nbsp;</td>\n"; } else {}
      if ($show_description == "y")  { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow["system_description"] . "&nbsp;&nbsp;</td>\n"; } else {}
      if ($show_domain == "y")       { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow["net_domain"] . "&nbsp;&nbsp;</td>\n"; } else {}
      if ($sub == "2")               { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow["system_memory"] . "&nbsp;&nbsp;</td>\n"; } else {}  
      echo "</tr>";
    } while ($myrow = mysql_fetch_array($result));
  } 
  else {
    //echo "<tr><td>No Systems have been added to this group.</td></tr>\n";
  }
  } while ($myrow2 = mysql_fetch_array($result2));
  echo "<tr><td colspan=\"3\"><b>Total Systems: " . mysql_num_rows($result2) . "</b><br />&nbsp;</td></tr>\n";
} else {}




$SQL2 = "SELECT group_uuid FROM group_members WHERE group_names_id = '" . $_GET["group"] . "' AND group_uuid LIKE 'oth-%'";
$result2 = mysql_query($SQL2, $db);
if ($myrow2 = mysql_fetch_array($result2)){
  do {
    if(strpos($myrow2["group_mac"],"oth-") === 0) { $mac = substr($myrow2["group_mac"], 4); } else { $mac = "000"; }
    $SQL = "SELECT * FROM other WHERE other_id = '" . $mac . "'";
    $result = mysql_query($SQL, $db);
    if ($myrow = mysql_fetch_array($result)){
      do {
        if ($bgcolor == "#F1F1F1") {
          $bgcolor = "#FFFFFF"; }
        else { $bgcolor = "#F1F1F1"; }
        echo "<tr>";
        if ($show_mac == "y")          { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;<a href=\"other_summary.php?other=" . $myrow["other_id"] . "&amp;sub=1\">" . $myrow["other_mac_address"] . "&nbsp;&nbsp;</td>\n"; } else {}
        echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow["other_ip"] . "&nbsp;&nbsp;</td>\n";
        echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;<a href=\"other_summary.php?other=" . $myrow["other_id"] . "&amp;sub=all\">" . $myrow["other_name"] . "</a>&nbsp;&nbsp;</td>\n";
        if ($show_os == "y")           { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow["other_type"] . "&nbsp;&nbsp;</td>\n"; } else {}
        if ($show_date_audited == "y") { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;&nbsp;&nbsp;</td>"; } else {}
      //  if ($show_type == "y")         { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;<img src=\"images/other_devices/" . $myrow["other_type"] . ".png\" width=\"22\" height=\"22\" alt=\"" . $myrow["other_type"] . "\" title=\"". $myrow["other_type"] ."\" />&nbsp;&nbsp;</td>\n"; } else {}
        if ($show_description == "y")  { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;&nbsp;&nbsp;</td>\n"; } else {}
        if ($show_domain == "y")       { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;&nbsp;&nbsp;</td>\n"; } else {}
        if ($sub == "2")               { echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;&nbsp;&nbsp;</td>\n"; } else {}  
        echo "</tr>";
      } while ($myrow = mysql_fetch_array($result));
    }
    else {}
  } while ($myrow2 = mysql_fetch_array($result2));
  echo "<tr><td colspan=\"3\"><b>Total Other Items: " . mysql_num_rows($result2) . "</b></td></tr>\n";
} else {}

echo "</table>";
echo "</div>\n";
include "include_png_replace.php";
echo "</body>\n";
echo "</html>\n"; 