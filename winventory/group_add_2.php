<?php

include "include_config.php";

// Process the form
mysql_connect($mysql_server, $mysql_user, $mysql_password) or die("Could not connect");
mysql_select_db($mysql_database) or die("Could not select database");

//$sql = "insert into group_names (group_name, group_desc) values ('" . $_POST['name'] . "', '" . $_POST['description'] . "')";

if ($_POST['type'] == "hardware")
{
   $sql = "insert into group_names (group_name, group_desc) values ('" . $_POST['name'] . "', '" . $_POST['description'] . "')";
}
else if ($_POST['type'] == "software")
{
   $sql = "insert into software_group_names (group_name, group_desc) values ('" . $_POST['name'] . " (Group)', '" . $_POST['description'] . "')";
}

$result = mysql_query($sql);

header("Location: group_list.php?pc=");
?>





