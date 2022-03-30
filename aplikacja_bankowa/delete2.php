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
  if($_SESSION['id_przywileju'] < 1)
  {
    header('Location: ./');
    exit();
  }
  $kwerenda="DELETE FROM `konta` WHERE `id_uzytkownika` = " . $_GET['id'];
  $connect -> query($kwerenda);
  $kwerenda="DELETE FROM `uzytkownicy` WHERE `id` = " . $_GET['id'];
  $connect -> query($kwerenda);

  if ($connect -> affected_rows > 0)
  {
    header('Location: crud.php?error=Pomyślnie usunięto konto i uzytkownika!');
    exit();
  }
  else
  {
    header('Location: crud.php?error=Nie udało się usunąć konta ani uzytkownika..');
    exit();
  }

}
else {
  header('Location: crud.php');
}
?>
