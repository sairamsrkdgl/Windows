<?php
$page = "setup";
include "include_config.php";
include "include_lang_english.php";
include "include_col_scheme.php";
$bgcolor = "#FFFFFF";

if ($use_pass != "n") { 

// If there's no Authentication header, exit
if (!isset($_SERVER['PHP_AUTH_USER'])) {
 header('HTTP/1.1 401 Unauthorized');
 header('WWW-Authenticate: Basic realm="PHP Secured"');
 exit('This page requires authentication');
}

// If the user name doesn't exist, exit
if (!isset($users[$_SERVER['PHP_AUTH_USER']])) {
 header('HTTP/1.1 401 Unauthorized');
 header('WWW-Authenticate: Basic realm="PHP Secured"');
 exit('Unauthorized!');
}

// Is the password doesn't match the username, exit
if ($users[$_SERVER['PHP_AUTH_USER']] != $_SERVER['PHP_AUTH_PW'])
{
 header('HTTP/1.1 401 Unauthorized');
 header('WWW-Authenticate: Basic realm="PHP Secured"');
 exit('Unauthorized!');
}
} else {}

ob_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml11/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WINventory</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta content="Windows Inventory" name="description" />
<meta content="inventory, software, hardware, windows, automatic" name="keywords" />
<meta content="Mark Unwin" name="author" />
<?php include "include_style.php"; ?>

</head>
<body>

<div id="header">
<form action="index.php?sub=11" method="post">
<table style="width: 100%;" cellpadding="0" cellspacing="0" class="header">
  <tbody>
    <tr style="<?php echo $header_top; ?>">
      <td width="150" height="23"><img src="<?php echo $header_top_image; ?>" border="0" width="150" height="23" alt=""></img></td>
      <td></td>
      <td width="280"><font style="font-family: Verdana;" size="-2" color="white">WINventory Home&nbsp;&nbsp;|&nbsp;&nbsp;Site Map</font></td>
    </tr>
    <tr style="<?php echo $header_middle; ?>">
      <td height="42"><a href="index.php"><img src="<?php echo $header_middle_image; ?>" border="0" height="42" width="409" alt="" /></a></td>
      <td>&nbsp;</td>
      <td width="280">Search WINventory for (system name)<input size="30" name="system_name" class="header" />&nbsp;&nbsp;<input name="submit" value="Go" type="submit" /></td>
    </tr>
    <tr style="<?php echo $header_bottom; ?>">
      <td height="23"><span style="color: rgb(255, 255, 255); font-family: Verdana; font-size:15px;">&nbsp;Network Inventory Tracking</span></td>
      <td></td>
      <td align="right"><font size="-2" color="white">© Mark Unwin, 2005.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></td>
    </tr>
    <tr style="background-color: <?php echo $background; ?>;">
      <td height="20" colspan="3">&nbsp;&nbsp;<a href="index.php" class="header">Home</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="help.php" class="header">Help</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://winventory.sf.net/" class="header">WINventory on the web</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="calls_home.php" class="header">Call Register</a></td>
    </tr>
  </tbody>
</table>
</form>
</div>

<div class="main_each">

