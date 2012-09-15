<?php 
$page = "admin";
$extra = "";
$software = "";
$count = 0;
if (isset($_GET['software'])) {$software = $_GET['software'];} else {}
if (isset($_GET['sort'])) {$sort = $_GET['sort'];} else {$sort= "net_ip_address";}
include "include.php"; 

echo "<div class=\"main_each\">\n";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" WIDTH=\"100%\" class=\"content\">\n";
echo "<tr><td colspan=\"2\" class=\"contenthead\">" . $l_acs . ".<br />&nbsp;</td></tr>\n";
echo "<tr><td colspan=\"5\"><hr /></td></tr>\n";
echo "<tr><td>" . $l_mss . ":&nbsp;</td><td>" . $mysql_server . "</td></tr>\n";
echo "<tr><td>" . $l_msu . ":&nbsp;</td><td>" . $mysql_user . "</td></tr>\n";
echo "<tr><td>" . $l_msp . ":&nbsp;</td><td>" . $mysql_password . "</td></tr>\n";
echo "<tr><td>" . $l_msd . ":&nbsp;</td><td>" . $mysql_database . "</td></tr>\n";
echo "<tr><td colspan=\"5\"><hr /></td></tr>\n";
echo "<tr><td>" . $l_upi . ":&nbsp;</td><td>\n";
  if ($use_pass == "y"){ 
    echo "<img src=\"images/button_ok.png\" border=\"0\" width=\"16\" height=\"16\" alt=\"\" />\n"; 
  } else { 
    echo "<img src=\"images/button_cancel.png\"  border=\"0\" width=\"16\" height=\"16\" alt=\"\" />\n"; 
  }
echo "</td></tr>";
$count = 0; 
while (list($key, $val) = each($users)) { 
  echo "<tr><td>&nbsp;&nbsp;" . $l_usn . ": $key &nbsp;&nbsp;Password: $val</td></tr>\n"; 
  $count = $count + 1;
}
echo "<tr><td colspan=\"5\"><hr /></td></tr>\n";
echo "<tr>\n";
echo "<td>" . $l_dod . ":&nbsp;</td>\n";  
echo "<td>";
  if ($show_other_discovered == "y"){ 
    echo "<img src=\"images/button_ok.png\" border=\"0\" width=\"16\" height=\"16\" alt=\"\" />";
  } else { 
    echo "<img src=\"images/button_cancel.png\"  border=\"0\" width=\"16\" height=\"16\" alt=\"\" />";
  }
echo "</td>\n";
echo "<td>" . $l_day . ":&nbsp;</td>\n";
echo "<td>" . $other_detected . "</td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td>" . $l_dsd . ":&nbsp;</td>\n";
echo "<td>\n";
  if ($show_system_discovered == "y"){ 
    echo "<img src=\"images/button_ok.png\" border=\"0\" width=\"16\" height=\"16\" alt=\"\" />\n";
  } else { 
    echo "<img src=\"images/button_cancel.png\"  border=\"0\" width=\"16\" height=\"16\" alt=\"\" />\n"; 
  }
echo "</td>\n";
echo "<td>" . $l_day . ":&nbsp;</td>\n";
echo "<td>" . $system_detected . "</td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td>" . $l_dns . ":&nbsp;</td>\n";
echo "<td>";
  if ($show_systems_not_audited == "y"){ 
    echo "<img src=\"images/button_ok.png\" border=\"0\" width=\"16\" height=\"16\" alt=\"\" />";
  } else { 
    echo "<img src=\"images/button_cancel.png\"  border=\"0\" width=\"16\" height=\"16\" alt=\"\" />"; 
  }
echo "</td>\n";
echo "<td>" . $l_day . ":&nbsp;</td>\n";
echo "<td>" . $days_systems_not_audited . "</td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td>" . $l_dpu . ":&nbsp;</td>\n";
echo "<td>";
  if ($show_partition_usage == "y"){ 
    echo "<img src=\"images/button_ok.png\" border=\"0\" width=\"16\" height=\"16\" alt=\"\" />";
  } else { 
    echo "<img src=\"images/button_cancel.png\"  border=\"0\" width=\"16\" height=\"16\" alt=\"\" />"; 
  }
echo "</td>\n";
echo "<td>" . $l_mby . ":&nbsp;</td>\n";
echo "<td>" . $partition_free_space . "</td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td>" . $l_dso . ":&nbsp;</td>\n";
echo "<td>";
  if ($show_software_detected == "y"){ 
    echo "<img src=\"images/button_ok.png\" border=\"0\" width=\"16\" height=\"16\" alt=\"\" />";
  } else { 
    echo "<img src=\"images/button_cancel.png\"  border=\"0\" width=\"16\" height=\"16\" alt=\"\" />"; 
  }
echo "</td>\n";
echo "<td>" . $l_day . ":&nbsp;</td>\n";
echo "<td>" . $days_software_detected . "</td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td>" . $l_dmp . ":&nbsp;</td>\n";
echo "<td>";
  if ($show_patches_not_detected == "y"){ 
    echo "<img src=\"images/button_ok.png\" border=\"0\" width=\"16\" height=\"16\" alt=\"\" />";
  } else { 
    echo "<img src=\"images/button_cancel.png\"  border=\"0\" width=\"16\" height=\"16\" alt=\"\" />";}
