<?php 
$page = "";
$extra = "";
include "include.php";

if (isset($_GET["sub"])){ $sub = $_GET["sub"]; } else { $sub = "sw0";}
if (isset($_GET["show_all"])){ $count_system = '10000'; } else {}
if (isset($_GET["page_count"])){ $page_count = $_GET["page_count"]; } else { $page_count = 0;}
$page_prev = $page_count - 1;
if ($page_prev < 0){ $page_prev = 0; } else {}
$page_next = $page_count + 1;
$page_current = $page_count;
$page_count = $page_count * $count_system;

if ($sub == "sw0"){
  $SQL = "SELECT count(ss_qno), ss_name, ss_qno from system_security WHERE (ss_status = 'NOT FOUND' OR ss_status = 'Warning') group by ss_qno ORDER BY ss_qno LIMIT " . $page_count . "," . $count_system;
  echo "<div class=\"main_each\">\n";
  echo "<table width=\"700\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\">";
  echo "<tr><td align=\"left\" class=\"contenthead\" colspan=\"3\">List All Missing Patches<br />&nbsp;</td>";
  if ($count_system <> "10000"){
    echo "<td align=\"center\">";
    echo "<a href=\"list_missing_patches.php?sub=" . $sub . "&page_count=" . $page_prev . "\" class=\"content\"><img src=\"images/button_back.png\" border=0 alt=\"Previous " . $count_system . " Systems\" title=\"Previous " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;"; 
    echo "<a href=\"list_missing_patches.php?sub=" . $sub . "&page_count=0&show_all=1\" class=\"content\"><img src=\"images/button_all.png\" border=0 alt=\"All Systems\" title=\"All Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;"; 
    echo "<a href=\"list_missing_patches.php?sub=" . $sub . "&page_count=" . $page_next . "\" class=\"content\"><img src=\"images/button_forward.png\" border=0 alt=\"Next " . $count_system . " Systems\" title=\"Next " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a><br />&nbsp;";
	echo "</td>";
  } else {
    echo "<td></td>";
  }
  echo "</tr>";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<tr>";
	echo "<td align=\"center\" width=\"100\"><b>Count</b></td>";
	echo "<td width=\"100\"><b>Q Number</b></td>";
	echo "<td align=\"center\" width=\"150\"><b>KB Article</b></td></tr>";
    do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo "<tr bgcolor=\"" . $bgcolor . "\">";
      echo "<td align=\"center\"><a href=\"list_missing_patches.php?sub=sw1&name=" . url_clean($myrow["ss_qno"]) . "\" alt=\"Show All Systems with this software\" title=\"Show All Systems with this software\" class=\"content\">" . $myrow["count(ss_qno)"] . "</a></td>";
      echo "<td><a href=\"list_missing_patches.php?sub=sw2&name=" . url_clean($myrow["ss_qno"]) . "\" alt=\"Show Patch Details\" title=\"Show Patch Details\" class=\"content\">" . $myrow["ss_qno"] . "</a></td>";
      echo "<td align=\"center\"><a href=\"http://www.google.com/search?num=30&hl=en&lr=lang_en&ie=UTF-8&oe=UTF-8&safe=off&q=%22" . $myrow["ss_qno"] . "%22&btnG=Search\"><img border=0 alt=\"Google Search\" title=\"Google Search\" src=\"images\button_kb.gif\"></a></td>";
      echo "</tr>";
    } while ($myrow = mysql_fetch_array($result));
  echo "<tr><td colspan=3><br />&nbsp;</td>";
  } else {
    echo "No Missing Patches.";
  }
  if ($count_system <> "10000"){
    echo "<td align=\"center\"><br />";
    echo "<a href=\"list_missing_patches.php?sub=" . $sub . "&page_count=" . $page_prev . "\"><img src=\"images/button_back.png\" border=0 alt=\"Previous " . $count_system . " Systems\" title=\"Previous " . $count_system . " Systems\" width=\"18\" height=\"18\" /></a>&nbsp;&nbsp;&nbsp;"; 
    echo "<a href=\"list_missing_patches.php?sub=" . $sub . "&page_count=0&show_all=1\"><img src=\"images/button_all.png\" border=0 alt=\"All Systems\" title=\"All Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;"; 
    echo "<a href=\"list_missing_patches.php?sub=" . $sub . "&page_count=" . $page_next . "\"><img src=\"images/button_forward.png\" border=0 alt=\"Next " . $count_system . " Systems\" title=\"Next " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a>";
	echo "</td>";
  } else {
    echo "<td></td>";
  }
  echo "</tr>";
  echo "</table>";
} else {}



if ($sub == "sw1"){
  $SQL = "select sys.net_mac_address,sys.system_description,sys.net_ip_address,sys.system_name,sw.ss_name from system_security sw, system sys where sw.ss_qno = '" . $_GET["name"] . "' and sw.ss_name = sys.system_name ORDER BY sys.system_name";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<div class=\"main_each\">\n";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\">";
    echo "<tr><td class=\"contenthead\" colspan=\"3\">List Systems with <i>\"" . $_GET["name"] . "\"</i> not installed.</td></tr>";
    echo "<tr>";
	echo "<td width=\"100\">&nbsp;&nbsp;<b>IP Address</b></td>";
	echo "<td width=\"100\">&nbsp;&nbsp;<b>Name</b></td>";
	echo "<td width=\"450\">&nbsp;&nbsp;<b>Description</b></td></tr>";
    do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo "<tr bgcolor=\"" . $bgcolor . "\">";
      echo "<td>&nbsp;&nbsp;" . $myrow["net_ip_address"] . "&nbsp;&nbsp;</td><td>&nbsp;&nbsp;<a href=\"system_summary.php?pc=" . $myrow["net_mac_address"] . "\" class=\"content\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;" . $myrow["system_description"] . "</td>";
      echo "</tr>";
    } while ($myrow = mysql_fetch_array($result));
  } else {
    echo "No Systems have this software installed.";
  }
} else {}

if ($sub == "sw2"){
  $SQL = "SELECT * FROM system_security_bulletins WHERE ssb_qno = '" . $_GET['name'] . "'";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<div class=\"main_each\">\n";
    echo "<table width=\"700\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\">";
    echo "<tr><td class=\"contenthead\" colspan=\"3\">List Patch Details for <i>\"" . $_GET["name"] . "\"</i>.</td></tr>";
    do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo "<tr><td>Q Number: " . $myrow["ssb_qno"] . "</td></tr>";
      echo "<tr><td>Bulletin Number: " . $myrow['ssb_bulletin'] . "</td></tr>";
	  echo "<tr><td>Microsoft Technet URL: <a href=\"" . $myrow['ssb_url'] . "\">Link</a></td></tr>";
	  echo "<tr><td>Title: " . $myrow['ssb_title'] . "</td></tr>";
	  echo "<tr><td><br />Description: " . $myrow['ssb_description'] . "</td></tr>";
    } while ($myrow = mysql_fetch_array($result));
  } else {
    echo "No details are available.";
  }
} else {}

?>

</p>
</div>
<?php
include "include_png_replace.php";
?>
</body>
</html> 