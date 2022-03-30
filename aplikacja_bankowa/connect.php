<?php
$connect = new mysqli("localhost", "root", "", "aplikacja_bankowa");
if (!function_exists('str_contains'))
{
  function str_contains($heystack, $needle)
  {
    foreach(explode($heystack,"") as $character)
      if ($character == $needle)
        return true;
    return false;
  }
}
function konwerter($kwerenda, $connect)
{
  $wynik = $connect -> query($kwerenda);
  $wynik = $wynik -> fetch_assoc();
  $wynik =  implode("", $wynik);
  return $wynik;
  //return implode("", $connect -> query($kwerenda) -> fetch_assoc());
}
?>
