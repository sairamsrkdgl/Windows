<?php 
$page = "help";
include "include.php"; 
 
echo "<div class=\"main_each\">\n";
?>
<p class="contenthead">Help and Information</p>

<table border="0" cellpadding="0" cellspacing="0" width="700" class="content">
<tr><td class="contenthead">Welcome</td></tr>

<tr><td>Hi, and welcome to Windows Inventory.</td></tr>

<tr><td>Windows Inventory is a part time project of mine, that I find very useful in my day to day job. I am a System Administrator, and am often asked questions about systems I manage. Questions can range from 'What is the hardware spec of that server ?', to 'How many Office 2003 Pro licenses are we using ?'. Management usually want these answers, but don't want to spend money to get them. Hence, I thought I'd write Windows Inventory, to answer these questions, and learn things along the way.<br />&nbsp;</td></tr>

<tr><td class="contenthead">Setup</td></tr>

<tr><td>On the server side you will need the following:<br /> *  A web server - IIS or Apache should be OK.
<br /> *  PHP installed - at least 4.0.
<br /> *  MySQL Database installed - at least 4.1.</td></tr>

<tr><td><br />On the client side, there are some options. First, ALL client PCs will need:
<br /> *  Windows Scripting Host - 5.6 at least.
<br /> *  Windows Management Interface - latest available.
<br />Some options for client PCs are:
<br /> *  MyODBC for MySQL - version 3.5.11 This will be needed if you are running the scripts directly on the client PCs. There is an option to run the scripts from a workstation with Domain Admin rights - hence, the clients don't need to talk to the MySQL, and don't need MyODBC installed.
<br /> * A network connection - if doing 'online' audits. 'Offline' audit can also be done, using a floppy disk, USB Key, etc. Online audits provide slightly more information concerning software installs and uninstalls.</td></tr>

<tr><td><br />Admin Workstation
<br />I generally use my workstation to run the script on the PCs, and input the data to the database. To do this you will need MyODBC, and a network connection to the web/MySQL server.</td></tr>

<tr><td>To Setup Windows Inventory
<br />Extract the .zip file to a suitable location on your web server.
<br />Create a database (empty) called winventory.
<br />Run the script for the database (winventory.sql), to create the tables and fields in the winventory database.
<br />Probably best to copy the 'scripts' folder somewhere outside the web server, and delete the directory.
<br />Edit the config.php file - supply the needed data.
<br />There, the server is setup !!!
<br />
<br />Edit audit.vbs - set it up for your needs.
<br />Try running audit.vbs from the command line on your local pc using "cscript audit.vbs" (no quotes).
<br />Fire up a browser and go to http://yourserver/winventory/index.php
<br />You should see your PC listed there.
<br />From here, check out audit.vbs, and explore the options - you can audit a domain, have the script ask you for an individual PC to audit, audit remote PCs (supplying credentials), audit a list of PCs from a .txt file, etc, etc.<br />&nbsp;</td></tr>

<tr><td class="contenthead">Future Stuff</td></tr>
<tr><td>I have a lot to do yet as far as auditing is concerned. Auditing is the first step, once I am happy with this, other functionality will be added. Stuff like - Application Deployment, integrated MBSA reports, database abstraction, etc.
<br />I will soon implement a 'setup' feature so you extract the .zip file, call setup.php in a browser, answer the questions, and it's setup for you. No manual editing of script files, configs, etc, etc. 
<br />Windows Inventory at the moment, is only really is setup for English. Other language’s may present issues from time to time. When I get to a 1.0 release, I'll ask for some help in translating.
<br />&nbsp;</td></tr>


<tr><td class="contenthead">Thanks</td></tr>
<tr><td>Thanks for all the feedback. Please email me at munwin99@hotmail.com if you have urgent queries. Otherwise, please post them in the forums - that way others benefit from the answers. Please let any of your colleagues and/or friends know about Windows Inventory. The more users the better.
<br />If anyone comes to Brisbane, Australia - let me know and we can catch up for a beer.
<br />
<br />Thanks again,
<br />Mark Unwin.
<br /><a href="http://winventory.sourceforge.net/">WI Homepage</a>
<br /><a href="http://winventory.sourceforge.net/forums/">WI Forums</a></td></tr>

</table>
</div>
</div>
</body>
</html> 
<?php
include "include_png_replace.php";
?>