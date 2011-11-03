<?php
/*
Linux Arm Server Control Pannel
Version: 0.2
Date: 2011-02-27
Author: Banshee
URL: http://tier1ops.eu

Linux Arma Server Control Pannel is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License. Permissions beyond the scope of this license may be available at http://going4.com.

http://creativecommons.org/licenses/by-nc-sa/3.0/
*/

function server_status()
{
  $server_status = shell_exec("ps aux | grep -v grep | grep arma2oaserver");
  return($server_status);
}

function stop_server($server_path)
{
  global $sudo_user;
  global $start_string;
  shell_exec('/usr/bin/sudo -u '.$sudo_user.' '.$server_path.'/inc/arma2oaserver stop');
}


function start_server($server_path)
{
    global $start_string;
    global $sudo_user;
    shell_exec(''.$server_path.'/inc/arma2oaserver start '.$start_string.' ');
 }


function start_server($server_path)
{
    global $start_string;
    global $sudo_user;
    shell_exec('/usr/bin/sudo -u '.$sudo_user.' '.$server_path.'inc/arma2oaserver start '.$start_string.' ');
 } 
?>

