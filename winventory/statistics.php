<?php 
$page = "stats";
include "include.php"; 

$query ="SELECT * FROM system";
 $result = mysql_query($query);
 $total_pcs = mysql_numrows($result);

echo "<div class=\"main_each\">";
echo "<p class=\"contenthead\">Statistics.</p>";
if ($sub == "s1" or $sub == "s2"){
  $SQL = "select distinct system_os_name from system";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
    echo "<tr class=\"menuhead\"><td width=\"60%\">Operating System</td><td width=\"20%\" align=\"right\">Number</td><td width=\"20%\" align=\"right\">Percentage</td></tr>";
    do {
      $SQL2 = "SELECT system_uuid, system_os_name, MAX(system_timestamp) FROM system WHERE system_os_name = '" . $myrow["system_os_name"] . "' GROUP BY system_uuid";
      $result2 = mysql_query($SQL2, $db);
      $percent = round(((mysql_num_rows($result2) / $total_pcs) * 100),2);
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
      echo "<td align=\"left\"><a href=\"statistics.php?sub=s12&amp;os=" . url_clean($myrow["system_os_name"]) . "\">" . $myrow["system_os_name"] . "</a></td>\n";
      echo "<td align=\"right\">" . mysql_num_rows($result2) . "&nbsp;&nbsp;&nbsp;&nbsp;</td><td align=\"right\">" . $percent . "&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
      echo "</tr>";
    } while ($myrow = mysql_fetch_array($result));
  }
  else{ echo"<p class=\"contenthead\">Operating Systems</p><p>No Operating Systems have been detected.</p>\n";}
echo "</table>";
echo "<br />";
} else {}



if ($sub == "s1" or $sub == "s3"){
  $SQL = "SELECT DISTINCT software_version FROM software WHERE software_name = 'Internet Explorer' order by software_version ASC";
  $results = mysql_query($SQL, $db) or die("Error performing query");
  if(mysql_num_rows($results) > 0){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr class=\"menuhead\"><td width=\"60%\">Internet Explorer Versions</td><td width=\"20%\" align=\"right\">Number</td><td width=\"20%\" align=\"right\">Percentage</td></tr>\n";
    while($row = mysql_fetch_object($results)){
      $SQL2 = "select * from software WHERE software_version = '" . $row->software_version . "' AND software_name = 'Internet Explorer' ";
      $results2 = mysql_query($SQL2, $db) or die("Error performing query");
      $percent = round(((mysql_num_rows($results2) / $total_pcs) * 100),2);
      if ($row->software_version == NULL) {} else {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
        echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
		echo "<td align=\"left\"><a href=\"statistics.php?sub=s13&amp;sort=net_ip_address&amp;ie=" . $row->software_version . "\">" . $row->software_version . "</a></td><td align=\"right\">" . mysql_num_rows($results2) . "&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
		echo "<td align=\"right\">" . $percent . "&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
		echo "</tr>";
      }
    }
  }
  else{ echo"<p class=\"contenthead\">Internet Explorer Versions</p><p>No IE Versions detected.</p>\n";}
echo "</table>";
echo "<br />";
} else {}



if ($sub == "s1" or $sub == "s4"){
  $SQL = "select distinct system_memory from system order by system_memory ASC";
  $results = mysql_query($SQL, $db) or die("Error performing query");
  if(mysql_num_rows($results) > 0){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr class=\"menuhead\"><td width=\"60%\">Physical Memory</td><td width=\"20%\" align=\"right\">Number</td><td width=\"20%\" align=\"right\">Percentage</td></tr>\n";
    while($row = mysql_fetch_object($results)){
      $SQL2 = "select * from system WHERE system_memory = '" . $row->system_memory . "'";
      $results2 = mysql_query($SQL2, $db) or die("Error performing query");
      $percent = round(((mysql_num_rows($results2) / $total_pcs) * 100),2);
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	  echo "<td align=\"left\"><a href=\"statistics.php?sub=s14&amp;mem=" . $row->system_memory . "&amp;sort=net_ip_address\">" . $row->system_memory . "</a></td>\n";
	  echo "<td align=\"right\">" . mysql_num_rows($results2) . "&nbsp;&nbsp;&nbsp;&nbsp;</td><td align=\"right\">" . $percent . "&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
	  echo "</tr>\n";
    }
  }
  else{ echo"<p class=\"contenthead\">Total Memory per System</p><p>No memory detected.</p>";}
echo "</table>";
echo "<br />";
} else {}



