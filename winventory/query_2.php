<?php 
$page = "";
$extra = "";
$software = "";
if (isset($_GET['software'])) {$software = $_GET['software'];} else {}
include "include.php"; 
$bgcolor = "#FFFFFF";
?>
<html>
<head>
<title>Windows Inventory - Query Page</title>
</head>
<body>
<?php
echo "<div class=\"main_each\">";

if (($_GET["form"] == "1") AND ($_POST["type"] == "software")) {
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
  echo "<tr><td>&nbsp;&nbsp;IP Address</td><td>&nbsp;&nbsp;Name</td><td>&nbsp;&nbsp;Software</td><td>&nbsp;&nbsp;Description</td></tr>";
  if ($_POST["like"] == "like") {
  $SQL = "SELECT sw.software_name, sys.system_name, sys.system_uuid, sys.system_description, sys.net_ip_address from software sw, system sys WHERE software_name LIKE '%" . $_POST["search"] . "%' AND sw.software_uuid = sys.system_uuid AND sw.software_timestamp = sys.system_timestamp ORDER BY software_name, system_name";
  echo "<p class=\"contenthead\">List Systems with \"" . $_POST["search"] . "\" software installed.</p><p>";
  } else {}
  if ($_POST["like"] == "not") {
  $SQL = "SELECT sw.software_name, sys.system_name, sys.system_uuid, sys.system_description, sys.net_ip_address from software sw, system sys WHERE software_name NOT LIKE '%" . $_POST["search"] . "%' AND sw.software_uuid = sys.system_uuid AND sw.software_timestamp <> sys.system_timestamp ORDER BY software_name, system_name";
echo $SQL;
  echo "<p class=\"contenthead\">List Systems without \"" . $_POST["search"] . "\" software installed.</p><p>";
  } else {}
  if ($_POST["like"] == "had") {
  $SQL = "SELECT sw.software_name, sw.software_timestamp, sys.system_name, sys.system_uuid, sys.system_description, sys.net_ip_address from software sw, system sys WHERE software_name LIKE '%" . $_POST["search"] . "%' AND sw.software_uuid = sys.system_uuid AND sw.software_timestamp <> sys.system_timestamp ORDER BY software_name, system_name";
  echo "<p class=\"contenthead\">List Systems without \"" . $_POST["search"] . "\" software installed.</p><p>";
  } else {}
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    do {
	    echo "<tr bgcolor=\"" . $bgcolor . "\">";
		echo "<td>" . $myrow["net_ip_address"] . "</td>";
		echo "<td><a href=\"system_summary.php?pc=" . $myrow["system_uuid"] . "&sub=all\" class=\"content\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;</td>";
		echo "<td>" . $myrow["software_name"] . "</td>";
		echo "</tr>";
        if ($bgcolor == "#F1F1F1") {
          $bgcolor = "#FFFFFF"; }
        else { $bgcolor = "#F1F1F1"; }
    } while ($myrow = mysql_fetch_array($result));
	$num_rows = mysql_num_rows($result);
    echo "<tr><td><b>Rows returned: " . $num_rows . "</b></td></tr>";
  } else {}
} else {}


if (($_GET["form"] == "1") AND ($_POST["type"] == "service")) {
  if ($_POST["like"] == "like") {
  $SQL = "SELECT sw.service_display_name, sys.system_name, sys.system_uuid, sys.system_description, sys.net_ip_address from service sw, system sys WHERE service_display_name LIKE '%" . $_POST["search"] . "%' AND sw.service_uuid = sys.system_uuid AND sw.service_timestamp = sys.system_timestamp ORDER BY service_display_name, system_name";
  echo "<p class=\"contenthead\">PCs that have \"" . $_POST["search"] . "\" service installed.</p><p>";
  } else {
  $SQL = "SELECT sw.service_display_name, sys.system_name, sys.system_uuid, sys.system_description, sys.net_ip_address from service sw, system sys WHERE service_display_name LIKE '%" . $_POST["search"] . "%' AND sw.service_uuid = sys.system_uuid AND sw.service_timestamp <> sys.system_timestamp ORDER BY service_display_name, system_name";
  echo "<p class=\"contenthead\">PCs that do not have \"" . $_POST["search"] . "\" service installed.</p><p>";
  }
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
	echo "<tr><td>&nbsp;&nbsp;IP Address</td><td>&nbsp;&nbsp;Name</td><td>&nbsp;&nbsp;Software</td><td>&nbsp;&nbsp;Description</td></tr>";
    do {
	    echo "<tr bgcolor=\"" . $bgcolor . "\">";
		echo "<td>" . $myrow["net_ip_address"] . "</td>";
		echo "<td><a href=\"system_summary.php?pc=" . $myrow["system_uuid"] . "&sub=all\" class=\"content\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;</td>";
		echo "<td>" . $myrow["service_display_name"] . "</td>";
		echo "<td>" . $myrow["system_description"] . "</td>";
		echo "</tr>";
    } while ($myrow = mysql_fetch_array($result));
	$num_rows = mysql_num_rows($result);
    echo "<tr><td><b>Rows returned: " . $num_rows . "</b></td></tr>";
  } else {}
} else {}



