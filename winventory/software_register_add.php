<?php 
$page = "register";
$extra = "";
$SQL = "";


$bgcolor = "#FFFFFF";

if (isset($_GET['package'])) {
  include "include_config.php";
  //echo "<div class=\"main_each\">Set.";
  $sql = "SELECT count(*) AS count FROM software_register WHERE software_title = '" . $_GET['package'] . "'";
  mysql_connect($mysql_server, $mysql_user, $mysql_password) or die("Could not connect");
  mysql_select_db($mysql_database) or die("Could not select database");
  $result = mysql_query($sql);
  $myrow = mysql_fetch_array($result);
  if ($myrow["count"] == "0") {
    $sql = "INSERT INTO software_register (software_title) VALUES ('" . $_GET['package'] . "')"; 
    $result = mysql_query($sql);
  } else {} 
  header("Location: software_register.php?pc=");
  } else {

  include "include.php"; 
  echo "<div class=\"main_each\"><p class=\"contenthead\">Add Package to Software License Register.</p>";
  $SQL = "SELECT count(software_name), software_name from software WHERE software_name NOT LIKE '%hotfix%' group by software_name ORDER BY software_name";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\">";
    echo "<tr><td>Count</td><td>Package Name</td><td align=\"center\">Click to Add</td></tr>";
    do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo "<tr bgcolor=\"" . $bgcolor . "\">";
      echo "<td align=\"center\">" . $myrow["count(software_name)"] . "</td>";
      echo "<td>&nbsp;&nbsp;" . $myrow["software_name"] . "</td>";
      echo "<td align=\"center\"><a href=\"software_register_add.php?package=" . url_clean($myrow["software_name"]) . "\"><img border=\"0\" src=\"images/button_ok.png\" width=\"16\" height=\"16\" alt=\"\" /></a></td>";
      echo "</tr>";
    } while ($myrow = mysql_fetch_array($result));
  } else {
    echo "No Software in database.";
  }
?>
</table>
</div>
</div>
</body>
</html> 
<?php 
include "include_png_replace.php";
} 
?>