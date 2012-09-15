<?php
$page = "other";
include "include_config.php";

// Process the form
mysql_connect($mysql_server, $mysql_user, $mysql_password) or die("Could not connect");
mysql_select_db($mysql_database) or die("Could not select database");

$sql = "update other set other_name = '" . $_POST['name'] . "', other_ip = '" . $_POST['ip'] . "', other_mac_address = '" . $_POST['mac_address'] . "', other_description = '" . $_POST['description'] . "', other_serial = '" . $_POST['serial'] . "', other_manufacturer = '" . $_POST['manufacturer'] . "', other_model='" . $_POST['model'] . "', other_type='" . $_POST['type'] . "', other_location='" . $_POST['location'] . "', other_date_purchase='" . $_POST['date'] . "', other_value='" . $_POST['dollar'] . "', other_linked_pc='" . $_POST['linked_pc'] . "', other_date_detected = '" . $_POST["date_detected"] . "' WHERE other_id='" . $_GET['other'] . "'";

$result = mysql_query($sql);

header("Location: other_summary.php?other=" . $_GET["other"]);


?>





