<?php 
$page = "groups";
include "include.php"; 

echo "<div class=\"main_each\">\n";
?>
<form action="group_add_2.php?sub=no" method="post">
<table border="0" cellpadding="2" cellspacing="0" width="700" class="content">
  <tr><td class="contenthead">Add a Group.</td></tr>
  <tr><td>Name:&nbsp;<input type="text" name="name" size="20" class="content" /></td></tr>
  <tr><td>Type:&nbsp;<input type="radio" name="type" value="hardware"> Hardware &nbsp;&nbsp;<input type="radio" name="type" value="software"> Software</td></tr>
  <tr><td colspan="2"><textarea rows="4" name="description" cols="60" class="content"></textarea></td></tr>
  <tr><td><input name="Submit" value="Submit" type="submit" class="content" /></td></tr>
</table>
</form>
</div>
</div>
</body>
</html>


<?php
include "include_png_replace.php";
?>