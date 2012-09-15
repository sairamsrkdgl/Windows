<?php 
$page = "groups";
include "include.php";
$SQL = "SELECT * FROM group_names WHERE group_id = '" . $_GET['group'] . "'";
$result = mysql_query($SQL, $db);
if ($myrow = mysql_fetch_array($result)){
do {
echo "<div class=\"main_each\">\n";
?>


<form action="group_edit_2.php?sub=no&amp;group=<?php echo $_GET['group']; ?>" method="post">
<table border="0" cellpadding="2" cellspacing="0" width="700" class="content">
  <tr><td colspan="2" class="contenthead">Edit a Group.</td></tr>
  <tr><td>Name:&nbsp;<input type="text" name="name" size="20" value="<?php echo $myrow['group_name']; ?>" class="content" /></td></tr>
  <tr><td colspan="2"><textarea rows="4" name="description" cols="60" class="content"><?php echo $myrow['group_desc']; ?></textarea></td></tr>
  <tr><td><input name="Submit" value="Submit" type="submit" class="content" /></td></tr>
</table>
</form>
</div>

<?php
} while ($myrow = mysql_fetch_array($result));
?>
<?php
} else {}
?>

</body>
</html>


<?php
include "include_png_replace.php";
?>