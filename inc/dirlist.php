<?php
/*
MARSOC Server Control Pannel
Version: 0.2
Date: 2011-02-28
Author: Banshee & BoSSMan_DK
URL: http://going4.com

MARSOC Server Control Pannel is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License. Permissions beyond the scope of this license may be available at http://going4.com.

http://creativecommons.org/licenses/by-nc-sa/3.0/
*/

require_once('config.php');
//$arma_dir = '/data/a2oa/';

$mod_ena = '';

//echo('Directory: ' . $arma_dir . '<br />');

echo('<form>');
echo('<table><tr><th>Enabled</th><th>Mod</th></tr>');

if (is_dir($arma_dir)) {
    if ($dh = opendir($arma_dir)) {
        while (($file = readdir($dh)) !== false) {
           if (filetype($arma_dir . $file) == "dir" && substr($file, 0, 1) == "@" ) {
                echo('<tr><td><input type=checkbox '. $mod_ena .'></td>');
		echo('<td>' . $file . '</td></tr>');
           }
        }
        closedir($dh);
    }
}

echo('</table>');
echo('</form>');
?>
