<?php

function determine_os($os)
{

$os_returned = "Unknown";

if ($os == "Microsoft Windows 95") {
  $os_returned = "WIn 95"; }
else {}

if ($os == "Microsoft Windows 98") {
  $os_returned = "Win 98"; }
else {}

if ($os == "Microsoft Windows Milenium Edition") {
  $os_returned = "Win ME"; }
else {}


if ($os == "Microsoft Windows 98 Second Edition") {
  $os_returned = "Win 98 SE"; }
else {}

if ($os == "Microsoft Windows NT Workstation") {
  $os_returned = "NT Workstation"; }
else {}

if ($os == "Microsoft Windows NT Server") {
  $os_returned = "NT Server"; }
else {}

if ($os == "Microsoft Windows NT Enterprise Server") {
  $os_returned = "NT Ent Server"; }
else {}


if ($os == "Microsoft Windows 2000 Professional") {
  $os_returned = "2000 Pro"; }
else {}

if ($os == "Microsoft Windows 2000 Server") {
  $os_returned = "2000 Server"; }
else {}

if ($os == "Microsoft Windows 2000 Advanced Server") {
  $os_returned = "2000 Adv Server"; }
else {}

if ($os == "Microsoft Windows Powered") {
  $os_returned = "2000 Powered"; }
else {}


if ($os == "Microsoft Windows XP Professional") {
  $os_returned = "XP Pro"; }
else {}

if ($os == "Microsoft Windows XP Home Edition") {
  $os_returned = "XP Home"; }
else {}

if ($os == "Microsoft Windows XP Starter Edition") {
  $os_returned = "XP Starter"; }
else {}

if ($os == "Microsoft Windows XP Media Center Edition") {
  $os_returned = "XP MCE"; }
else {}

if ($os == "Microsoft Windows XP Tablet PC Edition") {
  $os_returned = "XP Tablet"; }
else {}

if ($os == "Microsoft Windows XP Professional x64 Edition") {
  $os_returned = "XP Pro 64"; }
else {}


if ($os == "Microsoft(R) Windows(R) Server 2003 Standard Edition") {
  $os_returned = "2003 Server, Std"; }
else {}

if ($os == "Microsoft(R) Windows(R) Server 2003, Standard Edition") {
  $os_returned = "2003 Server, Std"; }
else {}

if ($os == "Microsoft(R) Windows(R) Server 2003 Web Edition") {
  $os_returned = "2003 Server, Web"; }
else {}

if ($os == "Microsoft(R) Windows(R) Server 2003, Web Edition") {
  $os_returned = "2003 Server, Web"; }
else {}

if ($os == "Microsoft(R) Windows(R) Server 2003 for Small Business Server") {   
  $os_returned = "2003 Server, SBS"; }
else {}

if ($os == "Microsoft(R) Windows(R) Server 2003, for Small Business Server") {   
  $os_returned = "2003 Server, SBS"; }
else {}

if ($os == "Microsoft(R) Windows(R) Server 2003 Enterprise Edition") {
  $os_returned = "2003 Server, Ent"; }
else {}

if ($os == "Microsoft(R) Windows(R) Server 2003, Enterprise Edition") {
  $os_returned = "2003 Server, Ent"; }
else {}

if ($os == "Microsoft(R) Windows(R) Server 2003 Data Center Edition") {
  $os_returned = "2003 Server, Data"; }
else {}

if ($os == "Microsoft(R) Windows(R) Server 2003, Data Center Edition") {
  $os_returned = "2003 Server, Data"; }
else {}

return $os_returned;
}

?>