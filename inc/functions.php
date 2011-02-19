<?php

function check_pid() 
{
  $pid_file = '/var/www/admin/inc/server.pid';
  if (file_exists($pid_file))
  {
    $pid = shell_exec("cat /var/www/admin/inc/server.pid");
    return 1;
  }
}

function kill_server()
{
  $pid_file = '/var/www/admin/inc/server.pid';
  if (file_exists($pid_file)) 
  {
    $pid = shell_exec("cat /var/www/admin/inc/server.pid"); 
    shell_exec("/usr/bin/sudo /bin/kill $pid");
    shell_exec("/usr/bin/sudo rm /var/www/admin/inc/server.pid");
  }
}

function start_server()
{
  $pid_file = shell_exec("/var/www/admin/inc/server.pid");
  if (!file_exists($pid_file))
  {
    shell_exec("/usr/bin/sudo /var/www/admin/inc/run_server.sh");
  }
 }



?>

