<?php

include "include_config.php";

// Process the form
mysql_connect($mysql_server, $mysql_user, $mysql_password) or die("Could not connect");
mysql_select_db($mysql_database) or die("Could not select database");


$sql = $_POST['add'];

$sql = stripslashes($sql);

$sql2 = explode("\n", $sql);

foreach ($sql2 as $sql3) {
	$sql3 = str_replace('^^^', '\n', $sql3);
	$result = mysql_query($sql3);
}

if (isset($_GET['fs'])) {
  echo "Thankyou. Your PC has now been audited. <a href=\"JavaScript:window.close();\">Close this window</a>.";} 
else {
  header("Location: index.php");
}

?>





