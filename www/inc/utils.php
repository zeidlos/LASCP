<?php
function endsWith($str,$toFind) {
  $length = strlen($toFind);
  $start= $length*-1;
  return (substr($str,$start) === $toFind);
}
?>
