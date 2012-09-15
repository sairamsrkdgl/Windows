<?php 
$page = "";
$extra = "";
$software = "";
if (isset($_GET['software'])) {$software = $_GET['software'];} else {}
include "include.php"; 
?>
<div class="main_each">
<p class="contenthead">&nbsp;&nbsp;Software Queries.</p>
<form method="post" action="query_2.php?form=1">
  <p class="content">Show all computers that 
  <select size="1" name="like" class="content">
  <option selected value="like">have</option>
  <option value="not">do not have</option>
  <option value="had">had</option>
  </select>
  <input type="text" name="search" size="20" class="content" />
  &nbsp;
  <select size="1" name="type" class="content">
  <option selected value="software">software</option>
  <option value="service">service</option>
  <option value="startup">start up program</option>
  </select>
  installed.
  <input type="submit" value="Submit" name="B1" class="content" />
  </p>
</form>



<p class="contenthead"><br /><br />&nbsp;&nbsp;Hardware Queries.</p>
<form method="post" action="query_2.php?form=2">
  <p class="content">Show all computers where 
  <select size="1" name="equipment" class="content">
    <option selected value="system WHERE net_ip_address">IP Address</option>
    <option value="net_wins_primary">WINS Address</option>
    <option value="net_dns_server">DNS Address</option>
    <option value="system WHERE net_ip_subnet">IP Subnet</option>
    <option value="system WHERE system_num_processors"># of Processors</option>
    <option value="processor WHERE processor_max_clock_speed">Processor Speed</option>
    <option value="system WHERE proxy_server">Proxy Server</option>
    <option value="hard_drive WHERE hard_drive_size">Hard Disk Size (in MB)</option>
    <option value="partition WHERE partition_size">Partition Size (in MB)</option>
    <option value="Video Adapter RAM">Video Adapter RAM</option>
    <option value="system WHERE system_memory">System Memory</option>
  </select>&nbsp;&nbsp; <select size="1" name="is" class="content">
    <option value="=">Equal To</option>
    <option value="&lt;&gt;">Not Equal To</option>
    <option value="&gt;">Greater Than</option>
    <option value="&lt;">Less Than</option>
    <option value="&gt;=">Greater Than or Equal To</option>
    <option value="&lt;=">Less Than or Equal To</option>
  </select>&nbsp;&nbsp; <input type="text" name="search" size="20" class="content" />&nbsp;&nbsp; 
  <input type="submit" value="Submit" name="Submit" class="content" />
  </p>
</form>



<p class="contenthead"><br /><br />&nbsp;&nbsp;Machine/User Name Queries.</p>
<form method="post" action="query_2.php?form=3">
  <p class="content">Show all computers where 
  <select size="1" name="equipment" class="content">
    <option selected value="system WHERE system_service_pack">System Service Pack</option>
    <option selected value="system WHERE system_primary_owner_name">System Owner/User</option>
    <option selected value="system WHERE system_name">System Name</option>
	<option selected value="system WHERE net_user_name">Domain User Name</option>
  </select>&nbsp;&nbsp; <select size="1" name="is" class="content">
    <option value="LIKE">is kind of like</option>
  </select>&nbsp;&nbsp; <input type="text" name="search" size="20" class="content" />&nbsp;&nbsp; 
  <input type="submit" value="Submit" name="Submit" class="content" />
  </p>
</form>


<p>&nbsp;</p>
</div>
<?php
include "include_png_replace.php";
?>
</body>
</html>