if ($sub == "s1" or $sub == "s5"){
  $total_percent = 0;
  $query ="SELECT * FROM processor";
  $result = mysql_query($query);
  $total_processors = mysql_numrows($result);
  $SQL = "select distinct processor_name from processor order by processor_name ASC";
  $results = mysql_query($SQL, $db) or die("Error performing query");
  if(mysql_num_rows($results) > 0){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
    echo "<tr class=\"menuhead\"><td width=\"60%\">Processor</td><td width=\"20%\" align=\"right\">Number</td><td width=\"20%\" align=\"right\">Percentage</td></tr>\n";
    while($row = mysql_fetch_object($results)){
      $SQL2 = "select * from processor WHERE processor_name = '" . $row->processor_name . "'";
      $results2 = mysql_query($SQL2, $db) or die("Error performing query");
      $percent = round(((mysql_num_rows($results2) / $total_processors ) * 100),2);
	  $total_percent = $total_percent + $percent;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	  echo "<td align=\"left\"><a href=\"statistics.php?sub=s15&amp;proc=" . url_clean($row->processor_name) . "&amp;sort=net_ip_address\">" . $row->processor_name . "</a></td>\n";
	  echo "<td align=\"right\">" . mysql_num_rows($results2) . "&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
	  echo "<td align=\"right\">" . $percent . "&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
	  echo "</tr>\n";
    }
  } else { 
    echo"<p class=\"contenthead\">Processor Type</p><p>No Processors in database.</p>\n";
  }
  echo "<tr>\n";
  echo "<td align=\"left\">Total Processors</td>\n";
  echo "<td align=\"right\">" . $total_processors . "&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
  echo "<td align=\"right\">" . $total_percent . "&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
  echo "</tr>\n";
  echo "<tr>\n";
  echo "<td align=\"left\">Total Systems</td>\n";
  echo "<td align=\"right\">" . $total_pcs . "&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
  echo "<td align=\"right\">&nbsp;</td>\n";
  echo "</tr>\n";
  echo "</table>\n";
  echo "<br />";
} else {}



if ($sub == "s1" or $sub == "s6"){
  $total_percent = 0;
  $query ="SELECT * FROM hard_drive";
  $result = mysql_query($query);
  $total_hd = mysql_numrows($result);
  $SQL = "select distinct hard_drive_size from hard_drive order by hard_drive_size ASC";
  $results = mysql_query($SQL, $db) or die("Error performing query");
  if(mysql_num_rows($results) > 0){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
    echo "<tr class=\"menuhead\"><td width=\"60%\">Hard Drive Size</td><td width=\"20%\" align=\"right\">Number</td><td width=\"20%\" align=\"right\">Percentage</td></tr>\n";
    while($row = mysql_fetch_object($results)){
      $SQL2 = "select * from hard_drive WHERE hard_drive_size = '" . $row->hard_drive_size . "'";
      $results2 = mysql_query($SQL2, $db) or die("Error performing query");
      $percent = round(((mysql_num_rows($results2) / $total_hd) * 100),2);
	  $total_percent = $total_percent + $percent;
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo "<tr bgcolor=\"" . $bgcolor . "\">\n";
	  echo "<td align=\"left\"><a href=\"statistics.php?sub=s16&amp;hd=" . $row->hard_drive_size . "&amp;sort=net_ip_address\">" . $row->hard_drive_size . "</a></td>\n";
	  echo "<td align=\"right\">" . mysql_num_rows($results2) . "&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
	  echo "<td align=\"right\">" . $percent . "&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
	  echo "</tr>\n"; 
	}
  } else { 
    echo"<p class=\"contenthead\">Hard Disks</p><p>No Hard Disks in database.</p>\n";
    echo "</table>";
  }
  echo "<tr>\n";
  echo "<td align=\"left\">Total</td>\n";
  echo "<td align=\"right\">" . $total_hd . "&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
  echo "<td align=\"right\">" . $total_percent . "&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
  echo "</tr>\n";
  echo "<tr>\n";
  echo "<td align=\"left\">Total Systems</td>\n";
  echo "<td align=\"right\">" . $total_pcs . "&nbsp;&nbsp;&nbsp;&nbsp;</td>\n";
  echo "<td align=\"right\">&nbsp;</td>\n";
  echo "</tr>\n";
} 