echo "</td>\n";
echo "<td>" . $l_day . ":&nbsp;</td>\n";
echo "<td>$number_patches_not_detected</td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td>Display 'Detected Servers' on homepage:&nbsp;</td>\n";
echo "<td>";
  if ($show_detected_servers == "y"){ 
    echo "<img src=\"images/button_ok.png\" border=\"0\" width=\"16\" height=\"16\" alt=\"\" />";
  } else { 
    echo "<img src=\"images/button_cancel.png\"  border=\"0\" width=\"16\" height=\"16\" alt=\"\" />";}
echo "</td>\n";
echo "<tr><td colspan=\"5\"><hr /></td></tr>";
echo "<tr><td>" . $l_dos . ":&nbsp;</td>\n";        
echo "<td>";
  if ($show_os == "y"){ 
    echo "<img src=\"images/button_ok.png\" border=\"0\" width=\"16\" height=\"16\" alt=\"\" />";
	} else { 
	echo "<img src=\"images/button_cancel.png\"  border=\"0\" width=\"16\" height=\"16\" alt=\"\" />"; }
echo "</td></tr>\n";
echo "<tr><td>" . $l_dda . ":&nbsp;</td>\n";
echo "<td>";
  if ($show_date_audited == "y"){ 
  echo "<img src=\"images/button_ok.png\" border=\"0\" width=\"16\" height=\"16\" alt=\"\" />";
  } else { 
  echo "<img src=\"images/button_cancel.png\"  border=\"0\" width=\"16\" height=\"16\" alt=\"\" />"; }
echo "</td></tr>";
echo "<tr><td>" . $l_dty . ":&nbsp;</td>";       
echo "<td>";
  if ($show_type == "y"){ 
  echo "<img src=\"images/button_ok.png\" border=\"0\" width=\"16\" height=\"16\" alt=\"\" />";
  } else { 
  echo "<img src=\"images/button_cancel.png\"  border=\"0\" width=\"16\" height=\"16\" alt=\"\" />"; }
echo "</td></tr>";
echo "<tr><td>" . $l_dde . ":&nbsp;</td>";
echo "<td>";
  if ($show_description == "y"){ 
    echo "<img src=\"images/button_ok.png\" border=\"0\" width=\"16\" height=\"16\" alt=\"\" />";
  } else { 
    echo "<img src=\"images/button_cancel.png\"  border=\"0\" width=\"16\" height=\"16\" alt=\"\" />"; }
echo "</td></tr>";
echo "<tr><td>" . $l_ddo . ":&nbsp;</td>";
echo "<td>";
  if ($show_domain == "y"){ 
  echo "<img src=\"images/button_ok.png\" border=\"0\" width=\"16\" height=\"16\" alt=\"\" />";
  } else { 
  echo "<img src=\"images/button_cancel.png\"  border=\"0\" width=\"16\" height=\"16\" alt=\"\" />"; }
echo "</td></tr>";
echo "<tr><td>" . $l_dsp . ":&nbsp;</td>";
echo "<td>";
  if ($show_service_pack == "y"){ 
  echo "<img src=\"images/button_ok.png\" border=\"0\" width=\"16\" height=\"16\" alt=\"\" />";
  } else { 
  echo "<img src=\"images/button_cancel.png\"  border=\"0\" width=\"16\" height=\"16\" alt=\"\" />"; }
echo "</td></tr>";
echo "<tr><td colspan=\"5\"><hr /></td></tr>";
echo "<tr><td>" . $l_nsd . ":&nbsp;</td><td>" . $count_system . "</td></tr>";
echo "<tr><td colspan=\"5\"><hr /></td></tr>";
echo "<tr><td>" . $l_col . "</td><td>" . $col . "</td></tr>";
if ($pic_style == "_win"){$pic_style_formatted = "Windows";}
if ($pic_style == "_crystal"){$pic_style_formatted = "Crystal";}
if ($pic_style == "_nuoveXT"){$pic_style_formatted = "NuoveXT";}
echo "<tr><td>" . $l_ico . "</td><td>" . $pic_style_formatted . "</td></tr>";
echo "<tr><td colspan=\"5\"><hr /></td></tr>";
echo "<tr><td>";
echo "<a href=\"admin_config.php?sub=1\" onmouseover=\"document.button.src='images/button_edit_config_over.png'\"";
echo " onmousedown=\"document.button.src='images/button_edit_config_down.png'\"";
echo " onmouseout=\"document.button.src='images/button_edit_config_out.png'\">";
echo "<img src=\"images/button_edit_config_out.png\" name=\"button\" width=\"94\" height=\"22\" border=\"0\" alt=\"\" />";
echo "</a></td></tr>";


include "include_png_replace.php";
echo "</table>";
echo "</div>";
echo "</div>";
echo "</body>";
echo "</html>";