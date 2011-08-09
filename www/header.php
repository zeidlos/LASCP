<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="css/style.css" rel="stylesheet" type="text/css" title="A++" />
</head>
<body>
<div id="wrapper">
	
<div id="header">
    <b>LASCP v0.3 &ndash;
    <?php
    echo "$server_name on ";
    echo $_SERVER['SERVER_ADDR'];
    echo '</b><br /><br />';
    ?>

    <ul class="navigation admin">
        <li class="home">
            <a href="index.php">Home</a>
        </li>
        <li class="settings">
            <a href="admin.php?action=settings">Settings</a>
        </li>
        <li class="users">
            <a href="admin.php?action=users">Usermanagement</a>
        </li>
        <li class="servers">
            <a href="admin.php?action=servers">Virtual Servers</a>
        </li>
        <li class="logout">
            <a href="index.php?action=logout">Log out</a>
        </li>

    </ul>
</div>

<div id="content">
