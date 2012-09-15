<style type="text/css"> 

.contenthead {
  FONT-SIZE: 12pt; 
  COLOR: #000000;
  LINE-HEIGHT: 16pt; 
  FONT-FAMILY: "Trebuchet MS", Trebuchet, Arial, Helvetica, sans-serif
}

.content {
  FONT-SIZE: 9pt; 
  COLOR: #000000; 
  LINE-HEIGHT: 12pt; 
  FONT-FAMILY: Verdana, Geneva, Arial, Helvetica, sans-serif; 
  TEXT-ALIGN: left; 
  TEXT-DECORATION: none;
}
</style>

<?php 

echo "<div class=\"main_each\">\n";
echo "<p class=\"contenthead\">Add my PC.</p>\n";
echo "<form action=\"admin_pc_add_new_4.php?fs=y\" method=\"post\">\n";
echo "<table class=\"content\">\n";
echo "<tr><td>System Name:&nbsp;</td><td><input type=\"text\" name=\"systemname\" size=\"30\" class=\"content\" /></td></tr>\n";
echo "<tr><td>Status:&nbsp;</td><td><input type=\"text\" name=\"comment\" size=\"30\" class=\"content\" /></td></tr>\n";
echo "<tr><td>UserName:&nbsp;</td><td><input type=\"text\" name=\"user_name\" size=\"30\" class=\"content\" /></td></tr>\n";
echo "<tr><td>UUID:&nbsp;</td><td><input type=\"text\" name=\"uuid\" size=\"30\" class=\"content\" /></td></tr>\n";
echo "<tr><td>Timestamp:&nbsp;</td><td><input type=\"text\" name=\"timestamp\" size=\"30\" class=\"content\" /></td></tr>\n";
echo "<tr><td>Verbose on Submit&nbsp;</td><td><input type=\"text\" name=\"verbose\" size=\"10\" class=\"content\"><br />";
echo "<tr><td>Software Audit&nbsp;</td><td><input type=\"text\" name=\"software_audit\" size=\"10\" class=\"content\"><br />";
echo "<tr><td colspan=\"2\"><textarea rows=\"20\" name=\"add\" cols=\"100\" class=\"content\"></textarea></td></tr>\n";
echo "<tr><td colspan=\"2\"><input name=\"submit\" value=\" Submit\" type=\"submit\" class=\"content\" /></td></tr>\n";
echo "</table>\n";
echo "</form>\n";
echo "</div>\n";
echo "</div>\n";
echo "<a href=\"javascript:window.close()\" name=\"clicktoclose\"> </a>";
echo "</body>\n";
echo "</html>\n";
?>