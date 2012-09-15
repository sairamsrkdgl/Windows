<?php 
$page = "se";
include "include.php"; 

echo "<div class=\"main_each\">";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"700\">\n";
echo "<tr>\n";
echo "<td align=\"left\" class=\"contenthead\">Services Installed for " . $name . "<br />&nbsp;</td>\n";
echo "</tr>\n";
echo "</table>\n";

	$SQL = "SELECT * FROM service WHERE service_uuid = '$pc' AND service_timestamp = '$timestamp' ORDER BY service_display_name";
	$result = mysql_query($SQL, $db);
	if ($myrow = mysql_fetch_array($result)){
	echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
	echo "<tr><td class=\"menuhead\"><img src=\"images/inv_services" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />Installed Services</td></tr>\n";
	echo "</table>";
	echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\" class=\"content\">\n";
	do {
      $SQL2 = "SELECT * FROM service_details WHERE sd_display_name = '" . $myrow["service_display_name"] . "'";
	  $result2 = mysql_query($SQL2, $db);
	  $myrow2 = mysql_fetch_array($result2);
	  echo "<tr bgcolor=\"" . $bgcolor . "\"><td valign=\"top\" width=\"100\">Name:</td><td><a href=\"http://www.google.com/search?num=30&amp;hl=en&amp;lr=lang_en&amp;ie=UTF-8&amp;oe=UTF-8&amp;safe=off&amp;q=windows%22" . url_clean($myrow["service_display_name"]) . "%22service&amp;btnG=Search\">" . $myrow["service_display_name"] . "</a></td></tr>\n";
	  echo "<tr bgcolor=\"" . $bgcolor . "\"><td valign=\"top\">Start Mode:</td><td>" . $myrow["service_start_mode"] . "</td></tr>\n";
	  echo "<tr bgcolor=\"" . $bgcolor . "\"><td valign=\"top\">State:</td><td>" . $myrow["service_state"] . "</td></tr>\n";
	  echo "<tr bgcolor=\"" . $bgcolor . "\"><td valign=\"top\">Started:</td><td>" . $myrow["service_started"] . "</td></tr>\n";
	  echo "<tr bgcolor=\"" . $bgcolor . "\"><td valign=\"top\">Executable:</td><td>" . $myrow["service_path_name"] . "</td></tr>\n";
	  echo "<tr bgcolor=\"" . $bgcolor . "\"><td valign=\"top\">Description:</td><td>" . $myrow2["sd_description"] . "<br />&nbsp;</td></tr>\n";
  	  if ($bgcolor == "#F1F1F1") {
	    $bgcolor = "#FFFFFF"; }
	  else { $bgcolor = "#F1F1F1"; }
	} while ($myrow = mysql_fetch_array($result));
	?>
	</table>
	<?php
	} else {echo "<p class=\"menuhead\">No Services installed.</p>\n"; }
	?>

</div>
</body>
</html> 
<?php
include "include_png_replace.php";
?>