if ($sub == "s12") {
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
  $bgcolor = "#FFFFFF";
  $SQL = "SELECT system_uuid, system_name, net_domain, system_os_name, MAX(system_timestamp), net_ip_address FROM system WHERE system_os_name = '" . $_GET["os"] . "' GROUP BY system_uuid ORDER BY " . $sort;
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<tr><td colspan=\"4\" class=\"menuhead\">List Systems with " . $_GET["os"] . "</td></tr>\n";
    echo "<tr>";
    echo "<td align=\"center\"><a href=\"statistics.php?sub=s12&amp;os=" . $_GET["os"] . "&amp;sort=net_ip_address\">IP Address</a></td>\n";
    echo "<td align=\"center\"><a href=\"statistics.php?sub=s12&amp;os=" . $_GET["os"] . "&amp;sort=system_name\">Name</a></td>\n";
    echo "<td align=\"center\"><a href=\"statistics.php?sub=s12&amp;os=" . $_GET["os"] . "&amp;sort=date_audited\">Date Audited</a></td>\n";
    echo "<td align=\"center\"><a href=\"statistics.php?sub=s12&amp;os=" . $_GET["os"] . "&amp;sort=net_domain\">&nbsp;Domain&nbsp;</a></td>\n";
    echo "</tr>\n";
    do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo "<tr>";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . ip_trans($myrow["net_ip_address"]) . "&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;<a href=\"system_summary.php?pc=" . $myrow["system_uuid"] . "&amp;sub=all\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . return_date($myrow["MAX(system_timestamp)"]) . "&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow["net_domain"] . "&nbsp;&nbsp;</td></tr>\n";
    } while ($myrow = mysql_fetch_array($result));
    echo "<tr><td colspan=\"3\"><b>Total Computers: " . mysql_num_rows($result)  . "</b></td></tr>";
    echo "</table>";
  } 
  else {
    echo "<p class=\"menuhead\">List Systems with " . $_GET["os"] . "</p><p>No systems have been audited.</p>\n";
    echo "</table>";
  }
} else {}






