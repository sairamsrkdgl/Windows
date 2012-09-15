<?php 
$page = "software";
include "include.php"; 

echo "<div class=\"main_each\">";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
echo "<tr>\n";
echo "<td align=\"left\" class=\"contenthead\">Currently installed Software for " . $name . "<br />&nbsp;</td>\n";
echo "</tr>\n";
echo "</table>\n";

if (($sub == "is") or ($sub == "all")){
  $SQL = "SELECT * FROM software WHERE software_uuid = '$pc' AND software_timestamp = '$timestamp' AND software_name NOT LIKE '%codec%' AND software_name NOT LIKE '%hotfix%' AND software_name NOT LIKE '%update%' AND software_name NOT LIKE '%Service Pack%' AND software_system_component <> '1' ORDER BY software_name";
  $result = mysql_query($SQL, $db);
  if (($myrow = mysql_fetch_array($result))){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
	echo "<tr><td class=\"menuhead\"><img src=\"images/inv_software" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />Installed Software</td></tr>\n";
	$bgcolor = "#F1F1F1";
	echo "<tr><td>Application Name</td><td>Version</td><td>Publisher</td><td align=\"center\">Google</td></tr>\n";
	do {
	  echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	  echo "<td><a href=\"list_software.php?sub=sw1&amp;name=" . url_clean($myrow["software_name"]) . "\">" . $myrow["software_name"] . "</a></td>\n";
      echo "<td>" . $myrow["software_version"] . "</td>\n";
      echo "<td>";
      if ($myrow["software_url"]) {
        echo "<a href=\"" . $myrow["software_url"] . "\">" . $myrow["software_publisher"] . "</a></td>\n"; 
      } else {
        echo $myrow["software_publisher"] . "</td>\n";
      } 
      echo "<td align=\"center\"><a href=\"http://www.google.com/search?num=30&amp;hl=en&amp;lr=lang_en&amp;ie=UTF-8&amp;oe=UTF-8&amp;safe=off&amp;q=%22" . url_clean($myrow["software_name"]) . "%22&amp;btnG=Search\"><img border=\"0\" alt=\"Google Search\" title=\"Google Search\" src=\"images/button_google.gif\" width=\"16\" height=\"16\" /></a></td>\n";
	  echo "</tr>";
	  if ($bgcolor == "#F1F1F1") {
		$bgcolor = "#FFFFFF"; }
	  else { $bgcolor = "#F1F1F1"; }
	} while ($myrow = mysql_fetch_array($result));
	echo "</table>";
  } else {echo "<p class=\"menuhead\"><img src=\"images/inv_software" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />&nbsp;No Software installed.</p>"; }
  
  
  $SQL = "SELECT * FROM software WHERE software_uuid = '$pc' AND software_timestamp = '$timestamp' AND software_name NOT LIKE '%hotfix%' AND software_system_component <> '' ORDER BY software_name";
  $result = mysql_query($SQL, $db);
  if (($myrow = mysql_fetch_array($result))){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
	echo "<tr><td class=\"menuhead\"><br /><img src=\"images/inv_software" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />Installed System Components</td></tr>\n";
	$bgcolor = "#F1F1F1";
	echo "<tr><td>Application Name</td><td>Version</td><td>Publisher</td><td align=\"center\">Google</td></tr>\n";
	do {
	  echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	  echo "<td><a href=\"list_software.php?sub=sw1&amp;name=" . url_clean($myrow["software_name"]) . "\">" . $myrow["software_name"] . "</a></td>\n";
      echo "<td>" . $myrow["software_version"] . "</td>\n";
      echo "<td>" . $myrow["software_publisher"] . "</td>\n";
      echo "<td align=\"center\"><a href=\"http://www.google.com/search?num=30&amp;hl=en&amp;lr=lang_en&amp;ie=UTF-8&amp;oe=UTF-8&amp;safe=off&amp;q=%22" . url_clean($myrow["software_name"]) . "%22&amp;btnG=Search\"><img border=\"0\" alt=\"Google Search\" title=\"Google Search\" src=\"images/button_google.gif\" width=\"16\" height=\"16\" /></a></td>\n";
	  echo "</tr>";
	  if ($bgcolor == "#F1F1F1") {
		$bgcolor = "#FFFFFF"; }
	  else { $bgcolor = "#F1F1F1"; }
	} while ($myrow = mysql_fetch_array($result));
	echo "</table>";
  } else {echo "<p class=\"menuhead\"><img src=\"images/inv_software" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />&nbsp;No System Components installed.</p>"; }
} else {}

if (($sub == "ph") or ($sub == "all")){
  $opt_count = 0;
  //$SQL = "SELECT * FROM hotfix WHERE hotfix_uuid = '$pc' AND hotfix_timestamp = '$timestamp' ORDER BY hotfix_hot_fix_id";
  $SQL = "SELECT * FROM software WHERE software_uuid = '$pc' AND software_timestamp = '$timestamp' AND (software_name LIKE '%hotfix%' OR software_name LIKE '%update%' OR software_name LIKE '%Service Pack%') AND software_system_component <> '1' ORDER BY software_name";
  $result = mysql_query($SQL, $db);
  $bgcolor = "#F1F1F1";
  if ($myrow = mysql_fetch_array($result)){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr><td class=\"menuhead\" colspan=\"3\"><br /><img src=\"images/inv_hotfixes" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />Updates, Patches &amp; Hotfixes</td></tr>";
    //echo "<tr><td width=\"70\">KB Article</td><td>Installer</td><td>Description</td><td align=\"center\">KB Article</td></tr>\n";
    echo "<tr><td>Name</td><td>Version</td><td>Publisher</td><td align=\"center\">Google</td></tr>\n";
    do {
      //if ($myrow['hotfix_hot_fix_id'] == "File 1") {} else {
        //echo "<tr bgcolor=\"" . $bgcolor . "\">";
        //echo "<td valign=\"top\"><a href=\"list_software_hotfixes.php?sub=sw1&amp;name=" . url_clean($myrow['hotfix_hot_fix_id']) . "&amp;desc=" . url_clean($myrow["hotfix_description"]) . "\" title=\"Show All Systems with this hotfix\">" . $myrow["hotfix_hot_fix_id"] . "</a>&nbsp;</td>\n";
        //echo "<td valign=\"top\">" . $myrow['hotfix_installed_by'] . "&nbsp;</td>\n";
        //echo "<td valign=\"top\">" . $myrow['hotfix_description'] . "&nbsp;</td>\n";
        //echo "<td align=\"center\"><a href=\"http://support.microsoft.com/default.aspx?scid=kb;en-us;" . $myrow['hotfix_hot_fix_id'] . "\"><img border=\"0\" alt=\"Knowledge Base Article\" title=\"Knowledge Base Article\" src=\"images/button_kb.gif\" width=\"18\" height=\"18\" /></a></td>\n";
        //echo "</tr>";

	  echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	  echo "<td><a href=\"list_software.php?sub=sw1&amp;name=" . url_clean($myrow["software_name"]) . "\">" . $myrow["software_name"] . "</a></td>\n";
      echo "<td>" . $myrow["software_version"] . "</td>\n";
      echo "<td>";
      if ($myrow["software_url"]) {
        echo "<a href=\"" . $myrow["software_url"] . "\">" . $myrow["software_publisher"] . "</a></td>\n"; 
      } else {
        echo $myrow["software_publisher"] . "</td>\n";
      } 
      echo "<td align=\"center\"><a href=\"http://www.google.com/search?num=30&amp;hl=en&amp;lr=lang_en&amp;ie=UTF-8&amp;oe=UTF-8&amp;safe=off&amp;q=%22" . url_clean($myrow["software_name"]) . "%22&amp;btnG=Search\"><img border=\"0\" alt=\"Google Search\" title=\"Google Search\" src=\"images/button_google.gif\" width=\"16\" height=\"16\" /></a></td>\n";
	  echo "</tr>";





	    if ($bgcolor == "#F1F1F1") {
	      $bgcolor = "#FFFFFF"; }
	    else { $bgcolor = "#F1F1F1"; }
      //}
    } while ($myrow = mysql_fetch_array($result));
    echo "</table>";
  } else {echo "<p class=\"menuhead\"><img src=\"images/inv_software" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />&nbsp;No Patches or Hotfixes installed.</p>"; }
} else {}

if (($sub == "rs") or ($sub == "all")){
  $SQL = "SELECT * FROM startup WHERE startup_uuid = '$pc' AND startup_timestamp = '$timestamp' ORDER BY startup_location, startup_caption";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
    echo "<tr><td class=\"menuhead\" colspan=\"3\"><br /><img src=\"images/inv_startup" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />Run at Startup</td></tr>\n";
	$bgcolor = "#FFFFFF";
	do {
      if ($bgcolor == "#F1F1F1") {
	    $bgcolor = "#FFFFFF"; }
	  else { $bgcolor = "#F1F1F1"; }
	  echo "<tr bgcolor=\"" . $bgcolor . "\"><td><br /><b>Program Name:</b> <a href=\"http://www.google.com/search?num=30&amp;hl=en&amp;lr=lang_en&amp;ie=UTF-8&amp;oe=UTF-8&amp;safe=off&amp;q=%22" . url_clean($myrow["startup_caption"]) . "%22&amp;btnG=Search\"><img border=\"0\" alt=\"Google Search\" title=\"Google Search\" src=\"images/button_google.gif\" width=\"16\" height=\"16\" /></a>  <a href=\"list_software_startup.php?name=" . url_clean($myrow["startup_caption"]) . "\">" . $myrow["startup_caption"] . "</a></td></tr>\n";
	  echo "<tr bgcolor=\"" . $bgcolor . "\"><td><b>User:</b> " . $myrow["startup_user"] . "</td></tr>\n";
	  echo "<tr bgcolor=\"" . $bgcolor . "\"><td><b>Location:</b> " . $myrow["startup_location"] . "</td></tr>\n";
	  echo "<tr bgcolor=\"" . $bgcolor . "\"><td><b>Executable:</b> " . $myrow["startup_command"] . "<br />&nbsp;</td></tr>\n";
	} while ($myrow = mysql_fetch_array($result));
	echo "</table>";
  } else {
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\">";
    echo "<tr>";
    echo "<td class=\"contenthead\"><img src=\"images/inv_software" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />No Startup Items installed.</td>\n"; 
    echo "</tr>";
    echo "</table>";
  }
} else {}

echo "</div>";
echo "</body>";
echo "</html> ";
include "include_png_replace.php";
?>