<?php

include "include_config.php";

// Process the form
mysql_connect($mysql_server, $mysql_user, $mysql_password) or die("Could not connect");
mysql_select_db($mysql_database) or die("Could not select database");

$sql = "insert into software_licenses (license_software_id, license_purchase_date, license_purchase_vendor, license_purchase_cost_each, ";
$sql .= "license_purchase_number, license_comments, license_purchase_type, license_order_number) values ";

$sql .= "('" . $_POST['id'] . "', '" . $_POST['date_purchased'];
$sql .= "', '" . $_POST['vendor'];
$sql .= "', '" . $_POST['cost'] . "', '" . $_POST['number_purchased'];
$sql .= "', '" . $_POST['comments'] . "', '" . $_POST['type'];
$sql .= "', '" . $_POST['order'] . "')";

$result = mysql_query($sql);

header("Location: software_register.php?pc=");
?>





