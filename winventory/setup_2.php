<?php
$page = "setup";
include "include.php";
//include "include_config.php";
//include "include_lang_english.php";
//include "include_col_scheme.php";
$bgcolor = "#FFFFFF";


echo "<div class=\"main_each\">";
  echo "<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" width=\"700\" class=\"content\">\n";
  echo "<tr><td class=\"contenthead\">Setting defaults in the database.</td></tr>";
  echo "<tr><td colspan=\"3\"><hr /></td></tr>";
  echo "<tr><td>Connecting to " . $mysql_server . " as " . $mysql_user . ".</td>\n";
//  if ($mysql_password){
    mysql_connect($mysql_server, $mysql_user, $mysql_password) or die("Could not connect");
//  } else {
//    mysql_connect($mysql_server, $mysql_user) or die("Could not connect");
//  }
  echo "<td>Connected.</td><td><img src=\"images/button_ok.png\" width=\"16\" height=\"16\" /></td></tr>\n";
  echo "<tr><td>Setting up data in tables.</td>";

  $SQL = "INSERT INTO call_priority (call_priority_id, call_priority_name, call_priority_colour, call_priority_font_colour) VALUES ('1','Critical','red','white')";
  $result = mysql_query($SQL) or die("<tr><td>Query failed. Query was:<br /><font color=\"red\">" . $SQL . "</font></td></tr>\n");
  //echo "<tr><td>" . $SQL . "</td></tr>\n";
  $SQL = "INSERT INTO call_priority (call_priority_id, call_priority_name, call_priority_colour, call_priority_font_colour) VALUES ('2','High','orange','black')";
  $result = mysql_query($SQL) or die("<tr><td>Query failed. Query was:<br /><font color=\"red\">" . $SQL . "</font></td></tr>\n");
  //echo "<tr><td>" . $SQL . "</td></tr>\n";
  $SQL = "INSERT INTO call_priority (call_priority_id, call_priority_name, call_priority_colour, call_priority_font_colour) VALUES ('3','Medium','blue','white')";
  $result = mysql_query($SQL) or die("<tr><td>Query failed. Query was:<br /><font color=\"red\">" . $SQL . "</font></td></tr>\n");
  //echo "<tr><td>" . $SQL . "</td></tr>\n";
  $SQL = "INSERT INTO call_priority (call_priority_id, call_priority_name, call_priority_colour, call_priority_font_colour) VALUES ('4','Low','grey','black')";
  $result = mysql_query($SQL) or die("<tr><td>Query failed. Query was:<br /><font color=\"red\">" . $SQL . "</font></td></tr>\n");
  //echo "<tr><td>" . $SQL . "</td></tr>\n";
  $SQL = "INSERT INTO call_priority (call_priority_id, call_priority_name, call_priority_colour, call_priority_font_colour) VALUES ('5','Not Prioritised','white','black')";
  $result = mysql_query($SQL) or die("<tr><td>Query failed. Query was:<br /><font color=\"red\">" . $SQL . "</font></td></tr>\n");
  //echo "<tr><td>" . $SQL . "</td></tr>\n";
  $SQL = "INSERT INTO call_status (call_status_name, call_status_colour) VALUES ('New','red')";
  $result = mysql_query($SQL) or die("<tr><td>Query failed. Query was:<br /><font color=\"red\">" . $SQL . "</font></td></tr>\n");
  //echo "<tr><td>" . $SQL . "</td></tr>\n";
  $SQL = "INSERT INTO call_status (call_status_name, call_status_colour) VALUES ('Assigned','blue')";
  $result = mysql_query($SQL) or die("<tr><td>Query failed. Query was:<br /><font color=\"red\">" . $SQL . "</font></td></tr>\n");
  //echo "<tr><td>" . $SQL . "</td></tr>\n";
  $SQL = "INSERT INTO call_status (call_status_name, call_status_colour) VALUES ('Awaiting More Info','orange')";
  $result = mysql_query($SQL) or die("<tr><td>Query failed. Query was:<br /><font color=\"red\">" . $SQL . "</font></td></tr>\n");
  //echo "<tr><td>" . $SQL . "</td></tr>\n";
  $SQL = "INSERT INTO call_status (call_status_name, call_status_colour) VALUES ('Closed','green')";
  $result = mysql_query($SQL) or die("<tr><td>Query failed. Query was:<br /><font color=\"red\">" . $SQL . "</font></td></tr>\n");
  //echo "<tr><td>" . $SQL . "</td></tr>\n";
  $SQL = "INSERT INTO config (config_name, config_value) VALUES ('calls','set')";
  $result = mysql_query($SQL) or die("<tr><td>Query failed. Query was:<br /><font color=\"red\">" . $SQL . "</font></td></tr>\n");
  //echo "<tr><td>" . $SQL . "</td></tr>\n";
  $SQL = "INSERT INTO config (config_name, config_value) VALUES ('version','0.9.00 pre3')";
  $result = mysql_query($SQL) or die("<tr><td>Query failed. Query was:<br /><font color=\"red\">" . $SQL . "</font></td></tr>\n");
  //echo "<tr><td>" . $SQL . "</td></tr>\n";
  $SQL = "SET PASSWORD FOR " . $mysql_user . "@localhost = OLD_PASSWORD('" . $mysql_password . "')";
  $result = mysql_query($SQL) or die("<tr><td>Query failed. Query was:<br /><font color=\"red\">" . $SQL . "</font></td></tr>\n");
  //echo "<tr><td>" . $SQL . "</td></tr>\n";
  echo "<td>Done.</td><td><img src=\"images/button_ok.png\" width=\"16\" height=\"16\" /></td></tr>\n";



  echo "<tr><td>Next we'll configure audit.vbs. <br />&nbsp;</td></tr>";
  echo "<tr><td>Click <a href=\"setup_audit.php\">here</a> to continue.<br /></td>";

  echo "</table>";