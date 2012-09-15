<?php
	
include "include_config.php";

	if ($_GET['confirm']=1) {

	$link = mysql_connect($mysql_server, $mysql_user, $mysql_password) or die("Could not connect");
	mysql_select_db("$mysql_database") or die("Could not select database");

	$query = "DELETE FROM group_names WHERE group_id = '" . $_GET['group'] . "'";
	$result = mysql_query($query)  or die("Query failed at insert stage. groups");

	$query = "DELETE FROM group_members WHERE group_names_id = '" . $_GET['group'] . "'";
	$result = mysql_query($query)  or die("Query failed at insert stage. groups");

	header("Location: group_list.php?pc=");
	} else {}

?>