<?php 
$page = "se";
include "include.php"; 

echo "<div class=\"main_each\">";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"contenthead\">";
echo "<tr>";
echo "<td>Returned HFNetChk Information for " . $name . "<br />&nbsp;</td>";
echo "</tr>";
echo "</table>";

$opt_count = 0;
$SQL = "SELECT * FROM system WHERE system_uuid = '$pc' AND system_timestamp = '$timestamp'";
$result = mysql_query($SQL, $db);
$myrow = mysql_fetch_array($result);
$name = $myrow["system_name"];
$SQL = "SELECT * from system_security WHERE ss_name = '" . $name . "' ORDER BY ss_product DESC";
$result = mysql_query($SQL, $db);
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">";
echo "<tr><td class=\"contenthead\" colspan=\"2\"><img src=\"images/inv_patches" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />Patches</td></tr>";
$old_prod = "";
if ($myrow = mysql_fetch_array($result)){
  do {
    $cur_prod = $myrow["ss_product"];
	if ($cur_prod <> $old_prod) {
      echo "<tr><td class=\"contenthead\"><br /><b>" . $myrow["ss_product"] . "</b></td></tr>\n";
	} else {}
	if ($myrow["ss_status"] == "Information"){
	echo "<tr><td><b>" . $myrow["ss_status"] . ":</b> " . $myrow["ss_reason"] . "</td></tr>\n";
	} else {
	  if ($myrow["ss_status"] == "NOT Found") { $font_col = "red";} else {}
	  if ($myrow["ss_status"] == "Warning") { $font_col = "orange"; } else {}
	  if ($myrow["ss_status"] == "Information") { $font_col = "green"; } else {}
	  if ($myrow["ss_status"] == "Note") { $font_col = "blue"; } else {}
	  $sql2 = "SELECT * FROM system_security_bulletins WHERE ssb_qno = '" . $myrow["ss_qno"] . "'";
	  $result2 = mysql_query($sql2, $db);
	  if ($myrow2 = mysql_fetch_array($result2)){
	    do {
		  echo "<tr bgcolor=\"" . $bgcolor . "\"><td><b>Details:</b> <font color=\"" . $font_col . "\">" . $myrow["ss_status"] . "</font> - " . $myrow["ss_qno"] . " - " . $myrow2["ssb_bulletin"] . " - <a href=\"" . $myrow2["ssb_url"] . "\">Microsoft Page</a></td></tr>";
		  echo "<tr bgcolor=\"" . $bgcolor . "\"><td><b>Title:</b> " . $myrow2["ssb_title"] . "</td></tr>";
		  echo "<tr bgcolor=\"" . $bgcolor . "\"><td><b>Description:</b> " . $myrow2["ssb_description"] . "</td></tr>";
		  echo "<tr bgcolor=\"" . $bgcolor . "\"><td><b>Reason:</b> " . $myrow["ss_reason"] . "<br />&nbsp;</td></tr>";
		} while ($myrow2 = mysql_fetch_array($result2));
	  } else {}
	}
	$old_prod = $cur_prod;
    if ($bgcolor == "#F1F1F1") {
      $bgcolor = "#FFFFFF"; }
    else { $bgcolor = "#F1F1F1"; }
  } while ($myrow = mysql_fetch_array($result));
} else {
  echo "<tr><td>Nothing detected by HFNetChk.</td></tr>\n";
}

echo "</table>\n";

echo "</div>\n";
echo "</body>\n";
echo "</html>\n";

include "include_png_replace.php";
?>