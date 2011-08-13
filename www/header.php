<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="css/style.css" rel="stylesheet" type="text/css" title="A++" />
</head>
<body>
<div id="wrapper">
	
<div id="header">
    <?php
    echo('<b>LASCP v0.3 &ndash;');
    $login='yes';
    echo "$server_name on ";
    echo $_SERVER['SERVER_ADDR'];
    echo '</b><br /><br />';
    ?>

    <ul class="navigation admin">
        <li class="home">
            <a href="index.php">Home</a>
        </li>
        <li class="settings <?php if(!$login) { echo('inactive'); } ?>">
            <?php if($login) { echo('<a href="admin.php?actions=settings">'); } ?>Settings<?php if(!$login) { echo('</a>'); } ?>
        </li>
        <li class="users <?php if(!$login) { echo('inactive'); } ?>">
            <?php if($login) { echo('<a href="admin.php?actions=users">'); } ?>Usermanagement<?php if(!$login) { echo('</a>'); } ?>
        </li>
        <li class="servers <?php if(!$login) { echo('inactive'); } ?>">
            <?php if($login) { echo('<a href="admin.php?action=servers">'); } ?>Virtual Servers<?php if(!$login) { echo('</a>'); } ?>
        </li>
<?php if($login) {
        echo('<li class="logout"><a href="admin.php?action=logout">Log out</a></li>');
        } else {
        echo('<li class="login"><a href="admin.php?action=login">Login</a></li>');
        }
?>
    </ul>
</div>
<div id="content">