<?php

include "include_config.php";

// Process the form
mysql_connect($mysql_server, $mysql_user, $mysql_password) or die("Could not connect");
mysql_select_db($mysql_database) or die("Could not select database");

$replace = array(" " => ":", "." => ":", "-" => ":", "_" => ":");
$_POST['mac_address'] = strtr($_POST['mac_address'], $replace);

$sql = "insert into system (system_name, net_ip_address, net_mac_address, system_os_name, date_audited, system_description, system_os_type, battery_description)
values ('" . $_POST['name'] . "', '" . $_POST['ip'] . "', '" . $_POST['mac_address'] . "', '" . $_POST['OS'] . "', '" . $_POST['date'] . "', '" . $_POST['description'] . "', '" . $_POST['OS'] . "', '" . $_POST["system_flag"] . "')";
$result = mysql_query($sql);
$sql2 = "INSERT INTO system_man (system_man_mac, system_man_description, system_man_location, system_man_serial_number)
values ('" . $_POST['mac_address'] . "', '" . $_POST['owner'] . "', '" . $_POST['location'] . "', '" . $_POST['asset_tag'] . "')";
$result2 = mysql_query($sql2);
echo $sql . "<br>" . $sql2;
//header("Location: index.php");
?>