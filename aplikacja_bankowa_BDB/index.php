<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Strona Główna</title>
    <link rel="stylesheet" href="css.css">
  </head>
  <body>
    <?php require_once "header.php"; ?>
    <main>
      <article>
        <?php
        @session_start();
        echo <<< Dane
        $_SESSION[id]
        $_SESSION[username]
        $_SESSION[pwd]
        $_SESSION[id_przywileju]
        $_SESSION[amount]
        WHYYY??
        Dane;
         ?>
      </article>
    </main>
  </body>
</html>
