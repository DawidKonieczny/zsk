<?php
if (isset($_GET["id"]))
{
  require_once 'connect.php';
  session_start();
  if (is_null($_SESSION['id_przywileju']))
  {
    header('Location: logowanie.php?error=Zaloguj się ');
    exit();
  }
  if($_SESSION['id_przywileju']<1)
  {
    header('Location: ./');
    exit();
  }
  $kwerenda="DELETE FROM `konta` WHERE `konta`.`id` = " . $_GET['id'];
  $connect -> query($kwerenda);


  $kwerenda="DELETE FROM `uzytkownicy` WHERE `uzytkownicy`.`id` = " . $wynik];
  $connect -> query($kwerenda);
  if ($connect->affected_rows > 0)
  {
    header('Location: crud.php?error=Pomyślnie usunięto konto!');
    exit();
  }
  else
  {
    header('Location: przelew.php?error=Nie udało się usunąć konta..');
    exit();
  }

}
else {
  header('Location: crud.php');
}



 ?>
