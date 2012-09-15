<?php 
$page = "admin";
include "include.php"; 
?>


<div id="content">
<p class="contenthead">Add a PC.</p>
<form action="admin_pc_add_2.php" method="post">
<table>
<tr><td><br />
<input type="text" name="comment" size="60" />
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
include "include_png_replace.php";
?>