<?php
if(!(isset($_POST['submit']))){
?>


<form name="setup" action="setup.php" method="post">
<table width="700" border="0" class="content">
  <tr>
    <td class="contenthead" colspan="2">Hi and Welcome to the Windows Inventory setup page.</td>
  </tr>
  <tr>
    <td colspan="3"><hr /></td>
  </tr>
  <tr>
    <td>What is your MySQL host name ?</td>
	<td><input size="20" name="mysql_host" class="content" value="localhost" /></td>
  </tr>
  <tr>
    <td>What is your MySQL user name ?</td>
	<td><input size="20" name="mysql_user" class="content" value="root" /></td>
  </tr>
  <tr>
    <td>What is your MySQL password ?</td>
	<td><input size="20" name="mysql_pass" class="content" /></td>
  </tr>
  <tr>
    <td>What is your MySQL database name ?</td>
	<td><input size="20" name="mysql_data" class="content" value="winventory" /></td>
  </tr>
  <tr>
    <td>Do you wish to use usernames ?</td>
	<td><select size="1" name="usernames" class="content">
	    <option value="n">No</option>
		<option value="y">Yes</option>
		</select></td>
  </tr>
  <tr>
    <td>Username:</td>
	<td><input size="20" name="username" class="content" value="username" /></td>
  </tr>
  <tr>
    <td>Password:</td>
	<td><input size="20" name="password" class="content" value="password" /></td>
  </tr>
  <tr><td colspan="2"><hr /></td></tr>
  <tr>
    <td>Click Submit whem you are done.</td>
	<td><input type="submit" name="submit" value="Submit" class="content" /></td>
  </tr>
</table>
</form>


<?php
} else {

//if ($_POST['setup_type'] == "new"){

  // New install script
  echo "<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" width=\"700\" class=\"content\">\n";
  echo "<tr><td class=\"contenthead\">Setting up a new instance of Windows Inventory.</td></tr>\n";
  echo "<tr><td colspan=\"3\"><hr /></td></tr>";
  echo "<tr><td>Writing Config file.</td>\n";
  $filename = 'include_config.php';
  $content = "<";
  $content .= "?";
  $content .= "php \r\n";
  $content .= "\$mysql_server = '" . $_POST['mysql_host'] . "'; \r\n";
  $content .= "\$mysql_database = '" . $_POST['mysql_data'] . "'; \r\n";
  $content .= "\$mysql_user = '" . $_POST['mysql_user'] . "'; \r\n";
  $content .= "\$mysql_password = '" . $_POST['mysql_pass'] . "'; \r\n";
  $content .= " \r\n";
  $content .= "// An array of allowed users and their passwords \r\n";
  $content .= "// Make sure to set use_pass = \"n\" if you do not wish to use passwords \r\n";
  $content .= "\$use_pass = '" . $_POST['usernames'] . "'; \r\n";
  $content .= "\$users = array( \r\n";
  $content .= "  '" . $_POST['username'] . "' => '" . $_POST['password'] . "' \r\n";
  $content .= "\n); \r\n";
  $content .= " \r\n";
  $content .= " \r\n";
  $content .= "// Config options for index.php \r\n";
  $content .= "\$show_other_discovered = 'y'; \r\n";
  $content .= "\$other_detected = '3'; \r\n";
  $content .= " \r\n";
  $content .= "\$show_system_discovered = 'y'; \r\n";
  $content .= "\$system_detected = '3'; \r\n";
  $content .= " \r\n";
  $content .= "\$show_systems_not_audited = 'y'; \r\n";
  $content .= "\$days_systems_not_audited = '3'; \r\n";
  $content .= " \r\n";
  $content .= "\$show_partition_usage = 'y'; \r\n";
  $content .= "\$partition_free_space = '1000'; \r\n";
  $content .= " \r\n";
  $content .= "\$show_software_detected = 'y'; \r\n";
  $content .= "\$days_software_detected = '5'; \r\n";
  $content .= " \r\n";
  $content .= "\$show_patches_not_detected = 'y'; \r\n";
  $content .= "\$number_patches_not_detected = '5'; \r\n";
  $content .= " \r\n";
  $content .= "\$show_detected_servers = 'y'; \r\n";
  $content .= " \r\n";
  $content .= "\$show_os = 'y'; \r\n";
  $content .= "\$show_date_audited = 'y'; \r\n";
  $content .= "\$show_type = 'y'; \r\n";
  $content .= "\$show_description = 'n'; \r\n";
  $content .= "\$show_domain = 'n'; \r\n";
  $content .= "\$show_service_pack = 'n'; \r\n";
  $content .= " \r\n";
  $content .= "\$count_system = '20'; \r\n";
  $content .= "\n";
  $content .= "\$col = 'blue'; \r\n";
  $content .= "\$pic_style = '_win'; \r\n";
  $content .= " \r\n";
  $content .= "?";
  $content .= ">";


  if (is_writable($filename)) {
    if (!$handle = fopen($filename, 'w')) {
      echo "</tr><tr><td><h2>Cannot open file ($filename)</h2></td></tr>";
      exit;
    }
    if (fwrite($handle, $content) === FALSE) {
      echo "</tr><tr><td><h2>Cannot write to file ($filename)</h2></td></tr>";
      exit;
    } else { 
      echo "<td>Success.</td><td><img src=\"images/button_ok.png\" width=\"16\" height=\"16\" /></td></tr>";
    }
    fclose($handle);
  } else {
    echo "</tr><tr><td><h2>The file $filename is not writable</h2></td></tr>";
  }


  echo "<tr><td>Connecting to " . $_POST['mysql_host'] . " as " . $_POST['mysql_user'] . ".</td>\n";
  mysql_connect($_POST['mysql_host'], $_POST['mysql_user'], $_POST['mysql_pass']) or die("Could not connect");
  echo "<td>Connected.</td><td><img src=\"images/button_ok.png\" width=\"16\" height=\"16\" /></td></tr>\n";
  echo "<tr><td>Opening MySQL Dump file and reading contents.</td>\n";
  $filename = "scripts/winventory.sql";
  $handle = fopen($filename, "rb");
  $contents = fread($handle, filesize($filename));
  fclose($handle);
  echo "<td>Done.</td><td><img src=\"images/button_ok.png\" width=\"16\" height=\"16\" /></td></tr>\n";
  echo "<tr><td>Creating database.</td>\n";
  mysql_query("CREATE DATABASE /*!32312 IF NOT EXISTS*/ " . $_POST['mysql_data']) or die ("Could not create database");
  mysql_query("SET PASSWORD FOR " . $_POST['mysql_user'] . "@localhost = OLD_PASSWORD('" . $_POST['mysql_pass'] . "');") or die ("Could not set password=old");
  mysql_query("FLUSH PRIVILEGES;") or die ("Could not flush privileges");
  mysql_query("USE " . $_POST['mysql_data']) or die ("Could not USE " . $_POST['mysql_data']);
  echo "<td>Created.</td><td><img src=\"images/button_ok.png\" width=\"16\" height=\"16\" /></td></tr>\n";
  $sql = stripslashes($contents);
  $sql2 = explode(";", $sql);
  echo "<tr><td>Running SQL upload.<br />&nbsp;</td></tr>";
  echo "<tr><td>Click <a href=\"setup_2.php\">here</a> to continue.</td></tr>\n";
  foreach ($sql2 as $sql3) {
  //echo "<tr><td>" . $sql3 . "</td></tr>";
  $result = mysql_query($sql3 . ";") or die ("<tr><td><h1><font color=\"red\">" . $sql3 . "</font></h1></td></tr>");
  }
  echo "<tr><td>Completed.</td><td><img src=\"images/button_ok.png\" width=\"16\" height=\"16\" /></td></tr>\n";
  
//} else {}


}

?>
</div>
</body>
</html>