<?php 
$page = "register";
include "include.php"; 

echo "<div class=\"main_each\">";
$sql = "SELECT * from software_register WHERE software_reg_id = '" . $_GET["id"] . "'";
$result = mysql_query($sql, $db);
if ($myrow = mysql_fetch_array($result)){
  ?>
  <p class="contenthead">Add License for <?php echo $myrow["software_title"]; ?>.</p>
  <form action="software_add_license_2.php" method="post">
  <table border="0" cellpadding="0" cellspacing="0" class="content">
    <tr><td>Date Purchased:  </td><td><input type="text" name="date_purchased" size="20" />&nbsp;(yyyy-mm-dd)</td></tr>
    <tr><td>Number Purchased:  </td><td><input type="text" name="number_purchased" size="20" /> Set to "-1" if this is free</td></tr>
    <tr><td>Vendor:  </td><td><input type="text" name="vendor" size="20" /></td></tr>
    <tr><td>Cost per License:  </td><td><input type="text" name="cost" size="20" /></td></tr>
    <tr><td>Order Number:  </td><td><input type="text" name="order" size="20" /></td></tr>
    <tr><td>License Type:  </td><td><select size="1" name="type">
      <option value="Enterprise Agreement">Enterprise Agreement</option>
      <option value="OEM">OEM</option>
      <option value="Open License">Open License</option>
      <option value="Other">Other</option>
      <option value="Retail">Retail</option>
      <option value="Select License">Select License</option>
    </select></td></tr>
    <tr><td>Comments: </td><td colspan="2"><textarea rows="4" name="comments" cols="60"></textarea></td></tr>
    <tr><td><input name="Submit" value="Submit" type="submit" /></td></tr>
  </table>
  <input type="hidden" value="<?php echo $_GET["id"]; ?>" name="id" />
  </form>
  </div>
  <?php
} else {
  echo "<div class=\"main_each\">";
  echo "Please add the Software Package to the register, before attempting to add a license.";
  echo "</div>";
}
?>
</body>
</html>


<?php
include "include_png_replace.php";
?>