if (($_GET["form"] == "1") AND ($_POST["type"] == "startup")) {
  if ($_POST["like"] == "like") {
  $SQL = "SELECT sw.startup_caption, sys.system_name, sys.system_uuid, sys.system_description, sys.net_ip_address from startup sw, system sys WHERE startup_caption LIKE '%" . $_POST["search"] . "%' AND sw.startup_uuid = sys.system_uuid AND sw.startup_timestamp = sys.system_timestamp ORDER BY startup_caption, system_name";
  echo "<p class=\"contenthead\">PCs that have \"" . $_POST["search"] . "\" startup program.</p><p>";
  } else {
  $SQL = "SELECT sw.startup_caption, sys.system_name, sys.system_uuid, sys.system_description, sys.net_ip_address from startup sw, system sys WHERE startup_caption LIKE '%" . $_POST["search"] . "%' AND sw.startup_uuid = sys.system_uuid AND sw.startup_timestamp <> sys.system_timestamp ORDER BY startup_caption, system_name";
  echo "<p class=\"contenthead\">PCs that do not have \"" . $_POST["search"] . "\" startup program.</p><p>";
  }
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"content\">";
	echo "<tr><td>&nbsp;&nbsp;IP Address</td><td>&nbsp;&nbsp;Name</td><td>&nbsp;&nbsp;Software</td><td>&nbsp;&nbsp;Description</td></tr>";
    do {
	    echo "<tr bgcolor=\"" . $bgcolor . "\">";
		echo "<td>" . $myrow["net_ip_address"] . "</td>";
		echo "<td><a href=\"system_summary.php?pc=" . $myrow["system_uuid"] . "&sub=all\" class=\"content\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;</td>";
		echo "<td>" . $myrow["startup_caption"] . "</td>";
		echo "<td>" . $myrow["system_description"] . "</td>";
		echo "</tr>";
    } while ($myrow = mysql_fetch_array($result));
	$num_rows = mysql_num_rows($result);
    echo "<tr><td><b>Rows returned: " . $num_rows . "</b></td></tr>";
  } else {}
} else {}



