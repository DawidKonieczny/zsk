<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Strona Główna</title>
    <link rel="stylesheet" href="css.css">
  </head>
  <body>
    <nav>

      <?php
      if (true)
      {
        session_start();
        function wylog()
        {
          session_destroy();
          header('Location: logowanie.php?info&error=Wylogowano pomyślnie');
        }
        if ($_SESSION['type']<1)
        {
          echo <<< p1
            <p><a href="przelew.php">Przelewy</a></p>
          p1;
        }
        if ($_SESSION['type']<1)
        {
          echo <<< p1
            <p><a href="saldo.php">Saldo</a></p>
          p1;
        }
        echo <<< p1
          <p><a href="historia.php">Historia Przelewów</a></p>
        p1;
        echo <<< p1
          <input type="button" name="Wyloguj" onclick="<?= wylog();?>" value="Wyloguj">
        p1;
      }
      else {
        header('Location: logowanie.php?info&error=Zaloguj się');
      }
      ?>
    </nav>
    <main>
      <p>Przelew</p>
      <?php
      if (isset($_GET["error"]))
      {
        ?>
          <p><?= $_GET["error"];?></p>
        <?php
      }

      ?>
      <form action="" method="post">
        <label>
          Podaj numer konta na który chcesz wysłać przelew
          <input type="text" name="endowed">
        </label>
        <label>
          Podaj tytuł przelwu
          <input type="text" name="title">
        </label>
        <label>
          Podaj ilość którą chcesz przelać
          <input type="text" name="amount">
        </label>
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
          }
          session_start();
          require_once "connect.php";
          $kwerenda="INSERT INTO `historia`(`id_history`, `endowed`, `title`, `amount`, `date`, `generous`) VALUES ( NULL,'$_POST[endowed]','$_POST[title]','$_POST[amount]', NULL,'$_SESSION[id]')";
          $connect -> query($kwerenda);
          $kwerenda = "SELECT `amount` FROM `konta` WHERE `username` LIKE '$_SESSION[username]'";
          $_SESSION['amount']= $connect -> query($kwerenda);
          $_SESSION['amount']=$_SESSION['amount']-$_POST['amount'];
          $kwerenda ="UPDATE `konta` SET `amount` = '$_SESSION[amount]' WHERE `konta`.`id` = '$_SESSION[id]'; "
          $connect -> query($kwerenda);
          if ($connect->affected_rows > 0)
          {
            header('Location: rejestracja.php?error=Przelew powiódł się!');
          }
          else
          {
            header('Location: rejestracja.php?error=Przelew nie powiódł się..');
          }
      }

      ?>
    </main>
  </body>
</html>
