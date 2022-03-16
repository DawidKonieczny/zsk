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
      ?>
    </nav>
    <main>
      <article>
        <p>Sortowanie</p>
        <! –– Tu zostanie dodany system sortowania ––>
      </article>
      <table>
        <th>Id przelewu</th>
        <th>Do kogo przelew</th>
        <th>Tytuł przelewu</th>
        <th>Wartość przelewu</th>
        <th>Data przelewu</th>
        <th>Od kogo przelew</th>
        <?php
        require_once "connect.php";
        if ($_SESSION['type']>0)
        {
          $kwerenda="SELECT `id_history`,`endowed`,`title`,`amount`,`date`,`generous`FROM `historia`";
        }
        else
        {
          $kwerenda="SELECT `id_history`,`endowed`,`title`,`amount`,`date`,`generous`FROM `historia` WHERE `endowed` LIKE '$_SESSION[id]' OR `generous` LIKE '$_SESSION[id]' ";
        }
        $wynik= $connect -> query($kwerenda);
        while ($wiersz= $wynik -> fetch_assoc())
        {
          ?>
            <tr>
              <td><?= $wiersz["id_history"]; ?></td>
              <td><?= $wiersz["endowed"];?></td>
              <td><?= $wiersz["title"]?></td>
              <td><?= $wiersz["amount"]?></td>
              <td><?= $wiersz["date"]?></td>
              <td><?= $wiersz["generous"]?></td>
            </tr>
          <?php
        }



        ?>
      </table>
    </main>
  </body>
</html>
