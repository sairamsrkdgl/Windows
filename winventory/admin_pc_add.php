<?php 
if (isset($_GET['fs'])) {
} else {
  $page = "admin";
  include "include.php"; 
}
echo "<div class=\"main_each\">";

if (isset($_GET['fs'])) {
  echo "<p class=\"contenthead\">Add my PC.</p>\n";
  echo "<form action=\"admin_pc_add_2.php?fs=y\" method=\"post\">\n";
} else {
  echo "<p class=\"contenthead\">Add a PC.</p>";
  echo "<form action=\"admin_pc_add_2.php\" method=\"post\">\n";
}
echo "<table><tr><td><br />";
if (isset($_GET['fs'])) {
  echo "Status:&nbsp;<input type=\"text\" name=\"comment\" size=\"30\" class=\"contenthead\" /><br />";
} else {}
?>
<textarea rows="10" name="add" cols="60"></textarea><br />
<input name="submit" value="Submit" type="submit" />
</td></tr>
</table>
</form>
</div>
</div>
</body>
</html>


<?php
if (isset($_GET['fs'])) {
} else {
include "include_png_replace.php";
}
?>