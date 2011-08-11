<?php
$arma_dir ='/data/a2oa/';
$mirrors =array("six.bssnet.dk", "dev-heaven.net");
$mods =array("ace", "acex");
$rsync ='/usr/bin/rsync --times -O --no-whole-file -r --delete --progress -h --exclude=.rsync rsync://';
$cp ='/bin/cp -r';
$gunzip ='/bin/gunzip -r';
$i=0;

echo("Updating mods<br />");

for ($i = 0; $i <= 1; $i++){
shell_exec('sudo -u marsoc rm -r '.$arma_dir.'@'.$mods[$i].'');
echo("Updating $mods[$i]");
shell_exec('sudo -u marsoc '.$rsync.$mirrors[0].'/rel/'.$mods[$i].'/.pack/ /var/www/LASCP/mods/'.$mods[$i].'');
}

?>
