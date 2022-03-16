<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Logowanie</title>
    <link rel="stylesheet" href="css.css">
  </head>
  <body>
    <?php
    if (isset($_GET["error"]))
    {
      ?>
        <p><?= $_GET["error"];?></p>
      <?php
    }
    ?>

    <article>
      <form action="" method="post">

        <label>
          Nazwa użytkownika
          <input type="text" name="username">
        </label>

        <label>
          Hasło
          <input type="text" name="password">
        </label>

        <label>
          <input type="submit" name="zatwierdz" value="zatwierdź">
        </label>
      </form>
      <div>
        Nie masz konta? <a href="rejestracja.php">Zarejestruj się!</a>
      </div>
    </article>
    <?php

      if (!empty($_POST))
      {
        foreach($_POST as $key => $value)
        {
            if (empty($value))
            {
              header('Location: logowanie.php?info&error=Wypełnij pole ' . $key);
              exit();
            }
        }
        require_once "connect.php";
        $haslo=password_hash($_POST['password'],PASSWORD_ARGON2I);
        $kwerenda = "SELECT COUNT(`id`) FROM `konta` WHERE `username` LIKE '$_POST[username]' && `password` LIKE '$haslo'";
        $wynik = $connect -> query($kwerenda);
        if ($wynik>0)
        {
          session_start();
          $kwerenda = "SELECT `amount` FROM `konta` WHERE `username` LIKE '$_POST[username]' && `password` LIKE '$haslo'";
          $_SESSION['amount']= $connect -> query($kwerenda);
          $kwerenda = "SELECT `username` FROM `konta` WHERE `username` LIKE '$_POST[username]' && `password` LIKE '$haslo'";
          $_SESSION['username']= $connect -> query($kwerenda);
          $kwerenda = "SELECT `type` FROM `konta` WHERE `username` LIKE '$_POST[username]' && `password` LIKE '$haslo'";
          $_SESSION['type']= $connect -> query($kwerenda);
          $kwerenda = "SELECT `id` FROM `konta` WHERE `username` LIKE '$_POST[username]' && `password` LIKE '$haslo'";
          $_SESSION['id']= $connect -> query($kwerenda);
          header('Location: main.php?error=Zalogowno');
        }
        else
        {
          header('Location: logowanie.php?info&error=Błędny login lub hasło');
        }
      }
    ?>

  </body>
</html>
