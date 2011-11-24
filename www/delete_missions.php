<?php
require_once('./inc/config.php');
require_once('header.php');
?>

<?php

if(!file_exists($arma_deleted_missions_dir)) {
  mkdir($arma_deleted_missions_dir,0770);
}

if(isset($_POST['missions'])) {
  $missions=$_POST['missions'];
  foreach($missions as $i => $mission) {
    $was_deleted=rename($arma_missions_dir.'/'.$mission,$arma_deleted_missions_dir.'/'.$mission);
    if($was_deleted==true) {
      echo "<p>Mission $mission was deleted</p>";
    } else {
      echo "<p>Mission $mission could not be deleted</p>";
    }
  }
}
?>
