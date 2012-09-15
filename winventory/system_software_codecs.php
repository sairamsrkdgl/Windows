<?php 
$page = "software";
include "include.php"; 

echo "<div class=\"main_each\">";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
echo "<tr>\n";
echo "<td align=\"left\" class=\"contenthead\">Currently installed Codecs on " . $name . "<br />&nbsp;</td>\n";
echo "</tr>\n";
echo "</table>\n";


  $SQL = "SELECT * FROM software WHERE software_uuid = '$pc' AND software_timestamp = '$timestamp' AND software_name LIKE 'Codec%' ORDER BY software_name";
  $result = mysql_query($SQL, $db);
  if (($myrow = mysql_fetch_array($result))){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">\n";
	echo "<tr><td class=\"menuhead\"><img src=\"images/inv_software" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />Installed Non-Microsoft Codecs</td></tr>\n";
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
      echo "<td align=\"center\"><a href=\"http://www.google.com/search?num=30&amp;hl=en&amp;lr=lang_en&amp;ie=UTF-8&amp;oe=UTF-8&amp;safe=off&amp;q=" . str_replace("-","",url_clean($myrow["software_name"])) . "&amp;btnG=Search\"><img border=\"0\" alt=\"Google Search\" title=\"Google Search\" src=\"images/button_google.gif\" width=\"16\" height=\"16\" /></a></td>\n";
	  echo "</tr>";
	  if ($bgcolor == "#F1F1F1") {
		$bgcolor = "#FFFFFF"; }
	  else { $bgcolor = "#F1F1F1"; }
	} while ($myrow = mysql_fetch_array($result));
	echo "</table>";
  } else {echo "<p class=\"menuhead\"><img src=\"images/inv_software" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />&nbsp;No Software installed.</p>"; }


echo "</div>";
echo "</body>";
echo "</html> ";
include "include_png_replace.php";
?>