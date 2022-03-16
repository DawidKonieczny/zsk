<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Saldo</title>
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
      <p>Stan twojego konta wynosi</p><br>
      <?php
      session_start();
      echo <<< p1

      <p>$_SESSION['amount'] zł</p>
      p1;

      ?>
    </main>

  </body>
</html>
