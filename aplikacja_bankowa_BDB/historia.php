<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Strona Główna</title>
    <link rel="stylesheet" href="css.css">
  </head>
  <body>
    <?php require_once "header.php";
    require_once "connect.php";?>
    <main>
      <article>
        <p>Sortowanie</p>
        <!–– Tu zostanie dodany system sortowania ––>
      </article>
      <table>
        <?php
        if ($_SESSION['id_przywileju']>0) {
          echo "<th>Id przelewu</th>";
        }

         ?>
        <th>Do kogo przelew</th>
        <th>Tytuł przelewu</th>
        <th>Wartość przelewu</th>
        <th>Data przelewu</th>
        <th>Od kogo przelew</th>
        <?php

        if ($_SESSION['id_przywileju']>0)
        {
          $kwerenda="SELECT * FROM `historia`";
        }
        else
        {
          $kwerenda="SELECT `endowed`,`title`,`amount`,`date`,`generous`FROM `historia` WHERE `endowed` = '$_SESSION[id]' OR `generous` = '$_SESSION[id]' ";
        }
        $wynik= $connect -> query($kwerenda);
        while ($wiersz= $wynik -> fetch_assoc())
        {
          ?>
            <tr>
              <?php
              if ($_SESSION['id_przywileju']>0) {
                echo "<td>".$wiersz["id_history"]."</td>";
              }

               ?>
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
