<?php

include "include_config.php";

// Process the form
mysql_connect($mysql_server, $mysql_user, $mysql_password) or die("Could not connect");
mysql_select_db($mysql_database) or die("Could not select database");
$sql = "insert into notes (notes_uuid, notes_notes) VALUES ('" . $_POST["pc"] . "','" . $_POST["note"] . "')";
$result = mysql_query($sql);
header("Location: system_notes.php?pc=" . $_POST['pc'] . "&sub=no");

?>





