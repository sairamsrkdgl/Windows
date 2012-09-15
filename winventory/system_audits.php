<?php 
$page = "os";
include "include.php"; 

echo "<div class=\"main_each\">";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"content\" width=\"100%\">";
echo "<tr>";
echo "<td align=\"left\" class=\"contenthead\">System Audits performed on " . $name . "<br />&nbsp;</td>";
echo "</tr>";


if (($sub == "su") or ($sub == "all")){
  $opt_count = 0;
  $SQL = "SELECT * FROM system_audits WHERE system_audits_uuid = '$pc'";
  //echo $SQL;
  $result = mysql_query($SQL, $db);
  echo "<tr><td class=\"contenthead\"><img src=\"images/inv_summary$pic_style.png\" width=\"64\" height=\"64\" alt=\"\" />Audits</td></tr>\n";
  echo "<tr><td>Timestamp</td><td>Performed By</td></tr>\n";
  if ($myrow = mysql_fetch_array($result)){
    do {
	  if ($bgcolor == "#F1F1F1") {
		$bgcolor = "#FFFFFF"; }
	  else { $bgcolor = "#F1F1F1"; }
      echo "<tr bgcolor=\"$bgcolor\"><td>" . return_date_time($myrow["system_audits_timestamp"]) . "</td><td>" . $myrow["system_audits_username"] . "</td></tr>\n";
	} while ($myrow = mysql_fetch_array($result));
  } else {}
} else {}

echo "</table>";
?>
</div>
</div>
</body>
</html> 
<?php
include "include_png_replace.php";
?>