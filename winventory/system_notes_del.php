<?php
	
include "include_config.php";

	if ($_GET['confirm']=1) {

	$link = mysql_connect($mysql_server, $mysql_user, $mysql_password) or die("Could not connect");
	mysql_select_db("$mysql_database") or die("Could not select database");
	$query = "DELETE FROM notes WHERE notes_id = '" . $_GET['note'] . "'";
	$result = mysql_query($query)  or die("Query failed at insert stage.");
	header("Location: system_notes.php?pc=" . $_GET['pc'] . "&sub=no");
	} else {}

?>