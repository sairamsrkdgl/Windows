<?php 
$page = "calls";
include "include.php"; 

if ($_SERVER['AUTH_USER'] <> NULL){
  $user_explode = explode("\\\\",$_SERVER['AUTH_USER'],2);
  $user_name = $user_explode[1];
} else {
  $user_name = "";
}

error_reporting(0);
$dn = "dc=ho,dc=qpcu,dc=org,dc=au";
$user = "administrator@ho.qpcu.org.au";
$secret = "password goes here";
$attributes = array("displayname", "mail","samaccountname","telephonenumber","usncreated","department","sn");
$filter = "(&(objectClass=user)(objectCategory=person)(cn=*))";
$ad = ldap_connect("ldap://qpcu-svr3.ho.qpcu.org.au") or die("Couldn't connect to AD!");
ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ad, LDAP_OPT_REFERRALS, 0);
$bd = ldap_bind($ad,$user,$secret);
if ($bd){
  //echo "Admin - Authenticated<br>";
} else {
  echo "Admin - Not a valid username/password.";
}
$result = ldap_search($ad, $dn, $filter, $attributes);
ldap_sort($ad,$result,"displayname");
$entries = ldap_get_entries($ad, $result);


$SQL = "SELECT count(*) as count from config where config_name = 'calls'";
$result = mysql_query($SQL, $db);
$myrow = mysql_fetch_array($result);
if ($myrow["count"] <> "1"){
  echo "<div class=\"main_each\">\n";
  echo "<p>Please setup your calls <a href=\"calls_setup.php\">HERE</a>.</p>";
  echo "</div>";
} else {

echo "<div class=\"main_each\">\n";
echo "<form action=\"call_add_2.php?sub=no\" method=\"post\">\n";
echo "<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
echo "<tr><td class=\"contenthead\">Add a Call.</td></tr>\n";

echo "<tr><td>Logged By:&nbsp;</td><td><select size=\"1\" name=\"logged_by\" class=\"content\">\n";
for ($i=0; $i<$entries["count"]; $i++)
{
  if (($entries[$i]["displayname"][0] == "") OR ($entries[$i]["mail"][0] == NULL) OR ($entries[$i]["telephonenumber"][0] == NULL)) {} else {
	echo "<option value=\"" . $entries[$i]["displayname"][0] . "\"";
    if ($user_name == $entries[$i]["samaccountname"][0]) { echo " selected"; } else {}
    echo " >" . $entries[$i]["displayname"][0] . "</option>\n";
  }
}
echo "</select></td></tr>";

echo "<tr><td>Date Logged:&nbsp;</td><td>" . date('Y-m-d H:m:s') . "</td></tr>";

echo "<tr><td>Call Priority:&nbsp;</td><td><select size=\"1\" name=\"priority\" class=\"content\">\n";
$SQL = "SELECT * FROM call_priority ORDER BY call_priority DESC";
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
  do {
    echo "<option value=\"" . $myrow["call_priority_id"] . "\" color=\"" . $myrow["call_priority_colour"] . "\">";
    echo $myrow["call_priority_name"] . "</option>\n";
  } while ($myrow = mysql_fetch_array($result));
} else {}
echo "</select></td></tr>";

echo "<tr><td>Very short description:&nbsp;</td><td><input type=\"text\" name=\"short_desc\" size=\"20\"></td></tr>";
echo "<tr><td colspan=\"2\">Enter details below:<br /><textarea rows=\"10\" name=\"detail\" cols=\"60\"></textarea><br /></td></tr>";
echo "<tr><td><input type=\"submit\" name=\"submit\" value=\"Submit\"></td></tr>";


echo "</table>";
echo "</form>";
echo "</div>";
echo "</body>";
echo "</html>";
include "include_png_replace.php";
}
?>