<?php
$connect = new mysqli("localhost", "root", "", "aplikacja_bankowa");
$connection = new mysqli("localhost", "root", "", "aplikacja_bankowa");
function str_contains($heystack, $needle)
{
  foreach(explode($heystack,"") as $character)
    if ($character == $needle)
      return true;
  return false;
}
 ?>
