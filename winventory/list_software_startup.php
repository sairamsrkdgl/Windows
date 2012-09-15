<?php 
$page = "";
$extra = "";

include "include.php"; 
$bgcolor = "#FFFFFF";

if (isset($_GET["show_all"])){ $count_system = '10000'; } else {}
if (isset($_GET["page_count"])){ $page_count = $_GET["page_count"]; } else { $page_count = 0;}
$page_prev = $page_count - 1;
if ($page_prev < 0){ $page_prev = 0; } else {}
$page_next = $page_count + 1;
$page_current = $page_count;
$page_count = $page_count * $count_system;

  echo "<div class=\"main_each\"><p class=\"contenthead\">List Systems with \"" . $_GET["name"] . "\" installed.</p><p>";
  $SQL = "select sys.net_mac_address,sys.system_description,sys.net_ip_address,sys.system_name, st.startup_caption from startup st, system sys where st.startup_caption = '" . $_GET["name"] . "' and st.startup_mac_address = sys.net_mac_address";
  $result = mysql_query($SQL, $db);
  if ($myrow = mysql_fetch_array($result)){
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\" class=\"content\">";
    echo "<tr><td>&nbsp;&nbsp;IP Address</td><td>&nbsp;&nbsp;Name</td><td>&nbsp;&nbsp;Description</td></tr>";
    do {
      if ($bgcolor == "#F1F1F1") {
        $bgcolor = "#FFFFFF"; }
      else { $bgcolor = "#F1F1F1"; }
      echo "<tr bgcolor=\"" . $bgcolor . "\">";
      echo "<td>&nbsp;&nbsp;" . $myrow["net_ip_address"] . "&nbsp;&nbsp;</td><td>&nbsp;&nbsp;<a href=\"system_summary.php?pc=" . $myrow["net_mac_address"] . "\" class=\"content\">" . $myrow["system_name"] . "</a>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;" . $myrow["system_description"] . "</td>";
      echo "</tr>";
    } while ($myrow = mysql_fetch_array($result));
  } else {
    echo "No systems with this hotfix found.";
  }




?>

</p>
</div>
<?php
include "include_png_replace.php";
?>
</body>
</html> 