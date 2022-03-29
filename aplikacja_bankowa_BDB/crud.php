<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css.css">
    <title>Crud</title>
  </head>
  <body>
    <?php require_once "header.php" ?>
    <main>
        <article>
          <p>Sortowanie</p>
          <! –– Tu zostanie dodany system sortowania ––>
        </article>
        <?php
        if (isset($_GET["error"]))
        {
          ?>
            <p><?= $_GET["error"];?></p><br>
          <?php
        }

        ?>

        <table>
          <tr>
            <th>Nr konta</th>
            <th>Nazwa użyktownika</th>
            <th>Uprawnienia</th>
            <th>Stan Konta (zł)</th>
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
          if ($_SESSION['type']>1)
          {
            $kwerenda="SELECT `konta`.`id`, `konta`.`username`, `konta`.`amount`, `konta`.`date_account`, `uzytkownicy`.`imie`, `uzytkownicy`.`nazwisko`, `uzytkownicy`.`pesel`, `typy_dokumentow`.`nazwa`, `uzytkownicy`.`dokument_numer`, `przywileje`.`nazwa` FROM `konta` INNER JOIN `uzytkownicy` ON `uzytkownicy`.`id` = `konta`.`id_uzytkownika` INNER JOIN `typy_dokumentow` on `typy_dokumentow`.`id` = `uzytkownicy`.`id_typu_dokumentu` INNER JOIN `przywileje` ON `przywileje`.`id` = `konta`.`id_przywileju`";
          }
          else
          {
            $kwerenda="SELECT `konta`.`id`, `konta`.`username`, `konta`.`amount`, `konta`.`date_account`, `uzytkownicy`.`imie`, `uzytkownicy`.`nazwisko`, `uzytkownicy`.`pesel`, `typy_dokumentow`.`nazwa`, `uzytkownicy`.`dokument_numer`, `przywileje`.`nazwa` FROM `konta` INNER JOIN `uzytkownicy` ON `uzytkownicy`.`id` = `konta`.`id_uzytkownika` INNER JOIN `typy_dokumentow` on `typy_dokumentow`.`id` = `uzytkownicy`.`id_typu_dokumentu` INNER JOIN `przywileje` ON `przywileje`.`id` = `konta`.`id_przywileju` WHERE `konta`.`id_przywileju` NOT LIKE '2'";
          }

          $wynik= $connect -> query($kwerenda);
          while ($wiersz = $wynik -> fetch_assoc())
          {
          ?>
            <tr>
              <td><?= $wiersz["id"]; ?></td>
              <td><?= $wiersz["username"];?></td>
              <td><?= $wiersz["type"]?></td>
              <td><?= $wiersz["amount"]?></td>
              <td><?= $wiersz["name"]?></td>
              <td><?= $wiersz["surname"];?></td>
              <td><?= $wiersz["home"]?></td>
              <td><?= $wiersz["pesel"]?></td>
              <td><?= $wiersz["D_czy_P"]?></td>
              <td><?= $wiersz["doc_nr"]?></td>
              <td><?= $wiersz["date_account"]?></td>
              <td><a href="edytuj.php?id=<?=$wiersz['id'];?>">edytuj</a></td>
              <td><a href="delete.php?id=<?=$wiersz['id'];?>">usuń</a></td>
            </tr>
          <?php
          }
          ?>
        </table>
        <a href="dodaj.php?id=<?=$wiersz['id'];?>">dodaj użykwonika</a>
    </main>
  </body>
</html>
