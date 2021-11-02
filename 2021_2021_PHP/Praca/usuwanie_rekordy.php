<!Doctype html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="cssDoBAzDanych.css">

  </head>
  <body>
    <?php
      require_once '/connect.php';
      require_once '/delete.php';

      $sql = "SELECT * FROM `user`";

      $wynik=$polonczenie -> query($sql);
      echo "<tablica>";
      echo <<< tabl
        <tr>
          <th>ID</th>
          <th>Imie</th>
          <th>Nazwisko</th>
          <th>Wzrost</th>
        </tr>
      tabl;

      while ($wiersz = $wynik->fetch_assoc())
     {

      echo <<< tuuu
        <tr>
         <td>
           $wiersz[name]<br>
         </td>
         <td>
          $wiersz[surname]<br>
         </td>
         <td>
          $wiersz[brithday]<br>
         </td>
         <td>
          <a href="/delete.php?id=>$wiersz[id]">Usuń</a>
         </td>
        </tr>
      tuuu;
    }


     ?>


  </body>
</html>
