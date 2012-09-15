<?php 
$page = "software";
include "include.php"; 

echo "<div class=\"main_each\">";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">";
echo "<tr>";
echo "<td align=\"left\" class=\"contenthead\">Currently installed Software for " . $name . "<br />&nbsp;</td>";
echo "</tr>";
echo "</table>";

  $SQL = "SELECT * FROM browser_helper_objects WHERE bho_uuid = '$pc' AND bho_timestamp = '$timestamp' ORDER BY bho_program_file";
  $result = mysql_query($SQL, $db);
  if (($myrow = mysql_fetch_array($result))){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"700\">";
	echo "<tr><td class=\"menuhead\"><img src=\"images/inv_ie" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />Internet Explorer Browser Helper Objects</td></tr>";
	$bgcolor = "#F1F1F1";
	do {
	  echo "<tr bgcolor=\"" . $bgcolor . "\"><td><br />";
	  echo "<a href=\"http://www.google.com/search?num=30&amp;hl=en&amp;lr=lang_en&amp;ie=UTF-8&amp;oe=UTF-8&amp;safe=off&amp;q=%22" . url_clean($myrow["bho_program_file"]) . "%22&amp;btnG=Search\"><img border=\"0\" alt=\"Google Search\" title=\"Google Search\" src=\"images/button_google.gif\" width=\"16\" height=\"16\" /></a>";
	  echo "&nbsp;&nbsp;&nbsp;<a href=\"list_software_bho.php?sub=sw1&amp;name=" . url_clean($myrow["bho_program_file"]) . "\">" . $myrow["bho_program_file"] . "</a>";
      echo "&nbsp;-&nbsp;" . $myrow["bho_status"] . "</td></tr>\n";
      echo "<tr bgcolor=\"" . $bgcolor . "\"><td>" . $myrow["bho_code_base"] . "<br />&nbsp;</td></tr>\n";
	  if ($bgcolor == "#F1F1F1") {
		$bgcolor = "#FFFFFF"; }
	  else { $bgcolor = "#F1F1F1"; }
	} while ($myrow = mysql_fetch_array($result));
	echo "</table>";
  } else {echo "<p class=\"menuhead\"><img src=\"images/inv_ie" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />&nbsp;&nbsp;No IE BHO's installed.</p>"; }
  

echo "</div>";
echo "</body>";
echo "</html> ";
include "include_png_replace.php";
?>