Readme.txt

Welcome
Hi, and welcome to Windows Inventory.
Windows Inventory is a part time project of mine, that I find very useful in my day to day job. I am a System Administrator, and am often asked questions about systems I manage. Questions can range from 'What is the hardware spec of that server ?', to 'How many Office 2003 Pro licenses are we using ?'. Management usually want these answers, but don't want to spend money to get them. Hence, I thought I'd write Windows Inventory, to answer these questions, and learn things along the way.
 
Setup
On the server side you will need the following:
* A web server - IIS or Apache should be OK.
* PHP installed - at least 4.0. - configured with gd enabled for generating images.
* MySQL Database installed - at least 4.1.xx

On the client side, there are some options. First, ALL client PCs will need:
* Windows Scripting Host - 5.6 at least.
* Windows Management Interface - latest available.
Some options for client PCs are:
* MyODBC for MySQL - version 2.5. This will be needed if you are running the scripts directly on the client PCs. There is an option to run the scripts from a workstation with Domain Admin rights - hence, the clients don't need to talk to the MySQL, and don't need MyODBC installed.
* A network connection - if doing 'online' audits. 'Offline' audit can also be done, using a floppy disk, USB Key, etc. Online audits provide slightly more information concerning software installs and uninstalls.

Admin Workstation
I generally use my workstation to run the script on the PCs, and input the data to the database. To do this you will need MyODBC, and a network connection to the web/MySQL server.
To Setup Windows Inventory
Extract the .zip file to c:\inetpub\wwwroot\winventory
Call the page setup.php from a web browser - http://yourserver/winventory/setup.php
After this has run, it is probably best to copy the 'scripts' folder somewhere outside the web server, and delete the directory.
There, the server is setup !!!

Edit audit.vbs - set it up for your needs.
Try running audit.vbs from the command line on your local pc using "cscript audit.vbs ." (no quotes).
Fire up a browser and go to http://yourserver/winventory/index.php
You should see your PC listed there.
From here, check out audit.vbs, and explore the options - you can audit a domain, have the script ask you for an individual PC to audit, audit remote PCs (supplying credentials), audit a list of PCs from a .txt file, etc, etc.
 
Future Stuff
I have a lot to do yet as far as auditing is concerned. Auditing is the first step, once I am happy with this, other functionality will be added. Stuff like - Application Deployment, integrated MBSA reports(hfnet check is in since 0.8.0.1), database abstraction, etc.
I will would like to implement a 'setup' feature so you extract the .zip file, call setup.php in a browser, answer the questions, and it's setup for you (done since 0.8.0.1). No manual editing of script files, configs, etc, etc. I'd also like to implement 'upgrades' so you don't lose the completed audits (although, if you are on a single domain, it's usually better to do a completely new install, then run the new audit.vbs - this avoids some conflict type stuff)...
Windows Inventory at the moment, is only really is setup for English. Other language’s may present issues from time to time. When I get to a 1.0 release, I'll ask for some help in translating.
 
Thanks
Thanks for all the feedback. Please email me at munwin99@hotmail.com if you have urgent queries. Otherwise, please post them in the forums - that way others benefit from the answers. Please let any of your colleagues and/or friends know about Windows Inventory. The more users the better.
If anyone comes to Brisbane, Australia - let me know and we can catch up for a couple of drinks (beer is good !!!).
Thanks again,
Mark Unwin.