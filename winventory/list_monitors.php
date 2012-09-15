<?php 
$page = "other";
$extra = "";
include "include.php";

if (isset($_GET["show_all"])){ $count_system = '10000'; } else {}
if (isset($_GET["page_count"])){ $page_count = $_GET["page_count"]; } else { $page_count = 0;}
$page_prev = $page_count - 1;
if ($page_prev < 0){ $page_prev = 0; } else {}
$page_next = $page_count + 1;
$page_current = $page_count;
$page_count = $page_count * $count_system;

if ($sub <> "sw1"){
  $SQL = "SELECT MAX(mon.monitor_timestamp), mon.monitor_uuid, mon.monitor_model, mon.monitor_manufacturer, mon.monitor_serial, sys.system_name, sys.system_uuid FROM monitor mon, system sys WHERE mon.monitor_uuid = sys.system_uuid group by mon.monitor_uuid order by sys.system_name LIMIT " . $page_count . "," . $count_system;
  echo "<div class=\"main_each\">";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
  echo "<tr><td align=\"left\" class=\"contenthead\">List All Monitors<br />&nbsp;</td>\n";
  if ($count_system <> "10000"){
    echo "<td align=\"right\">\n";
    echo "<a href=\"list_monitors.php?sub=" . $sub . "&amp;page_count=" . $page_prev . "\" class=\"content\"><img src=\"" . $but_bac . "\" border=0 alt=\"Previous " . $count_system . " Systems\" title=\"Previous " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
    echo "<a href=\"list_monitors.php?sub=" . $sub . "&amp;page_count=0&amp;show_all=1\" class=\"content\"><img src=\"" . $but_all . "\" border=0 alt=\"All Systems\" title=\"All Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
    echo "<a href=\"list_monitors.php?sub=" . $sub . "&amp;page_count=" . $page_next . "\" class=\"content\"><img src=\"" . $but_for . "\" border=0 alt=\"Next " . $count_system . " Systems\" title=\"Next " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a>&nbsp;<br />&nbsp;</td>\n";
	echo "</td>\n";
  } else {}
  echo "</tr></table>\n";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<tr>";
	echo "<td><b>System</b></td>\n";
	echo "<td><b>Manufacturer</b></td>\n";
	echo "<td><b>Model</b></td>\n";
	echo "<td><b>Serial</b></td></tr>\n";
    do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
      echo "<td><a href=\"system_summary.php?pc=" . url_clean($myrow["system_uuid"]) . "\" title=\"\">" . $myrow["system_name"] . "</a></td>\n";
      echo "<td>" . $myrow["monitor_manufacturer"] . "</td>\n";
      echo "<td>" . $myrow["monitor_model"] . "</td>\n";
      echo "<td>" . $myrow["monitor_serial"] . "</td>\n";
      echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
  $num_rows = mysql_num_rows($result);
  echo "<tr><td colspan=3><br /><b>Total Monitors: " . $num_rows . "</b></td>\n";
  } else {
    echo "<tr><td><br />No Monitors in database.</td></tr>";
  }
  echo "</table>";
  if ($count_system <> "10000"){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
    echo "<td align=\"right\"><br />\n";
    echo "<a href=\"list_monitors.php?sub=" . $sub . "&amp;page_count=" . $page_prev . "\"><img src=\"" . $but_bac . "\" border=0 alt=\"Previous " . $count_system . " Systems\" title=\"Previous " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
    echo "<a href=\"list_monitors.php?sub=" . $sub . "&amp;page_count=0&amp;show_all=1\"><img src=\"" . $but_all . "\" border=0 alt=\"All Systems\" title=\"All Systems\" width=\"16\" height=\"16\" /></a>&nbsp;&nbsp;&nbsp;\n"; 
    echo "<a href=\"list_monitors.php?sub=" . $sub . "&amp;page_count=" . $page_next . "\"><img src=\"" . $but_for . "\" border=0 alt=\"Next " . $count_system . " Systems\" title=\"Next " . $count_system . " Systems\" width=\"16\" height=\"16\" /></a>&nbsp;\n";
	echo "</td>\n";
  } else {
    echo "<td></td>\n";
  }
  echo "</tr>\n";
  echo "</table>\n";
} else {}



if ($sub == "sw1"){
  $SQL = "select sys.net_mac_address,sys.system_description,sys.net_ip_address,sys.system_name,bho.bho_program_file from browser_helper_objects bho, system sys where bho.bho_program_file = '" . $_GET["name"] . "' and bho.bho_mac_address = sys.net_mac_address ORDER BY sys.system_name";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<div class=\"main_each\">";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
    echo "<tr><td class=\"contenthead\" colspan=\"3\">List Systems with <i>\"" . $_GET["name"] . "\"</i> installed.<br />&nbsp;</td></tr>\n";
    echo "<tr>";
	echo "<td width=\"100\">&nbsp;&nbsp;<b>IP Address</b></td>\n";
	echo "<td width=\"100\">&nbsp;&nbsp;<b>Name</b></td>\n";
	echo "<td width=\"450\">&nbsp;&nbsp;<b>Description</b></td></tr>\n";
    do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
      echo "<td>&nbsp;&nbsp;" . ip_trans($myrow["net_ip_address"]) . "&nbsp;&nbsp;</td>\n";
	  echo "<td>&nbsp;&nbsp;<a href=\"system_summary.php?pc=" . $myrow["net_mac_address"] . "\" class=\"content\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;</td>\n";
	  echo "<td>&nbsp;&nbsp;" . $myrow["system_description"] . "</td>\n";
      echo "</tr>\n";
    } while ($myrow = mysql_fetch_array($result));
  } else {
    echo "No Systems have this software installed.";
  }
} else {}



?>

</div>
<?php
include "include_png_replace.php";
?>
</body>
</html> 