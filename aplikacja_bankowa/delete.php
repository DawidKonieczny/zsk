<?php
if (isset($_GET["id"]))
{
  require_once 'connect.php';
  if (is_null($_SESSION['type']))
  {
    header('Location: logowanie.php?error=Zaloguj się');
    exit();
  }
  if($_SESSION['id']<1)
  {
    header('Location: main.php');
    exit();
  }
  $kwerenda="DELETE FROM `konta` WHERE `konta`.`id` = " . $_GET['id'];
  $connect -> query($kwerenda);
  if ($connect->affected_rows > 0)
  {
    header('Location: crud.php?error=Pomyślnie usunięto użytkownika!');
    exit();
  }
  else
  {
    header('Location: przelew.php?error=Nie udało się usunąć użykwonika..');
    exit();
  }

}
else {
  header('Location: crud.php')
}



 ?>
