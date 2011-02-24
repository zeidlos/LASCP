<?php
require_once ('./inc/functions.php');
require_once('./inc/config.php');
$running=0;
$action='';
$action=$_GET["action"];
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

case 'start' : 
	start_server();
	sleep(15); 
	echo('<span class="danger">Server started!</span>'); 
	echo('<a href="index.php"><span class="button">Go back</span></a>');
	break;
case 'stop' : 
	kill_server();
	sleep(5); 
	echo('<span class="danger">Server stopped!</span>');
	echo('<a href="index.php"><span class="button">Go back</span></a>'); 
	break;
case 'upload' :
	?>
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
	
	if ($file_type=='application/octet-stream')
	{
	  echo("$mission_name has been uploaded.<br /><br />");
	  move_uploaded_file($_FILES['mission_file']['tmp_name'], "./upload/$mission_name");
	  shell_exec("/usr/bin/sudo -u marsoc ./inc/cp_file.sh ./upload/$mission_name");
	} else {
	  echo("Wrong file format");
	}
	break;
case '' : 

 $running=check_pid();

if($running==1)
  {
    echo('Apparently the server runs at the moment.<br /> Get on Teamspeak, make sure noone is playing or <br /> testing on it. After you made 100% sure, you can<br /><br />');
    echo('<a href="index.php?action=stop"><span class="button danger">STOP THE SERVER!</span></a>');
  } else {
    echo('The server is not running. Now you can <br />');
    echo('<a href="index.php?action=upload"><span class="button">Upload a Mission</span></a><br />');
    echo('<a href="index.php?action=start"><span class="button">Start the server</span></a>');
  }
break;
}
?>
</div>
</div>
