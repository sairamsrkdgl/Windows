<?php
$page = "groups";
include "include_config.php";

// Process the form
mysql_connect($mysql_server, $mysql_user, $mysql_password) or die("Could not connect");
mysql_select_db($mysql_database) or die("Could not select database");

$sql = "update group_names set group_name = '" . $_POST['name'] . "', group_desc = '" . $_POST['description'] . "' WHERE group_id='" . $_GET['group'] . "'";

$result = mysql_query($sql);

header("Location: group_list.php?pc=");


?>





