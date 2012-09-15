<?php
$page = "calls";
include "include.php"; 

// Process the form
mysql_connect($mysql_server, $mysql_user, $mysql_password) or die("Could not connect");
mysql_select_db($mysql_database) or die("Could not select database");


$sql = "INSERT INTO call (call_logged_person, call_logged_date, call_logged_priority, call_short_description, call_detailed_description, call_status) VALUES ('";
$sql .= $_POST["logged_by"] . "','";
$sql .= date('Y-m-d H:m:s') . "','";
$sql .= $_POST["priority"] . "','";
$sql .= $_POST["short_desc"] . "','";
$sql .= $_POST["detail"] . "','1')";

$result = mysql_query($sql);

echo "<div class=\"main_each\">";
echo $sql . "<br /><br />";


echo "Thankyou. Your PC has now been audited. <a href=\"JavaScript:window.close();\">Close this window</a>.";
echo "</div>";

?>





