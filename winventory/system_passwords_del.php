<?php
	
include "include_config.php";

	if ($_GET['confirm']=1) {
	$link = mysql_connect($mysql_server, $mysql_user, $mysql_password) or die("Could not connect");
	mysql_select_db($mysql_database) or die("Could not select database");
	$query = "DELETE FROM passwords WHERE passwords_id = '" . $_GET['pass'] . "'";
	$result = mysql_query($query)  or die("Query failed at insert stage.");
	header("Location: system_passwords.php?pc=" . $_GET['pc'] . "&sub=pw" );
	} else {}

?>