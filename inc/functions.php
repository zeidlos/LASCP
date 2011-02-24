<?php

function check_pid() 
{
  $pid_file = $server_path.'inc/server.pid';
  if (file_exists($pid_file))
  {
    $pid = shell_exec('cat '.$server_path.'inc/server.pid');
    return 1;
  }
}

function kill_server()
{
  $pid_file = $server_path.'inc/server.pid';
  if (file_exists($pid_file)) 
  {
    $pid = shell_exec('cat '.$server_path.'inc/server.pid'); 
    shell_exec("/usr/bin/sudo -u marsoc /bin/kill $pid");
    shell_exec('/usr/bin/sudo -u marsoc rm '.$server_path.'inc/server.pid');
  }
}

function start_server()
{
  $pid_file = shell_exec($server_path.'inc/server.pid');
  if (!file_exists($pid_file))
  {
    shell_exec('/usr/bin/sudo -u marsoc '.$server_path.'inc/run_server.sh');
  }
 }



?>

