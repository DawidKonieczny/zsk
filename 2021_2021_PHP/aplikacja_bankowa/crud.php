<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Crud</title>
  </head>
  <body>
    <?php require_once "header.php" ?>
    <main>
        <article>
          <p>Sortowanie</p>
          <! –– Tu zostanie dodany system sortowania ––>
        </article>

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
          session_start();
          if ($_SESSION['type']>1)
          {
            $kwerenda="SELECT * FROM `konta`";
          }
          else
          {
            $kwerenda="SELECT * FROM `konta` WHERE `type`NOT LIKE '2'";
          }
          function edytuj($id)
          {
            $_SESSION['edycja']=$id;
            header('Location: edytuj.php');
          }
          function dodaj()
          {
            header('Location: edytuj.php?error=dodawanie');
          }
          function usun($id)
          {
            $minikwernda="DELETE FROM `konta` WHERE `id` LIKE '$id'";
            $connect -> query($minikwerenda);
          }
          $wynik= $connect -> query($kwerenda);
          while ($wiersz= $wynik -> fetch_assoc())
          {
          ?>
            <tr>
              <td><?= $wiersz["id"]; ?></td>
              <td><?= $wiersz["username"];?></td>
              <td><?= $wiersz["password"]?></td>
              <td><?= $wiersz["type"]?></td>
              <td><?= $wiersz["amount"]?></td>
              <td><?= $wiersz["name"]?></td>
              <td><?= $wiersz["surname"];?></td>
              <td><?= $wiersz["home"]?></td>
              <td><?= $wiersz["pesel"]?></td>
              <td><?= $wiersz["D_czy_P"]?></td>
              <td><?= $wiersz["doc_nr"]?></td>
              <td><?= $wiersz["date_account"]?></td>
              <td><input type="button" name="edytuj" onclick="<?= edytuj($wiersz["id"]);?>" value="Edytuj"></td>
              <td><input type="button" name="usun" onclick="<?= usun($wiersz["id"]);?>" value="Usuń"></td>
            </tr>
          <?php
          }
          ?>
        </table>
        <input type="button" name="dodaj" onclick="<?= dodaj();?>" value="Dodaj">
  </body>
</html>