if ($_GET["form"] == "2") {
  $order = "";
  if ($_POST["equipment"] == "system WHERE net_ip_address") { 
    $order = "net_ip_address"; 
	$heading1 = "IP Address";
	$heading2 = "";
    $SQL = "SELECT * from " . $_POST["equipment"] . " " . $_POST["is"] . " '" . $_POST["search"] . "' ORDER BY " . $order; }

  if ($_POST["equipment"] == "net_wins_primary") { 
    $order = "sys.system_name";
	$heading1 = "IP Address";
	$heading2 = "WINS Address";
    $SQL = "SELECT sys.net_mac_address, sys.system_name, sys.net_ip_address, sys.system_memory, net.net_wins_primary from system sys, network_card net WHERE sys.net_mac_address = net.net_mac_linked AND net.net_wins_primary " . $_POST["is"] . " '" . $_POST['search'] . "' ORDER BY " . $order; }

  if ($_POST["equipment"] == "net_dns_server") {
    $order = "sys.system_name";
	$heading1 = "IP Address";
	$heading2 = "DNS Server";
    $SQL = "SELECT sys.net_mac_address, sys.system_name, sys.net_ip_address, sys.system_memory, net.net_dns_server from system sys, network_card net WHERE sys.net_mac_address = net.net_mac_linked AND net.net_dns_server " . $_POST["is"] . " '" . $_POST['search'] . "' ORDER BY " . $order; }
 
  if ($_POST["equipment"] == "processor WHERE processor_max_clock_speed") { 
    $order = "processor_max_clock_speed"; 
	$heading1 = "Processor";
	$heading2 = "Processor Speed";
    $SQL = "SELECT * from " . $_POST["equipment"] . " " . $_POST["is"] . " '" . $_POST["search"] . "' ORDER BY " . $order; }

  if ($_POST["equipment"] == "hard_drive WHERE hard_drive_size") { 
    $order = "hard_drive_mac_address"; 
	$heading1 = "Partitions";
	$heading2 = "Size";
    $SQL = "SELECT * from " . $_POST["equipment"] . " " . $_POST["is"] . " '" . $_POST["search"] . "' ORDER BY " . $order; }

  if ($_POST["equipment"] == "partition WHERE partition_size") { 
    $order = "partition_size"; 
	$heading1 = "Partition Letter - Name";
	$heading2 = "Partition Size";
    $SQL = "SELECT * from " . $_POST["equipment"] . " " . $_POST["is"] . " '" . $_POST["search"] . "' ORDER BY " . $order; }
	
  if ($_POST["equipment"] == "Video Adapter RAM") { 
    $order = "video_mac_address"; 
	$heading1 = "Video Card";
	$heading2 = "Video Memory";
    $SQL = "SELECT * from " . $_POST["equipment"] . " " . $_POST["is"] . " '" . $_POST["search"] . "' ORDER BY " . $order; }
	
  if ($_POST["equipment"] == "system WHERE system_num_processors") { 
    $order = "system_name"; 
	$heading1 = "IP Address";
	$heading2 = "# Processors";
    $SQL = "SELECT * from " . $_POST["equipment"] . " " . $_POST["is"] . " '" . $_POST["search"] . "' ORDER BY " . $order; }
	
  if ($_POST["equipment"] == "system WHERE system_memory") { 
    $order = "system_memory"; 
	$heading1 = "IP Address";
	$heading2 = "Memory";
    $SQL = "SELECT * from " . $_POST["equipment"] . " " . $_POST["is"] . " '" . $_POST["search"] . "' ORDER BY " . $order; }

  echo "<table border=0 cellpadding=0 cellspacing=0 class=\"content\" width=\"700\">";
  echo "<tr><td><b>System Name</b></td><td><b>" . $heading1 . "</b></td><td><b>" . $heading2 . "</b></td></tr>";
  $system_name_old = "";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    do {
      if ($_POST["equipment"] == "system WHERE net_ip_address") {
        $system_name = "<a href=\"system_summary.php?pc=" . $myrow["net_mac_address"] . "&sub=all\">" . $myrow["system_name"] . "</a>"; 
        $option1 = ip_trans($myrow["net_ip_address"]); 
		$option2 = ""; }

  	  if ($_POST["equipment"] == "net_wins_primary") {
        $system_name = "<a href=\"system_summary.php?pc=" . $myrow["net_mac_address"] . "&sub=all\">" . $myrow["system_name"] . "</a>"; 
        $option1 = ip_trans($myrow["net_ip_address"]); 
		$option2 = ip_trans($myrow["net_wins_primary"]); }

	  if ($_POST["equipment"] == "net_dns_server") {
        $system_name = "<a href=\"system_summary.php?pc=" . $myrow["net_mac_address"] . "&sub=all\">" . $myrow["system_name"] . "</a>"; 
        $option1 = ip_trans($myrow["net_ip_address"]); 
		$option2 = ip_trans($myrow["net_dns_server"]); }

      if ($_POST["equipment"] == "system WHERE system_num_processors") {
        $system_name = "<a href=\"system_summary.php?pc=" . $myrow["net_mac_address"] . "&sub=all\">" . $myrow["system_name"] . "</a>"; 
        $option1 = ip_trans($myrow["net_ip_address"]);
        $option2 = $myrow["system_num_processors"]; }

      if ($_POST["equipment"] == "processor WHERE processor_max_clock_speed") {
        $SQL2 = "select * from system where net_mac_address = '" . $myrow["processor_mac_address"] . "'"; 
        $result2 = mysql_query($SQL2, $db);
        $myrow2 = mysql_fetch_array($result2);
        $option1 = $myrow["processor_name"];
		$option2 = $myrow["processor_max_clock_speed"] . " Mhz"; 
        $system_name = "<a href=\"system_summary.php?pc=" . $myrow2["net_mac_address"] . "&sub=all\">" . $myrow2["system_name"] . "</a>"; } 

      if ($_POST["equipment"] == "hard_drive WHERE hard_drive_size") {
        $SQL2 = "select * from system where net_mac_address = '" . $myrow["hard_drive_mac_address"] . "'"; 
        $result2 = mysql_query($SQL2, $db);
        $myrow2 = mysql_fetch_array($result2);
        $option1 = $myrow["hard_drive_partitions"];
        $option2 = number_format($myrow["hard_drive_size"]) . " MB"; 
        $system_name = "<a href=\"system_summary.php?pc=" . $myrow2["net_mac_address"] . "&sub=all\">" . $myrow2["system_name"] . "</a>"; }

      if ($_POST["equipment"] == "partition WHERE partition_size") {
        $SQL2 = "select * from system where net_mac_address = '" . $myrow["partition_mac_address"] . "'"; 
        $result2 = mysql_query($SQL2, $db);
        $myrow2 = mysql_fetch_array($result2);
        $option1 = $myrow["partition_caption"] . " - " . $myrow["partition_volume_name"];
		$option2 = number_format($myrow["partition_size"]) . " MB"; 
        $system_name = "<a href=\"system_summary.php?pc=" . $myrow2["net_mac_address"] . "&sub=all\">" . $myrow2["system_name"] . "</a>"; }

      if ($_POST["equipment"] == "system WHERE system_memory") {
        $system_name = "<a href=\"system_summary.php?pc=" . $myrow["net_mac_address"] . "&sub=all\">" . $myrow["system_name"] . "</a>"; 
        $option1 = $myrow["system_memory"];
        $option2 = ""; }
		
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
	  
      echo "<tr bgcolor=\"" . $bgcolor . "\">";
      echo "<td>" . $system_name . "</td><td>" . $option1 . "</td><td>" . $option2 . "</td>";
	  echo "</tr>";
    } while ($myrow = mysql_fetch_array($result));
	$num_rows = mysql_num_rows($result);
    echo "<tr><td><b>Rows returned: " . $num_rows . "</b></td></tr>";
    echo "</table>";
  } else { echo "No matching results."; }
} else {}


