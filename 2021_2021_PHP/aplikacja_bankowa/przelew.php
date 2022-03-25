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
          session_start();
          require_once "connect.php";
          $amountt = str_replace(",", ".", $_POST['amount']);
          $kwerenda="INSERT INTO `historia`(`id_history`, `endowed`, `title`, `amount`, `date`, `generous`) VALUES ( NULL,'$_POST[endowed]','$_POST[title]','$amountt', NULL,'$_SESSION[id]')";
          $connect -> query($kwerenda);
          $kwerenda = "SELECT `amount` FROM `konta` WHERE `username` = '$_SESSION[username]'";
          $_SESSION['amount']= $connect -> query($kwerenda);
          if($_SESSION['amount'] < $_POST['amount'])
          {
            die ( $connect -> error ) ;
          }
          $_SESSION['amount']=$_SESSION['amount']-$_POST['amount'];
          $kwerenda=" UPDATE `konta` SET `amount` = '$_SESSION[amount]' WHERE `konta`.`id` = '$_SESSION[id]'";
          $connect -> query($kwerenda);
          if ($connect->affected_rows > 0)
          {
            header('Location: przelew.php?error=Przelew powiódł się!');
          }
          else
          {
            header('Location: przelew.php?error=Przelew nie powiódł się..');
          }
      }

      ?>
    </main>
  </body>
</html>
