<?php

include_once 'header.php';

require_once('./inc/config.php');
//or die("Couldn't load config");
require_once ('./inc/functions.php');
//or die("Couldn't load functions");
$running=0;
$action='';
if(!empty($_GET)) { $action=$_GET["action"]; }

switch ($action) {

    case 'settings' :
        echo('<h2>Settings</h2>'); 
        break;

    case 'users' :
        echo('<h2>Usermanagement</h2>');
        break;

    case 'servers' : 
        echo('<h2>Virtual Server Management</h2>');
        break;

    case 'logout' : 
//        logout();
        // TODO Write logout function and enable it.
        echo('<h2 class="success">Logout is not working yet!</h2>');
        break;
    
    case 'login' :
        login();
        echo('<h2 class="success">You are now logged in as '.$username.'. </h2>');
        break;
    }

include_once 'footer.php';
?>
