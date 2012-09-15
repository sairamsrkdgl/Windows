<?php

$password = "Insert domain admin password here";

if ($_GET['action'] == "on") {
$file = "wol.exe " . str_replace(":", "", $_GET["pc"]);
$str = exec($file);
} else {}


if ($_GET['action'] == "off") {
$file = "psshutdown -u " . $_GET['domain'] . "\administrator -p " . $password . " -m \"Shutting Down\" -s -t 0 \\\\" . $_GET['name'];
$str=exec($file);
} else {}


if ($_GET['action'] == "reboot") {
$file = "psshutdown -u " . $_GET['domain'] . "\administrator -p " . $password . " -m \"Rebooting\" -r -t 0 \\\\" . $_GET['name'];
$str=exec($file);
} else {}

echo $file;
header("Location: actions.php?pc=" . $_GET['pc'] . "&sub=no");
?>