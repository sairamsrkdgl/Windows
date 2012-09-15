<?php 
$page = "software";
include "include.php"; 


echo "<div class=\"main_each\">";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">";
echo "<tr>";
echo "<td align=\"left\" class=\"contenthead\">CD Keys for installed Microsoft Software -  " . $name . "<br />&nbsp;</td>";
echo "</tr>";
echo "</table>";
  

	$SQL = "SELECT * FROM ms_keys WHERE ms_keys_uuid = '$pc' AND ms_keys_timestamp = '$timestamp' AND ms_keys_key_type LIKE 'windows%'";
	$result = mysql_query($SQL, $db);
	if (($myrow = mysql_fetch_array($result))){
	$bgcolor = "#F1F1F1";
	echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
	echo "<tr><td class=\"menuhead\" colspan=\"2\"><img src=\"images/inv_software" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />CD Key - Windows</td></tr>";
	do {
	echo "<tr bgcolor=\"" . $bgcolor . "\">";
	echo "<td width=\"350\"><br />Product Name:&nbsp;<br />Product Installation Key:&nbsp;<br />&nbsp;</td>";
	echo "<td><br />" . $myrow["ms_keys_name"] . "<br />" . $myrow["ms_keys_cd_key"] . "&nbsp;<br />&nbsp;</td></tr>";
	if ($bgcolor == "#F1F1F1") {
		$bgcolor = "#FFFFFF"; }
	else { $bgcolor = "#F1F1F1"; }
	} while ($myrow = mysql_fetch_array($result));
	echo "</table>";
	} else {}
  

	$SQL = "SELECT * FROM ms_keys WHERE ms_keys_uuid = '$pc' AND ms_keys_timestamp = '$timestamp' AND ms_keys_key_type = 'office_2003'";
	$result = mysql_query($SQL, $db);
	if (($myrow = mysql_fetch_array($result))){
	$bgcolor = "#F1F1F1";
	echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
	echo "<tr><td class=\"menuhead\" colspan=\"2\"><img src=\"images/inv_software" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />CD Keys - Office 2003</td></tr>";
	do {
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td width=\"350\">&nbsp;</td><td>&nbsp;</td></tr>";
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Product Name: </td><td>" . $myrow["ms_keys_name"] . "</td></tr>";
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Product Release: </td><td>" . $myrow["ms_keys_release"] . "</td></tr>";
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Product Edition: </td><td>" . $myrow["ms_keys_edition"] . "</td></tr>";
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Product Installation Key: </td><td>" . $myrow["ms_keys_cd_key"] . "</td></tr>";
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td>&nbsp;</td><td>&nbsp;</td></tr>";
	if ($bgcolor == "#F1F1F1") {
		$bgcolor = "#FFFFFF"; }
	else { $bgcolor = "#F1F1F1"; }
	} while ($myrow = mysql_fetch_array($result));
	echo "</table>";
	} else {}


	$SQL = "SELECT * FROM ms_keys WHERE ms_keys_uuid = '$pc' AND ms_keys_timestamp = '$timestamp' AND ms_keys_key_type = 'office_xp'";
	$result = mysql_query($SQL, $db);
	if (($myrow = mysql_fetch_array($result))){
	$bgcolor = "#F1F1F1";
	echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
	echo "<tr><td class=\"menuhead\" colspan=\"2\"><img src=\"images/inv_software" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />CD Keys - Office XP</td></tr>";
	do {
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td width=\"350\">&nbsp;</td><td>&nbsp;</td></tr>";
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Product Name: </td><td>" . $myrow["ms_keys_name"] . "</td></tr>";
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Product Release: </td><td>" . $myrow["ms_keys_release"] . "</td></tr>";
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Product Edition: </td><td>" . $myrow["ms_keys_edition"] . "</td></tr>";
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Product Installation Key: </td><td>" . $myrow["ms_keys_cd_key"] . "</td></tr>";
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td>&nbsp;</td><td>&nbsp;</td></tr>";
	if ($bgcolor == "#F1F1F1") {
		$bgcolor = "#FFFFFF"; }
	else { $bgcolor = "#F1F1F1"; }
	} while ($myrow = mysql_fetch_array($result));
	echo "</table>";
	} else {}


	$SQL = "SELECT * FROM ms_keys WHERE ms_keys_uuid = '$pc' AND ms_keys_timestamp = '$timestamp' AND ms_keys_key_type NOT LIKE 'office%' AND ms_keys_key_type NOT LIKE 'windows%'";
	$result = mysql_query($SQL, $db);
	if (($myrow = mysql_fetch_array($result))){
	$bgcolor = "#F1F1F1";
	echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
	echo "<tr><td class=\"menuhead\" colspan=\"2\"><img src=\"images/inv_software" . $pic_style . ".png\" width=\"64\" height=\"64\" alt=\"\" />CD Keys - Other Software</td></tr>";
	do {
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td width=\"350\">&nbsp;</td><td>&nbsp;</td></tr>";
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Product Name: </td><td>" . $myrow["ms_keys_name"] . "</td></tr>";
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Product Release: </td><td>" . $myrow["ms_keys_release"] . "</td></tr>";
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Product Edition: </td><td>" . $myrow["ms_keys_edition"] . "</td></tr>";
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td>Product Installation Key: </td><td>" . $myrow["ms_keys_cd_key"] . "</td></tr>";
	echo "<tr bgcolor=\"" . $bgcolor . "\"><td>&nbsp;</td><td>&nbsp;</td></tr>";
	if ($bgcolor == "#F1F1F1") {
		$bgcolor = "#FFFFFF"; }
	else { $bgcolor = "#F1F1F1"; }
	} while ($myrow = mysql_fetch_array($result));
	echo "</table>";
	} else {}
	

?>
</div>
</div>
</body>
</html> 

<?php
include "include_png_replace.php";
?>