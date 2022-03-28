<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Strona Główna</title>
    <link rel="stylesheet" href="css.css">
  </head>
  <body>
    <?php
    require_once "header.php";
    require_once "connect.php"; ?>
    <main>
     <article>
      <p>Przelew</p><br>
      <?php
      if (isset($_GET["error"]))
      {
        ?>
          <p><?= $_GET["error"];?></p><br>
        <?php
      }

      ?>
      <form action="przelew.php" method="post">
        <label>
          Podaj numer konta na który chcesz wysłać przelew
          <input type="text" name="endowed">
        </label><br>
        <label>
          Podaj tytuł przelwu
          <input type="text" name="title">
        </label><br>
        <label>
          Podaj ilość którą chcesz przelać
          <input type="text" name="amount">
        </label><br>
        <input type="submit" name="zatwierdz" value="wyślij">
      </form>
      <?php

      if (!empty($_POST))
      {
          foreach($_POST as $key => $value)
          {
              if (empty($value))
              {
                header('Location: przelew.php?error=Wypełnij pole ' . $key);
                exit();
              }
              $_POST["$key"]=trim($_POST["$key"]);
              if (str_contains($_POST["$key"], ';'))
              {
                header('Location: przelew.php?error=Pole' . $key.'zawiera niepoprawną wartość');
                exit();
              }
          }
          require_once "connect.php";

          $amountt = str_replace(",", ".", $_POST['amount']);

          $kwerenda = "SELECT `amount` FROM `konta` WHERE `username` = '$_SESSION[username]'";
          $_SESSION['amount'] = konwerter($kwerenda, $connect);
          print_r($_SESSION['amount']);

          if (!preg_match ("/^[0-9]*$/", $_POST['amount']))
          {
            header('Location: przelew.php?error=Niepowrawna wartość przelewu');
            exit();
          }


          if( 0 > $_POST['amount'])
          {
            header('Location: przelew.php?error=Niepowrawna wartość przelewu');
            exit();
          }


          if($_SESSION['amount'] < $_POST['amount'])
          {
            header('Location: przelew.php?error=Niewystarczająca ilośc środków');
            exit();
          }

          $kwerenda = "INSERT INTO `historia`(`id_history`, `endowed`, `title`, `amount`, `generous`) VALUES ( NULL,'$_POST[endowed]','$_POST[title]','$amountt','$_SESSION[id]')";
          $connect -> query($kwerenda);
          if ($connect->affected_rows < 1)
          {
            header("Location: przelew.php?error=Nie zaksięgowano przelewu $_SESSION[amount]");
            exit();
          }
          $_SESSION['amount']=$_SESSION['amount']-$_POST['amount'];
          $kwerenda = " UPDATE `konta` SET `amount` = '$_SESSION[amount]' WHERE `konta`.`id` = '$_SESSION[id]'";
          $connect -> query($kwerenda);

          if ($connect->affected_rows > 0)
          {
            header('Location: przelew.php?error=Przelew powiódł się!');
            exit();
          }
          else
          {
            header('Location: przelew.php?error=Przelew nie powiódł się..');
            exit();
          }
      }

      ?>
     </article>
    </main>
  </body>
</html>
