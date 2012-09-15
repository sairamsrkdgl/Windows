<?php
$page = "other";
include "include_config.php";

// Process the form
mysql_connect($mysql_server, $mysql_user, $mysql_password) or die("Could not connect");
mysql_select_db($mysql_database) or die("Could not select database");

$sql = "update software_register set software_comments = '" . $_POST['comments'] . "' WHERE software_reg_id='" . $_GET['id'] . "'";

$result = mysql_query($sql);

header("Location: software_register_details.php?id=" . $_GET["id"]);


?>





