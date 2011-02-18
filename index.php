<?php
require_once ('./inc/functions.php');
$running=0;
?>

<html>
<head><title>MARSOC Testserver - Mission Upload Tool</title>


</head>
<body>

<div id="wrapper">
<h1>Welcome to the MARSOC Testserver Mission Upload Tool</h1>
<?php $running=check_pid();

if($running==1)
  {
    echo('Apparently the server runs at the moment.<br /> Get on Teamspeak, make sure noone is playing or <br /> testing on it. After you made 100% sure, you can<br /><br />');
    echo('<span class="danger"><a href="index.php?action=stop">STOP THE SERVER!</a></span>');
  } else {
    echo('The server is not running. Now you can <br />');
    echo('<a href="index.php?action=upload">Upload a Mission</a><br />');
    echo('<a href="index.php?action=start">Start the server</a>');
  }
?>
</div>
