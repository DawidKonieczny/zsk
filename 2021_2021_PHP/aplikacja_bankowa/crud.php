<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Crud</title>
  </head>
  <body>
    <main>

        <table>
          <tr>
            <th>Nr konta</th>
            <th>Uprawnienia</th>
            <th>Imie</th>
            <th>Nazwisko</th>
            <th>Miejsce zamieszkania</th>
            <th>Pesel</th>
            <th>Dowód czy Paszport</th>
            <th>Nr dokumentu</th>
            <th>Data założenia konta</th>
          </tr>
          <?php
          require_once "connect.php";
          $kwerenda="SELECT * FROM `konta`";
          $wynik= $connect -> query($kwerenda);
          while ($wiersz= $wynik -> fetch_assoc())
          {
          ?>
            <tr>
              <td><?= $wiersz["id"]; ?></td>
              <td><?= $wiersz["username"];?></td>
              <td><?= $wiersz["password"]?></td>
              <td><?= $wiersz["type"]?></td>
              <td><?= $wiersz["name"]?></td>
              <td><?= $wiersz["surname"];?></td>
              <td><?= $wiersz["home"]?></td>
              <td><?= $wiersz["pesel"]?></td>
              <td><?= $wiersz["D_czy_P"]?></td>
              <td><?= $wiersz["doc_nr"]?></td>
              <td><?= $wiersz["date_account"]?></td>
            </tr>
          <?php
          }
           ?>
        </table>

  </body>
</html>
