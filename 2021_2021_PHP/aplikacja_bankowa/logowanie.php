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

      <?php
    }
    ?>

    <article>
      <form action="logowanie.php" method="post">

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
      require_once "connect.php";
      if (!empty($_POST))
      {
        print_r($_POST);
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

        $haslo=password_hash($_POST['pwd'],PASSWORD_ARGON2I);
        $kwerenda = "SELECT `id` FROM `konta` WHERE `username` = '$_POST[username]'";
        $wynik=mysqli_query($connect,$kwerenda);
        var_dump($wynik);
        if (!$wynik)
          die($connect->error);

        @session_start();

        $kwerenda = "SELECT `amount`, `username`, `type`, `id`, `pwd`  FROM `konta` WHERE `username` = '$_POST[username]'";
        $res=mysqli_query($connect,$kwerenda);

        if(!$res)
        {
          die($connect->error);
        }

        $dane= mysqli_fetch_assoc($res);

        if(mysqli_num_rows($dane) == 1)
          die($connect->error);

        foreach ($dane as $key => $value)
          $_SESSION["$key"]=$value;

        header('Location: main.php?error=Zalogowno');
      }
    ?>

  </body>
</html>
