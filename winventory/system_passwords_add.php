<?php

include "include_config.php";

// Process the form
$db = mysql_connect($mysql_server, $mysql_user, $mysql_password) or die("Could not connect");
mysql_select_db($mysql_database) or die("Could not select database");
$sql = "insert into passwords (passwords_uuid, passwords_application, passwords_user, passwords_password) VALUES ('" . $_POST['pc'] . "','" . $_POST["app"] . "','" . $_POST['usr']  . "','" . $_POST['pas']  . "')";
$result = mysql_query($sql);
header("Location: system_passwords.php?pc=" . $_POST['pc'] . "&sub=pw");
?>
