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

require_once('./inc/config.php');
// or die("Couldn't load config");
require_once ('./inc/functions.php');
// or die("Couldn't load functions");
$running=0;
$action='';
if(!empty($_GET)) { $action=$_GET["action"]; }
?>

<html>
<head><title>MARSOC Testserver - Mission Upload Tool</title>
<link href="./css/style.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold' rel='stylesheet' type='text/css'>
</head>
<body>

<div id="wrapper">
<img src="<?php echo($header_img); ?>" width="500px" />
<div id="content">
<?php
echo "<b>$server_name on ";
echo $_SERVER['SERVER_ADDR'];
echo '</b><br /><br />';

switch ($action) {
case 'update' : 
	$output = shell_exec('/usr/bin/sudo -u '.$sudo_user.' '.$arma_dir.'aceupdater');
	echo('Update complete');
	echo('<a href="index.php"><span class="button">Go back</span></a>');
	break;
case 'start' : 
	start_server($server_path);
	sleep(25); 
	echo('<span class="danger">Server started!</span>'); 
	echo('<a href="index.php"><span class="button">Go back</span></a>');
	break;
case 'stop' : 
	kill_server($server_path);
	sleep(5); 
	echo('<span class="danger">Server stopped!</span>');
	echo('<a href="index.php"><span class="button">Go back</span></a>'); 
	break;
case 'upload' :
	?>
	<h1 class="danger">Feature broken!</h1>
	<h2>PBO Files only.</h2>
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

	if ($file_type==''){echo("Something is broken<br />Please check upload_max_filesize in your php.ini<br /><br />");}	
	else {
	  if ($file_type=='application/octet-stream')
	  {
	    echo("$mission_name has been uploaded.<br /><br />");
	    move_uploaded_file($_FILES['mission_file']['tmp_name'], "./upload/$mission_name");
	    shell_exec('/usr/bin/sudo -u '.$sudo_user.' ./inc/cp_file.sh ./upload/'.$mission_name.'');
  	  } else {
	    echo("Wrong file format");
	  }
	}
	break;
case '' : 

 $running=check_pid($server_path);

if($running==1)
  {
    echo('Apparently the server runs at the moment.<br /> Get on Teamspeak, make sure noone is playing or <br /> testing on it. After you made 100% sure, you can<br /><br />');
    echo('<a href="index.php?action=stop"><span class="button danger">STOP THE SERVER!</span></a>');
  } else {
    echo('The server is not running. Now you can <br />');
    echo('<a href="index.php?action=upload"><span class="button">Upload a Mission</span></a><br />');
    echo('<a href="index.php?action=start"><span class="button">Start the server</span></a>');
    echo('<a href="index.php?action=update"><span class="button">Update the server</span></a>');
  }
break;
}
?>
</div>
</div>
