<?php
/*
MARSOC Server Control Pannel
Version: 0.2
Date: 2011-02-27
Author: Banshee
URL: http://going4.com

MARSOC Server Control Pannel is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License. Permissions beyond the scope of this license may be available at http://going4.com.

http://creativecommons.org/licenses/by-nc-sa/3.0/
*/


include($server_path.'inc/config.php');

function check_pid($server_path) 
{
  $pid_file = $server_path.'inc/server.pid';
  if (file_exists($pid_file))
  {
    $pid = shell_exec('cat '.$server_path.'inc/server.pid');
    return 1;
  }
}

function kill_server($server_path)
{
  $pid_file = $server_path.'inc/server.pid';
  if (file_exists($pid_file)) 
  {
    $pid = shell_exec('cat '.$server_path.'inc/server.pid'); 
    shell_exec("/usr/bin/sudo -u marsoc /bin/kill $pid");
    shell_exec('/usr/bin/sudo -u marsoc rm '.$server_path.'inc/server.pid');
  }
}

function start_server($server_path, $modlist)
{
  $pid_file = $server_path.'inc/server.pid';
  if (!file_exists($pid_file))
  {
    shell_exec('/usr/bin/sudo -u marsoc '.$server_path.'inc/run_server.sh "'. $modlist .'"');
  }
 }

?>

