<?php
require_once('./inc/config.php');
require_once('./inc/utils.php');
require_once('header.php');
?>

<form method="post" action="delete_missions.php">

<div id="missions_list">
<?php

function isMission($file) {
  return endsWith(strtolower($file),'.pbo');
}

$files=scandir($arma_missions_dir);

foreach($files as $index => $file) {
  if(isMission($file)) {
    echo "<input type='checkbox' name='missions[]' value='$file'>$file</input><br/>";
  }
}

?>
</div>
<input type="submit" value="Delete missions"/>
</form>

<?php require ('footer.php'); ?>
