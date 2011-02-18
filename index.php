<?php
require_once ('./inc/functions.php');
$running=0;
?>

<html>
<head><title>MARSOC Testserver - Mission Upload Tool</title>
<link href="./css/style.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold' rel='stylesheet' type='text/css'>
</head>
<body>

<div id="wrapper">
<img src="http://dl.dropbox.com/u/2854558/MARSOC_MUT.png" width="500px" />
<div id="content">
<?php $running=check_pid();

if($running==1)
  {
    echo('Apparently the server runs at the moment.<br /> Get on Teamspeak, make sure noone is playing or <br /> testing on it. After you made 100% sure, you can<br /><br />');
    echo('<span class="danger"><a href="index.php?action=stop">STOP THE SERVER!</a></span>');
  } else {
    echo('The server is not running. Now you can <br />');
    echo('<a href="index.php?action=upload"><span class="button">Upload a Mission</span></a><br />');
    echo('<a href="index.php?action=start"><span class="button">Start the server</span></a>');
  }
?>
</div>
</div>
