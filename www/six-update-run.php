<?php

# Tier1 Linux Server Control Pannel
# Version: 0.01 POC
# Date: 2011-07-22
# Author: BoSSMan_DK
# Inspiration: ACE Update script for linux - by Dr.Pulp - www.FAKKer.de
# URL: http://tier1ops.eu

# So the idea is to wrap rsync so that the updater can give outpout while updating
# Helps non server admins to see if anything goes wrong
# This should also be wrapped in a function or class so you can maintain more than
# one set of servers and/or mods

# TODO:
# 1. Processing of keys, missions and userconfig - DONE
# 2. Error handling
# 2a. rsync
# 2b. copy
# 2c. mkdir
# 2d. mirror access
# 3. Mirror selection function (based on ping?) - Now random
# 4. Remove old files - DONE
# 5. Integration with LASCP - Semi done
# 5a. Config - DONE
# 5b. GUI stuff - DONE
# 6. Code cleanup - Debug Commented lines gone
# 7. Functionalize shell_exec -> generalised function
# 8. Multi server support ?


# First do the HTML stuff
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';

# Grab the config
require_once('inc/config.php');

echo '
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <link href="css/style.css" rel="stylesheet" type="text/css" title="A++" />
	<script type="text/javascript">
	(function() {
    var timer = setInterval(scrollIt, 1);
    function scrollIt() {
        window.scrollBy(0, 10);
    }

    //Once the page has fully loaded, stop calling it.
    body.onload = function() {
        clearInterval(timer);
    }
})();

	</script>
</head>
<body>
<div id="wrapper">

        </div>

        <div id="header">
    <div id="header_img">';
echo '<img border=0 src="'. $header_img .'">';
echo '      &nbsp;';
echo '    </div>

        </div>

<div id="updater">';

echo "<h3>Processing mods syncronisation ... </h3>";
# Loop and process all mods
foreach ($mods as $mod) {
  echo "Working on: ". $mod;
  echo "<br />\n";
  flush_buffers();

  # Remove the mod folder from armadir
  $rmout = shell_exec( $sucmd . $rmcmd . $armadir ."/@". $mod);

# Do the rSync stuff - spawn shell
  $rsyncline = $sucmd . $rsynccmd . selectMirror($mirrorlist) ."/rel/". $mod ."/./.pack/ ". $syncdir ."/@". $mod;
  $output = shell_exec($rsyncline);
  echo "<pre>". $output ."</pre><br />\n";

  flush_buffers();
  # Now put them in the right folder
  echo "Copy ". $mod ."to destination: ". $armadir ."/@". $mod ."<br />\n";
  $cpline = $sucmd . $cpcmd . $syncdir ."/@". $mod ." ". $armadir;
  $cpoutput = shell_exec( $cpline);

  flush_buffers();
  # And extract
  echo "Decompress ". $mod ."in destination folder: ". $armadir ."/@". $mod ."<br />\n";
  $decompline = $sucmd . $decompcmd . $armadir ."/@". $mod ."/*";
  $deoutput = shell_exec( $decompline);

  echo "Done with: ". $mod;
  echo "<br />\n";
}
flush_buffers();
# Loop done

# Make the new files linux server compatiple
$str = shell_exec($sucmd . $armadir ."/tolower");

# Now do the keys++
echo "<h3>Processing keys, missions and userconfig ... </h3>";
flush_buffers();
# Now loop the mods again
foreach ($mods as $mod) {
  echo "Working on: ". $mod;
  echo "<br />\n";

  echo "Copy ". $mod ." keys to destination: ". $armadir ."/keys";
  echo "<br />\n";
  flush_buffers();

  # Overwriting varibles here - don't need them
  if ( is_dir($armadir ."/@". $mod ."/keys") ) {
    $cpline = $sucmd . $cpcmd . $armadir ."/@". $mod ."/keys/* ". $armadir ."/keys";
    $cpoutput = shell_exec( $cpline);
  }
  flush_buffers();

  # Overwriting varibles here - don't need them
  if ( is_dir($armadir ."/@". $mod ."/store/keys") ) {
    $cpline = $sucmd . $cpcmd . $armadir ."/@". $mod ."/store/keys/* ". $armadir ."/keys";
    $cpoutput = shell_exec( $cpline);
  }
  flush_buffers();

  # MPMissions
  echo "Copy ". $mod ." mpmissions to destination: ". $armadir ."/mpmissions/". $mod;
  echo "<br />\n";
  flush_buffers();

  # Overwriting varibles here - don't need them
  if ( is_dir($armadir ."/@". $mod ."/mpmissions") ) {
    $cpline = $sucmd . $cpcmd . $armadir ."/@". $mod ."/mpmissions/* ". $armadir ."/mpmissions";
    $cpoutput = shell_exec( $cpline);
  }
  flush_buffers();

  # Now for the userconfigs we might need to create directories on $armadir /userconfig
  echo "Copy ". $mod ." userconfigs to destination: ". $armadir ."/userconfig/". $mod;
  echo "<br />\n";
  flush_buffers();

  # Overwriting varibles here - don't need them
  if ( is_dir($armadir ."/@". $mod ."/userconfig") ) {
    # Make the dir if it's not there
    if (! is_dir($armadir ."/userconfig/". $mod) ) { shell_exec( $sucmd . "mkdir ". $armadir ."/userconfig/". $mod); }
    $cpline = $sucmd . $cpcmd . $armadir ."/@". $mod ."/userconfig/* ". $armadir ."/userconfig/". $mod;
    $cpoutput = shell_exec( $cpline);
  }
  

}

echo '</div>';
echo '<div id="content">';
echo "<h3>--- Done ---</h3>";
echo('<p class="success">Update complete</p>');
echo('<a href="index.php"><span class="button">Go back</span></a>');


# Select random mirror from the list of mirrors in config file
# Would like to improve to select the fastest mirror instead
# but that is rather complicated
# So I locked it the fastest mirror from the server
function selectMirror($mirrorlist) {
  $select = rand(0, count($mirrorlist) - 1);
#  echo "Using Mirror: ". $mirrorlist[$select] ."<br />\n";
  return $mirrorlist[$select];
  #return "six.bssnet.dk";
}
function flush_buffers(){ 
    ob_end_flush(); 
    flush(); 
    ob_start(); 
} 

require_once('footer.php');
?>
