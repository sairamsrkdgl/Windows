<?php

function determine_img($os_name,$system_type)
{

$img = "<img src=\"images/button_show.png\" width=\"22\" height=\"22\" alt=\"Unknown\" title=\"Unknown\" />";

if ($os_name == "Microsoft Windows 95") {
  $img = "<img src=\"images/inv_small_desktop.png\" width=\"22\" height=\"22\" alt=\"WIn 95\" title=\"Win 95\" />";}
else {}

if ($os_name == "Microsoft Windows 98") {
  $img = "<img src=\"images/inv_small_desktop.png\" width=\"22\" height=\"22\" alt=\"Win 98\" title=\"Win 98\" />";}
else {}

if ($os_name == "Microsoft Windows 98 Second Edition") {
  $img = "<img src=\"images/inv_small_desktop.png\" width=\"22\" height=\"22\" alt=\"Win 98 SE\" title=\"Win 98 SE\" />";}
else {}

if ($os_name == "Microsoft Windows Millenium Edition") {
  $img = "<img src=\"images/inv_small_desktop.png\" width=\"22\" height=\"22\" alt=\"Win ME\" title=\"Win ME\" />";}
else {}

if ($os_name == "Microsoft Windows ME") {
  $img = "<img src=\"images/inv_small_desktop.png\" width=\"22\" height=\"22\" alt=\"Win ME\" title=\"Win ME\" />";}
else {}


if (substr_count($os_name, "Windows NT") > 0) {
  $img = "<img src=\"images/inv_small_desktop.png\" width=\"22\" height=\"22\" alt=\"Win NT\" title=\"Win NT\" />";}
else {}

if ($os_name == "Microsoft Windows NT Workstation") {
  $img = "<img src=\"images/inv_small_desktop.png\" width=\"22\" height=\"22\" alt=\"NT Workstation\" title=\"NT Workstation\" />";}
else {}

if ($os_name == "Microsoft Windows NT Server") {
  $img = "<img src=\"images/inv_small_server.png\" width=\"22\" height=\"22\" alt=\"NT Server\" title=\"NT Server\" />";}
else {}

if ($os_name == "Microsoft Windows NT Enterprise Server") {
  $img = "<img src=\"images/inv_small_server.png\" width=\"22\" height=\"22\" alt=\"NT Ent Server\" title=\"NT Ent Server\" />";}
else {}


if (substr_count($os_name, "Windows 2000") > 0) {
  $img = "<img src=\"images/inv_small_desktop.png\" width=\"22\" height=\"22\" alt=\"Win 2000\" title=\"Win 2000\" />";}
else {}

if ($os_name == "Microsoft Windows 2000 Professional") {
  $img = "<img src=\"images/inv_small_desktop.png\" width=\"22\" height=\"22\" alt=\"2000 Pro\" title=\"2000 Pro\" />";}
else {}

if ($os_name == "Microsoft Windows 2000 Server") {
  $img = "<img src=\"images/inv_small_server.png\" width=\"22\" height=\"22\" alt=\"2000 Server\" title=\"2000 Server\" />";}
else {}

if ($os_name == "Microsoft Windows 2000 Advanced Server") {
  $img = "<img src=\"images/inv_small_server.png\" width=\"22\" height=\"22\" alt=\"2000 Adv Server\" title=\"2000 Adv Server\" />";}
else {}

if ($os_name == "Microsoft Windows Powered") {
  $img = "<img src=\"images/inv_small_server.png\" width=\"22\" height=\"22\" alt=\"2000 Powered\" title=\"2000 Powered\" />";}
else {}


if (substr_count($os_name, "Windows XP") > 0) {
  $img = "<img src=\"images/inv_small_desktop.png\" width=\"22\" height=\"22\" alt=\"Win XP\" title=\"Win XP\" />";}
else {}

if ($os_name == "Microsoft Windows XP Professional") {
  $img = "<img src=\"images/inv_small_desktop.png\" width=\"22\" height=\"22\" alt=\"XP Pro\" title=\"XP Pro\" />";}
else {}

if ($os_name == "Microsoft Windows XP Home Edition") {
  $img = "<img src=\"images/inv_small_desktop.png\" width=\"22\" height=\"22\" alt=\"XP Home\" title=\"XP Home\" />";}
else {}

if ($os_name == "Microsoft Windows XP Starter Edition") {
  $img = "<img src=\"images/inv_small_desktop.png\" width=\"22\" height=\"22\" alt=\"XP Starter\" title=\"XP Starter\" />";}
else {}

if ($os_name == "Microsoft Windows XP Media Center Edition") {
  $img = "<img src=\"images/inv_small_desktop.png\" width=\"22\" height=\"22\" alt=\"XP MCE\" title=\"XP MCE\" />";}
else {}

if ($os_name == "Microsoft Windows XP Tablet PC Edition") {
  $img = "<img src=\"images/inv_small_desktop.png\" width=\"22\" height=\"22\" alt=\"XP Tablet\" title=\"XP Tablet\" />";}
else {}

if ($os_name == "Microsoft Windows XP Professional x64 Edition") {
  $img = "<img src=\"images/inv_small_desktop.png\" width=\"22\" height=\"22\" alt=\"XP Pro 64\" title=\"XP Pro 64\" />";}
else {}


if (substr_count($os_name, "Server 2003") > 0) {
  $img = "<img src=\"images/inv_small_server.png\" width=\"22\" height=\"22\" alt=\"2003 Server, Std\" title=\"2003 Server, Std\" />";}
else {}

if ($os_name == "Microsoft(R) Windows(R) Server 2003, Standard Edition" or $os_name == "Microsoft(R) Windows(R) Server 2003 Standard Edition") {
  $img = "<img src=\"images/inv_small_server.png\" width=\"22\" height=\"22\" alt=\"2003 Server, Std\" title=\"2003 Server, Std\" />";}
else {}

if ($os_name == "Microsoft(R) Windows(R) Server 2003, Web Edition" or $os_name == "Microsoft(R) Windows(R) Server 2003 Web Edition") {
  $img = "<img src=\"images/inv_small_server.png\" width=\"22\" height=\"22\" alt=\"2003 Server, Web\" title=\"2003 Server, Web\" />";}
else {}

if ($os_name == "Microsoft(R) Windows(R) Server 2003, for Small Business Server" or $os_name == "Microsoft(R) Windows(R) Server 2003 for Small Business Server") {   
  $img = "<img src=\"images/inv_small_server.png\" width=\"22\" height=\"22\" alt=\"2003 Server, SBS\" title=\"2003 Server, SBS\" />";}
else {}

if ($os_name == "Microsoft(R) Windows(R) Server 2003, Enterprise Edition" or $os_name == "Microsoft(R) Windows(R) Server 2003 Enterprise Edition") {
  $img = "<img src=\"images/inv_small_server.png\" width=\"22\" height=\"22\" alt=\"2003 Server, Ent\" title=\"2003 Server, Ent\" />";}
else {}

if ($os_name == "Microsoft(R) Windows(R) Server 2003, Data Center Edition" or $os_name == "Microsoft(R) Windows(R) Server 2003 Data Center Edition") {
  $img = "<img src=\"images/inv_small_server.png\" width=\"22\" height=\"22\" alt=\"2003 Server, Data\" title=\"2003 Server, Data\" />";}
else {}


if ($system_type == "Laptop" OR $system_type == "Expansion Chassis" OR $system_type == "Notebook" OR $system_type == "Sub Notebook" OR $system_type == "Portable" OR $system_type == "Docking Station") {
  $img = "<img src=\"images/inv_small_laptop.png\" width=\"22\" height=\"22\" alt=\"Laptop\" title=\"Laptop\" />"; }
else {}


return $img;
}

?>