if ($_GET["form"] == "3") {

    if ($_POST["equipment"] == "system WHERE system_service_pack") {
    $order = "system_name";
    $title = "Systems where system service pack is like '" . $_POST["search"] . "'."; }

	if ($_POST["equipment"] == "system WHERE system_primary_owner_name") { 
	$order = "system_primary_owner_name";
	$title = "Systems where Registered Owner is like '" . $_POST["search"] . "'."; }

	if ($_POST["equipment"] == "system WHERE system_name") { 
	$order = "system_name"; 
	$title = "Systems where System Name is like '" . $_POST["search"] . "'."; }

	if ($_POST["equipment"] == "system WHERE net_user_name") { 
	$order = "net_user_name"; 
	$title = "Systems where User Name is like '" . $_POST["search"] . "'."; }

	$SQL = "SELECT * from " . $_POST["equipment"] . " " . $_POST["is"] . " '%" . $_POST["search"] . "%' ORDER BY " . $order;
	$result = mysql_query($SQL, $db);
	echo "<table border=0 cellpadding=0 cellspacing=0 class=\"content\">";
        echo "<tr><td class=\"contenthead\">" . $title . "<br>&nbsp;</td><tr>";
	echo "</table>";
	echo "<table border=0 cellpadding=0 cellspacing=0 class=\"content\">";
	echo "<td width=25%><b>IP Address</b></td><td width=25%><b>Registered User</b></td><td width=25%><b>System Name</b></td><td width=25%><b>Logged On User</b></td></tr>";
	  if ($myrow = mysql_fetch_array($result)){
	  do{
      echo "<tr><td bgcolor=\"" . $bgcolor . "\">" . $myrow["net_ip_address"] . "</td><td bgcolor=\"" . $bgcolor . "\"><a href=\"system_summary.php?pc=" . $myrow["net_mac_address"] . "&sub=all\">" . $myrow["system_primary_owner_name"] . "</a></td><td bgcolor=\"" . $bgcolor . "\">" . $myrow["system_name"] . "</td><td bgcolor=\"" . $bgcolor . "\">" . $myrow["net_user_name"] . "</td></tr>";
      if ($bgcolor == "#FFFFFF") {$bgcolor = "#F1F1F1"; } 
      else { $bgcolor = "#FFFFFF"; }
	    } while ($myrow = mysql_fetch_array($result));
	$num_rows = mysql_num_rows($result);
    echo "<tr><td><b>Rows returned: " . $num_rows . "</b></td></tr>";
    echo "</table>";
	}else{ echo "No matching results.";}
} else {}


?>
</div>
</body>

</html>
