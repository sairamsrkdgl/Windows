<?php 
$page = "ac";
include "include.php"; 
?>


<div class="main_each"> 
 <form name='Tools'>
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td align="center" valign="bottom" height="90"><a href="system_actions_2.php?action=on&amp;pc=<?php echo $pc; ?>"><img border="0" src="images/inv_action_on<?php echo $pic_style; ?>.png" width="64" height="64"></a></td>
      <td align="center" valign="bottom" height="90"><a href="system_actions_2.php?action=off&amp;pc=<?php echo $pc; ?>&amp;name=<?php echo $name; ?>&amp;domain=<?php echo $domain; ?>"><img border="0" src="images/inv_action_off<?php echo $pic_style; ?>.png" width="64" height="64"></a></td>
      <td align="center" valign="bottom" height="90"><a href="system_actions_2.php?action=reboot&amp;pc=<?php echo $pc; ?>&amp;name=<?php echo $name; ?>&amp;domain=<?php echo $domain; ?>"><img border="0" src="images/inv_action_reset<?php echo $pic_style; ?>.png" width="64" height="64"></td>
    </tr>
    <tr>
      <td align="center" valign="bottom" height="20">Power On</td>
      <td align="center" valign="bottom" height="20">Power Off</td>
      <td align="center" valign="bottom" height="20">Reboot</td>
    </tr>
    <tr>
      <td align="center" valign="bottom" height="90"><img border="0" src="images/inv_action_inventory<?php echo $pic_style; ?>.png" width="64" height="64"></td>
      <td align="center" valign="bottom" height="90"><a href="#" onclick="launchExplorer" title="Launch Explorer"><img border="0" src="images/inv_action_explore<?php echo $pic_style; ?>.png" width="64" height="64"></a></td>
      <td align="center" valign="bottom" height="90"><a href="action_launch_program.php?pc=<?php echo $pc; ?>&sub=pr"><img border="0" src="images/inv_action_run_remote<?php echo $pic_style; ?>.png" width="64" height="64"></a></td>
    </tr>
    <tr>
      <td align="center" valign="bottom" height="20">Inventory Now</td>
      <td align="center" valign="bottom" height="20">Browse with Explorer</td>
      <td align="center" valign="bottom" height="20">Run Remote Program</td>
    </tr>
    <tr>
      <td align="center" valign="bottom" height="90"><a href="http://<?php echo $ip; ?>:5800" target="_blank"><img border="0" src="images/inv_action_vnc<?php echo $pic_style; ?>.png" width="64" height="64"></a></td>
      <td align="center" valign="bottom" height="90"><input type='image' name='Mgmt' value='Manage System' src="images/inv_action_mmc<?php echo $pic_style; ?>.png">
	<script for='Mgmt' event='onClick' language='VBScript'>
	Dim WshShell, WScript
	Set WshShell = createObject("WScript.Shell")
	WshShell.run("mmc %windir%\system32\compmgmt.msc -s /computer:\\<?php echo $ip; ?>")
	</script>
      <td align="center" valign="bottom" height="90"><input type='image' name='Ping' value='Ping System' src="images/inv_action_ping<?php echo $pic_style; ?>.png"></td>
	<script for='Ping' event='onClick' language='VBScript'>
	Dim WshShell, WScript
	Set WshShell = createObject("WScript.Shell")
	WshShell.run("cmd /k ping <?php echo $ip; ?>")
	</script>
    </tr>

    <tr>
      <td align="center" valign="bottom" height="20">VNC Remote Control</td>
      <td align="center" valign="bottom" height="20">Manage via MMC</td>
      <td align="center" valign="bottom" height="20">Ping System</td>
    </tr>
    <tr>
      <td align="center" valign="bottom" height="90"><input type='image' name='Eventviewer' value='Event Viewer' src="images/inv_action_log<?php echo $pic_style; ?>.png"></td>
	<script for='Eventviewer' event='onClick' language='VBScript'>
	Dim WshShell, WScript
	Set WshShell = createObject("WScript.Shell")
	WshShell.Run("eventvwr \\<?php echo $ip; ?>")
	</script>
      <td align="center" valign="bottom" height="90"><input type='image' name='Winmsd' value='Diagnostic' src="images/inv_action_sysinfo<?php echo $pic_style; ?>.png"></td>
	<script for='Winmsd' event='onClick' language='VBScript'>
	Dim WshShell, WScript
	set WshShell = createObject("WScript.Shell")
	WshShell.Run("winmsd /computer <?php echo $ip; ?>")
	</script>
    </tr>
    <tr>
      <td align="center" valign="bottom" height="20">Event Viewer</td>
      <td align="center" valign="bottom" height="20">MS Sys Info</td>
    </tr>
  </table>
 </form>
</div>
</body>
</html>







                      
<?php
include "include_png_replace.php";
?>