if ($sub == "s13") {
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
  $bgcolor = "#FFFFFF";
  $SQL = "SELECT * FROM system WHERE version_ie = '" . $_GET["ie"] . "' ORDER BY " . $sort;
  $SQL = "SELECT sw.software_uuid, sys.system_uuid, sys.system_name, sys.net_ip_address, sys.system_timestamp, sys.net_domain FROM software sw, system sys WHERE sw.software_name = 'Internet Explorer' AND sw.software_version = '" . $_GET["ie"] . "' AND sw.software_uuid = sys.system_uuid  ORDER BY " . $sort;;
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<tr><td class=\"menuhead\" colspan=\"4\">List Systems with IE Version " . $_GET["ie"] . "</td></tr>\n";
    echo "<tr>\n";
    echo "<td align=\"center\"><a href=\"statistics.php?sub=s13&amp;ie=" . $_GET["ie"] . "&amp;sort=net_ip_address\">IP Address</a></td>\n";
    echo "<td align=\"center\"><a href=\"statistics.php?sub=s13&amp;ie=" . $_GET["ie"] . "&amp;sort=system_name\">Name</a></td>\n";
    echo "<td align=\"center\"><a href=\"statistics.php?sub=s13&amp;ie=" . $_GET["ie"] . "&amp;sort=system_timestamp\">Date Audited</a></td>\n";
    echo "<td align=\"center\"><a href=\"statistics.php?sub=s13&amp;ie=" . $_GET["ie"] . "&amp;sort=net_domain\">&nbsp;Domain&nbsp;</a></td>\n";
    echo "</tr>\n";
    do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }

      echo "<tr>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . ip_trans($myrow["net_ip_address"]) . "&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;<a href=\"system_summary.php?pc=" . $myrow["system_uuid"] . "&amp;sub=all\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . return_date_time($myrow["system_timestamp"]) . "&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow["net_domain"] . "&nbsp;&nbsp;</td></tr>\n";
    } while ($myrow = mysql_fetch_array($result));

    echo "<tr><td colspan=\"3\"><b>Total Computers: " . mysql_num_rows($result)  . "</b></td></tr>\n";
    echo "</table>\n";
  } 
  else {
    echo "No systems have been audited.</p>\n";
    echo "</table>";
  }
} else {}





if ($sub == "s14") {
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
  $bgcolor = "#FFFFFF";
  $SQL = "SELECT * FROM system WHERE system_memory = '" . $_GET["mem"] . "' ORDER BY " . $sort;
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<tr><td colspan=\"4\" class=\"menuhead\">List Systems with " . $_GET["mem"] . "MB memory.</td></tr>\n";
    echo "<tr>";
    echo "<td align=\"center\"><a href=\"statistics.php?sub=s14&amp;mem=" . $_GET["mem"] . "&amp;sort=net_ip_address\">IP Address</a></td>\n";
    echo "<td align=\"center\"><a href=\"statistics.php?sub=s14&amp;mem=" . $_GET["mem"] . "&amp;sort=system_name\">Name</a></td>\n";
    echo "<td align=\"center\"><a href=\"statistics.php?sub=s14&amp;mem=" . $_GET["mem"] . "&amp;sort=system_timestamp\">Date Audited</a></td>\n";
    echo "<td align=\"center\"><a href=\"statistics.php?sub=s14&amp;mem=" . $_GET["mem"] . "&amp;sort=net_domain\">&nbsp;Domain&nbsp;</a></td>\n";
    echo "</tr>\n";
    do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo "<tr>";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . ip_trans($myrow["net_ip_address"]) . "&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;<a href=\"system_summary.php?pc=" . $myrow["system_uuid"] . "&amp;sub=all\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . return_date_time($myrow["system_timestamp"]) . "&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow["net_domain"] . "&nbsp;&nbsp;</td></tr>\n";
    } while ($myrow = mysql_fetch_array($result));
    echo "<tr><td colspan=\"3\"><b>Total Computers: " . mysql_num_rows($result)  . "</b></td></tr>\n";
    echo "</table>\n";
  } 
  else {
    echo "<p class=\"content\">No PCs have been WINventoried.</p>\n";
    echo "</table>\n";
  }
} else {}




