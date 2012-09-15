<?php
$page = "setup";
include "include.php"; 

echo "<div class=\"main_each\">\n";

if(!(isset($_POST['submit']))){
  echo "<form name=\"setup\" action=\"setup_audit.php\" method=\"post\">\n";
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"650\" class=\"content\" >\n";
  ?>
  <tr><td colspan="2" class="contenthead">Audit.vbs Configuration</td></tr>
  <tr><td colspan="2"><hr /></td></tr>
  <tr>
    <td>Verbose Console Output<br />&nbsp;</td>
	<td valign="top"><select size="1" name="verbose" class="content">
		<option value="y">Yes</option>
	    <option value="n">No</option>
		</select><br />&nbsp;</td>
  <tr>
  <tr>
    <td>Use what for the unique identifier (UUID)<br />&nbsp;</td>
	<td valign="top"><select size="1" name="uuid_type" class="content">
		<option value="uuid">uuid</option>
	    <option value="mac" >MAC Address</option>
	    <option value="name">System Name &amp; Domain</option>
		</select><br />&nbsp;</td>
  <tr>
    <td>Do you wish IE to be visible when running audits ?<br />&nbsp;</td>
	<td valign="top"><select size="1" name="ie_visible" class="content">
		<option value="y">Yes</option>
	    <option value="n">No</option>
		</select><br />&nbsp;</td>
  </tr>
  <tr>
    <td>Should the form data be auto-submitted ?<br />&nbsp;</td>
	<td valign="top"><select size="1" name="ie_auto_submit" class="content">
	    <option value="n">No</option>
		<option value="y">Yes</option>
		</select><br />&nbsp;</td>
  </tr>
  <tr>
    <td>Verbose IE output ?<br />&nbsp;</td>
	<td valign="bottom"><select size="1" name="audit_ie_verbose" class="content">
		<option value="y">Yes</option>
	    <option value="n">No</option>
		</select><br />&nbsp;</td>
  </tr>
  <tr>
    <td>What is the name of the page to submit to ?<br>NOTE - If you are running this audit from remote machines, your server name should NOT be localhost.<br />&nbsp;</td>
	<td valign="bottom"><input size="25" name="ie_form_page" class="content" value="http://<?php echo $_SERVER["COMPUTERNAME"]; ?>/winventory/admin_pc_add_new.php" /><br />&nbsp;</td>
  </tr>
  <tr>
    <td>Do you wish to have a default system to audit ?<br />If no command line arguement is given, audit.vbs audits the local machine.<br />&nbsp;</td>
	<td valign="bottom"><select size="1" name="strcomputer" class="content">
		<option value=".">Yes</option>
	    <option value="">No</option>
		</select><br />&nbsp;</td>
  </tr>
  <tr>
    <td>Do you wish to audit the domain ?<br />&nbsp;</td>
	<td valign="bottom"><select size="1" name="domain_audit" class="content">
	    <option value="n">No</option>
		<option value="y">Yes</option>
		</select><br />&nbsp;</td>
  </tr>
  <tr>
    <td>What is the name of the domain ?<br />Standard LDAP format.<br />&nbsp;</td>
	<td valign="bottom"><input size="25" name="domain" class="content" value="DC=ho,DC=qpcu,DC=org,DC=au" /><br />&nbsp;</td>
  </tr>
  <tr>
    <td>What is the name of the text file for non-domain PCs (if any) ?<br />Make sure to remove this if you don't use it. A sample is in pc_list_file.txt in the scripts directory.<br />&nbsp;</td>
	<td valign="bottom"><input size="25" name="input_file" class="content" value="" /><br />&nbsp;</td>
  </tr>
  <tr>
    <td>How many simultaneous audits do you wish to run ?<br />When you run a domain audit, or use a pc list text file.<br />&nbsp;</td>
	<td valign="bottom"><input size="25" name="number_of_audits" class="content" value="20" /><br />&nbsp;</td>
  </tr>
  <tr>
    <td>Who should get an email of failed audits ?<br />&nbsp;</td>
	<td valign="bottom"><input size="25" name="email_to" class="content" value="munwin@qpcu.org.au" /><br />&nbsp;</td>
  </tr>
  <tr>
    <td>Who should the email come from ?<br />&nbsp;</td>
	<td valign="bottom"><input size="25" name="email_from" class="content" value="munwin@qpcu.org.au" /><br />&nbsp;</td>
  </tr>
  <tr>
    <td>What is the email server address ?<br />&nbsp;</td>
	<td valign="bottom"><input size="25" name="email_server" class="content" value="192.168.10.18" /><br />&nbsp;</td>
  </tr>
  <tr>
    <td>Do you wish run hfnetchk ?<br />Remember you must have hfnetchk downloaded.<br />&nbsp;</td>
	<td valign="bottom"><select size="1" name="hfnet" class="content">
	    <option value="n">No</option>
		<option value="y">Yes</option>
		</select><br />&nbsp;</td>
  </tr>
  <tr><td colspan="2"><hr /></td></tr>
  <tr>
    <td>Click Submit whem you are done.</td>
	<td><input type="submit" name="submit" value="Submit" class="content" /></td>
  </tr>
</table>
</form>
<?
} else {
  echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"650\" class=\"content\" >\n";
  $filename = "scripts/audit.config";
  $content  = "audit_location = \"l\" \r\n";
  $content .= "verbose = \"" . $_POST['verbose'] . "\" \r\n";
  $content .= "online = \"ie\" \r\n";
  $content .= "strComputer = \"" . $_POST['strcomputer'] . "\" \r\n";
  $content .= "ie_visible = \"" . $_POST['ie_visible'] . "\" \r\n";
  $content .= "ie_auto_submit = \"" . $_POST['ie_auto_submit'] . "\" \r\n";
  $content .= "ie_submit_verbose = \"" . $_POST['audit_ie_verbose'] . "\" \r\n";
  $content .= "ie_form_page = \"" . $_POST['ie_form_page'] . "\" \r\n";
  $content .= "input_file = \"" . $_POST['input_file'] . "\" \r\n";
  $content .= "email_to = \"" . $_POST['email_to'] . "\" \r\n";
  $content .= "email_from = \"" . $_POST['email_from'] . "\" \r\n";
  $content .= "email_server = \"" . $_POST['email_server'] . "\" \r\n";
  $content .= "audit_local_domain = \"" . $_POST['domain_audit'] . "\" \r\n";
  $content .= "local_domain = \"LDAP://" . $_POST['domain'] . "\" \r\n";
  $content .= "hfnet = \"" . $_POST['hfnet'] . "\" \r\n";
  $content .= "Count = 0 \r\n";
  $content .= "number_of_audits = 20 \r\n";
  $content .= "script_name = \"audit.vbs\" \r\n";
  $content .= "monitor_detect = \"y\" \r\n";
  $content .= "printer_detect = \"y\" \r\n";
  $content .= "software_audit = \"y\" \r\n";
  $content .= "uuid_type = \"" . $_POST['uuid_type'] . "\" \r\n";
  if (is_writable($filename)) {
    if (!$handle = fopen($filename, 'w')) {
      echo "</tr><tr><td><h2>Cannot open file ($filename)</h2></td></tr>\n";
      exit;
    }
    if (fwrite($handle, $content) === FALSE) {
      echo "</tr><tr><td><h2>Cannot write to file ($filename)</h2></td></tr>\n";
      exit;
    } else {
      echo "<td>Success.&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"images/button_ok.png\" width=\"16\" height=\"16\" /></td></tr>\n";
    }
    fclose($handle);
  } else {
    echo "</tr><tr><td><h2>The file $filename is not writable</h2></td></tr>\n";
  }
  echo "<tr><td>Done.</td></tr>\n";
  echo "<tr><td><br />Now make sure you go and download the following:<br />\n";
  echo "Shavlivk HFNetchk 3.86 command line tool - <a href=\"http://hfnetchk.shavlik.com/hfreadme.asp\">Link</a><br />\n";
  echo "Shavlik patches file - <A href=\"http://xml.shavlik.com/mssecure.cab\">Link</a><br />";
  echo "PSTools Suite - <a href=\"http://www.sysinternals.com/ntw2k/freeware/pstools.shtml\">Link</a><br />\n";
  echo "NMap command line - <a href=\"http://www.insecure.org/nmap/nmap_download.html\">Link</a><br />\n";
  echo "WinPcap for Windows - <a href=\"http://winpcap.polito.it/\">Link</a><br />\n";
  echo "<br />Extract hfnetchk.exe and put it in your scripts directory.";
  echo "<br />Extract MSSecure.XML from mssecure.cab, and put it in your scripts directory.";
  echo "<br />Extract the pstools .exe's and put them in your web root.";
  echo "<br />Install NMap, and make sure it's in your command path.";
  echo "<br />Install WinPcap (for NMap to use)>";
  echo "<br>START AUDITING !!!";
  echo "</td></tr>\n";
  echo "</table>";
}
?>