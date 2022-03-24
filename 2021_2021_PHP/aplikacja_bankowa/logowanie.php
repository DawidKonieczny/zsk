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
      session_start();
      ?>
        <p><?= $_GET["error"];?></p><br>
        <p><?= $_SESSION['type'];?></p><br>

      <?php
    }
    ?>

    <article>
      <form action="" method="post">

        <label>
          Nazwa użytkownika
          <input type="text" name="username">
        </label><br>

        <label>
          Hasło
          <input type="password" name="pwd">
        </label><br>

        <label>
          <input type="submit" name="zatwierdz" value="zatwierdź">
        </label><br>
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
              header('Location: logowanie.php?error=Wypełnij pole ' . $key);
              exit();
            }
            $_POST["$key"]=trim($_POST["$key"]);
            if (str_contains($_POST["$key"], ';'))
            {
              header('Location: rejestracja.php?error=Pole' . $key.'zawiera niepoprawną wartość');
              exit();
            }
        }
        require_once "connect.php";
        $haslo=password_hash($_POST['pwd'],PASSWORD_ARGON2I);
        $kwerenda = "SELECT `id` FROM `konta` WHERE `username` LIKE '$_POST[username]' && `pwd` LIKE '$haslo'";
        $wynik=mysqli_query($connect,$kwerenda);
        if (is_null($wynik))
        {
          header('Location: logowanie.php?error=Błędny login lub hasło');

        }
        else
        {
          session_start();
          $kwerenda = "SELECT `amount` FROM `konta` WHERE `username` LIKE '$_POST[username]' && `pwd` LIKE '$haslo'";
          $res=mysqli_query($connect,$kwerenda);
          $dana= mysqli_fetch_assoc($res);
          $_SESSION['amount']= $dana[0];
          $kwerenda = "SELECT `username` FROM `konta` WHERE `username` LIKE '$_POST[username]' && `pwd` LIKE '$haslo'";
          $res=mysqli_query($connect,$kwerenda);
          $dana= mysqli_fetch_assoc($res);
          $_SESSION['username']=$dana[0];
          $kwerenda = "SELECT `type` FROM `konta` WHERE `username` LIKE '$_POST[username]' && `pwd` LIKE '$haslo'";
          $res=mysqli_query($connect,$kwerenda);
          $dana= mysqli_fetch_assoc($res);
          $_SESSION['type']=$dana[0];
          $kwerenda = "SELECT `id` FROM `konta` WHERE `username` LIKE '$_POST[username]' && `pwd` LIKE '$haslo'";
          $res=mysqli_query($connect,$kwerenda);
          $dana= mysqli_fetch_assoc($res);
          $_SESSION['id']=$dana[0];
          $kwerenda = "SELECT `pwd` FROM `konta` WHERE `username` LIKE '$_POST[username]' && `pwd` LIKE '$haslo'";
          $res=mysqli_query($connect,$kwerenda);
          $dana= mysqli_fetch_assoc($res);
          $_SESSION['pwd']=$dana[0];
          header('Location: main.php?error=Zalogowno');
        }
      }
    ?>

  </body>
</html>
