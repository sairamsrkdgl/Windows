<?php

function return_unknown($something)
{
  if ($something == "") { $something = "unknown"; } else {}
  if ($something == NULL) { $something = "unknown"; } else {}
  return $something;
}
  
function ip_trans($ip)
{
  if (($ip <> "") AND (!(is_null($ip)))){
   $myip = explode(".",$ip);
   $myip[0] = ltrim($myip[0], "0");
   if ($myip[0] == "") { $myip[0] = "0"; }
   $myip[1] = ltrim($myip[1], "0");
   if ($myip[1] == "") { $myip[1] = "0"; }
   $myip[2] = ltrim($myip[2], "0");
   if ($myip[2] == "") { $myip[2] = "0"; }
   $myip[3] = ltrim($myip[3], "0");
   if ($myip[3] == "") { $myip[3] = "0"; }
   $ip = $myip[0] . "." . $myip[1] . "." . $myip[2] . "." . $myip[3];
  } else {
   $ip = " Not networked";
  }
  return $ip;
}

function url_clean($url)
{
$url_clean = str_replace ('%','%25',$url);
$url_clean = str_replace ('$','%24',$url_clean);
$url_clean = str_replace (' ','%20',$url_clean);
$url_clean = str_replace ('+','%2B',$url_clean);
$url_clean = str_replace ('&','%26',$url_clean);
$url_clean = str_replace (',','%2C',$url_clean);
$url_clean = str_replace ('/','%2F',$url_clean);
$url_clean = str_replace (':','%3A',$url_clean);
$url_clean = str_replace ('=','%3D',$url_clean);
$url_clean = str_replace ('?','%3F',$url_clean);
$url_clean = str_replace ('<','%3C',$url_clean);
$url_clean = str_replace ('>','%3E',$url_clean);
$url_clean = str_replace ('#','%23',$url_clean);
$url_clean = str_replace ('{','%7B',$url_clean);
$url_clean = str_replace ('}','%7D',$url_clean);
$url_clean = str_replace ('|','%7C',$url_clean);
$url_clean = str_replace ('\\','%5C',$url_clean);
$url_clean = str_replace ('^','%5E',$url_clean);
$url_clean = str_replace ('~','%7E',$url_clean);
$url_clean = str_replace ('[','%5B',$url_clean);
$url_clean = str_replace (']','%5D',$url_clean);
$url_clean = str_replace ('`','%60',$url_clean);
return $url_clean;
}

function return_date($timestamp)
{
$timestamp = substr($timestamp, 0, 4) . "-" . substr($timestamp, 4, 2) . "-" . substr($timestamp, 6, 2);
return $timestamp;
}

function return_date_time($timestamp)
{
$timestamp = substr($timestamp, 0, 4) . "-" . substr($timestamp, 4, 2) . "-" . substr($timestamp, 6, 2) . "&nbsp;&nbsp;&nbsp;&nbsp;" . substr($timestamp, 8, 2) . ":" . substr($timestamp, 10, 2);
return $timestamp;
}
?>