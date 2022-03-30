<nav>

  <?php
  session_start();
  if (is_null($_SESSION['id_przywileju']))
  {
    header('Location: logowanie.php?ty&error=Zaloguj się');
    exit();
  }
  else {
    function wylog()
    {
      session_destroy();
      header('Location: logowanie.php?error=Wylogowano pomyślnie');
      exit();
    }
    if (isset($_GET['wylog']))
    {
      wylog();
    }
    if ($_SESSION['id_przywileju']<1)
    {
      echo <<< p1
        <p><a href="przelew.php">Przelewy</a></p>
      p1;
    }
    if ($_SESSION['id_przywileju']<1)
    {
      echo <<< p1
        <p><a href="saldo.php">Saldo</a></p>
      p1;
    }
    if ($_SESSION['id_przywileju']>0)
    {
      echo <<< p1
        <p><a href="crud.php">Crud</a></p>
      p1;
    }
    echo <<< p1
      <p><a href="historia.php">Historia Przelewów</a></p>
    p1;
    echo <<< p1
      <p><a href="./?wylog=true">Wyloguj się</a></p>
    p1;
  }

  ?>
</nav>
