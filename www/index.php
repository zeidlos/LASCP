<?php
/*
Tier1 Server Control Pannel
Version: 0.4
Date: 2011-02-27
Author: Banshee
Edit: BoSSMan_DK - 2011-08-09
URL: http://tier1ops.eu

Tier1 Server Control Pannel is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License. Permissions beyond the scope of this license may be available at http://going4.com.

http://creativecommons.org/licenses/by-nc-sa/3.0/
*/

require_once('./inc/config.php');
//or die("Couldn't load config");
require_once ('./inc/functions.php');
//or die("Couldn't load functions");
$running=0;
$action='';
if(!empty($_GET)) { $action=$_GET["action"]; }

 require_once('header.php');
 
 

 
switch ($action) {

    case 'update' :
            echo('<p class="danger">Please do not reload or leave this page. <br />This may take several minutes.</p>'); 
            echo "<script language='javascript'> window.location = \"index.php?action=update2\";</script>";
            break;
    case 'update2' :
            $output = shell_exec('/usr/bin/sudo -u '.$sudo_user.' '.$arma_dir.'aceupdater');
            echo('<p class="success">Update complete</p>');
            echo('<a href="index.php"><span class="button">Go back</span></a>');
            break;

    case 'start' : 
            start_server($server_path);
            $server_status = server_status();
            while(!$server_status) 
            {
              $server_status = server_status();
              sleep(5);
            }
            $server_status = server_status();
            if ($server_status);
            { 
              echo('<span class="success">Server started!</span>'); 
              echo('<a href="index.php"><span class="button">Go back</span></a>');
            }
            break;

    case 'stop' : 
            stop_server($server_path);
            sleep(5);
            echo('<span class="success">Server stopped!</span>');
            echo('<a href="index.php"><span class="button">Go back</span></a>'); 
            break;
    case 'upload' :
            ?>
            <h2>Upload PBO Files only.</h2>
            <form action="index.php?action=proccess_file" method="POST" enctype="multipart/form-data">
            <input type="file" name="mission_file"><br />
            <input type="submit" value="upload">
            </form>
            <?php 
            break;

    case 'proccess_file' :
            $mission_name = $_FILES['mission_file']['name'];
            $mission_name = strtolower($mission_name);
            $file_type = $_FILES['mission_file']['type'];

            if ($file_type==''){echo('<p class="danger">Something is broken<br />Please check upload_max_filesize in your php.ini</p><br /><br />');}	
            else {
              if ($file_type=='application/octet-stream')
              {
                echo("<p class=\"success\">$mission_name has been uploaded.</p><br /><br />");
                move_uploaded_file($_FILES['mission_file']['tmp_name'], "./uploads/$mission_name");
              } else {
                echo("<p class=\"danger\">Wrong file format</p><br /><br />");
                echo('<a href="index.php?action=upload"><span class="button">Try again</span></a>');
              }
            }
            echo('<a href="index.php"><span class="button">Go back</span></a>');
            break;

    case '' : 
            if($login) {
                $server_status = server_status();
                if($server_status)
                {
                  echo('Apparently the server runs at the moment.<br /> Get on Teamspeak, make sure noone is playing or <br /> testing on it. After you made 100% sure, you can<br /><br />');
                  echo('<a href="index.php?action=stop"><span class="button danger">STOP THE SERVER!</span></a>');
                } 
                  else 
                {
                  echo('The server is not running. Now you can <br />');
                  echo('<a href="index.php?action=upload"><span class="button">Upload a Mission</span></a><br />');
                  echo('<a href="list_missions.php"><span class="button">List Missions</span></a>');
                  echo('<a href="index.php?action=start"><span class="button">Start the server</span></a>');
                  echo('<a href="six-update-run.php"><span class="button">Update the server</span></a>');
        //	  echo('<a href="index.php?action=update"><span class="button">Update the server</span></a>');
                }
            } else {
                if(!$login) { echo('<span class="danger">You are not logged in!</span>');
                }
            }
            break;           
    }
require ('footer.php');
?>
