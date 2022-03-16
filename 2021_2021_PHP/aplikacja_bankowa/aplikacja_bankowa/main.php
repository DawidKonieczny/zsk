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
      if (isset($_GET["error"]))
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
        if ($_SESSION['type']>0)
        {
          echo <<< p1
            <p><a href="crud.php">Crud</a></p>
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
      <article>
        Póki co nic tu nie ma
      </article>
    </main>
  </body>
</html>