if ($sub == "s15") {
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">\n";
  $bgcolor = "#FFFFFF";
  $SQL = "select sys.system_timestamp, sys.net_domain, sys.system_uuid, sys.net_ip_address, sys.system_name, pro.processor_name from processor pro, system sys where pro.processor_name = '" . $_GET["proc"] . "' and pro.processor_uuid = sys.system_uuid";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<tr><td colspan=\"4\" class=\"menuhead\">List Systems with " . $_GET["proc"] . " processor.</td></tr>\n";
    echo "<tr>\n";
    echo "<td align=\"center\"><a href=\"statistics.php?sub=s15&amp;proc=" . $_GET["proc"] . "&amp;sort=net_ip_address\">IP Address</a></td>\n";
    echo "<td align=\"center\"><a href=\"statistics.php?sub=s15&amp;proc=" . $_GET["proc"] . "&amp;sort=sys.system_name\">Name</a></td>\n";
    echo "<td align=\"center\"><a href=\"statistics.php?sub=s15&amp;proc=" . $_GET["proc"] . "&amp;sort=system_timestamp\">Date Audited</a></td>\n";
    echo "<td align=\"center\"><a href=\"statistics.php?sub=s15&amp;proc=" . $_GET["proc"] . "&amp;sort=net_domain\">&nbsp;Domain&nbsp;</a></td>\n";
    echo "</tr>\n";
    do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }

      echo "<tr>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . ip_trans($myrow["net_ip_address"]) . "&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;<a href=\"system_summary.php?pc=" . $myrow["system_uuid"] . "&amp;sub=all\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . return_date_time($myrow["system_timestamp"]) . "&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow["net_domain"] . "&nbsp;&nbsp;</td></tr>\n";
    } while ($myrow = mysql_fetch_array($result));

    echo "<tr><td colspan=\"3\"><b>Total Computers: " . mysql_num_rows($result)  . "</b></td></tr>";
    echo "</table>";
  } 
  else {
    echo "<p class=\"content\">No PCs have been WINventoried.</p>\n";
    echo "</table>\n";
  }
} else {}


if ($sub == "s16") {
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
  $bgcolor = "#FFFFFF";
  $sort = "";
  $SQL = "select sys.system_timestamp, sys.net_domain, sys.system_uuid, sys.net_ip_address, sys.system_name, hd.hard_drive_size from hard_drive hd, system sys where hd.hard_drive_size = '" . $_GET["hd"] . "' and hd.hard_drive_uuid = sys.system_uuid";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<tr><td colspan=\"4\" class=\"menuhead\">List Systems with " . $_GET["hd"] . " MB size hard drives.</td></tr>\n";
    echo "<tr>\n";
    echo "<td align=\"center\" width=\"200\"><a href=\"statistics.php?sub=s16&amp;hd=" . $_GET["hd"] . "&amp;sort=net_ip_address\">IP Address</a></td>\n";
    echo "<td align=\"center\"><a href=\"statistics.php?sub=s16&amp;hd=" . $_GET["hd"] . "&amp;sort=sys.system_name\">Name</a></td>\n";
    echo "<td align=\"center\"><a href=\"statistics.php?sub=s16&amp;hd=" . $_GET["hd"] . "&amp;sort=system_timestamp\">Date Audited</a></td>\n";
    echo "<td align=\"center\"><a href=\"statistics.php?sub=s16&amp;hd=" . $_GET["hd"] . "&amp;sort=net_domain\">&nbsp;Domain&nbsp;</a></td>\n";
    echo "</tr>\n";
    do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo "<tr>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">" . ip_trans($myrow["net_ip_address"]) . "&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\"><a href=\"system_summary.php?pc=" . $myrow["system_uuid"] . "&amp;sub=all\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . return_date_time($myrow["system_timestamp"]) . "&nbsp;&nbsp;</td>\n";
      echo "<td align=\"center\" bgcolor=\"" . $bgcolor . "\">&nbsp;&nbsp;" . $myrow["net_domain"] . "&nbsp;&nbsp;</td></tr>\n";
    } while ($myrow = mysql_fetch_array($result));
    echo "<tr><td colspan=\"3\"><b>Total Computers: " . mysql_num_rows($result)  . "</b></td></tr>\n";
    echo "</table>\n";
  } 
  else {
    echo "<p class=\"content\">No PCs have been WINventoried.</p>\n";
    echo "</table>\n";
  }
} else {}
?>

</div>
</body>
</html> 
