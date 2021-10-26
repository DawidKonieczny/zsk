<!Doctype html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="cssDoBAzDanych.css">

  </head>
  <body>
    <?php
      $polonczenie = new mysqli("localhost","root","","4dg1_baza1");

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
           $wiersz[Name]<br>
         </td>
         <td>
          $wiersz[Surname]<br>
         </td>
         <td>
          $wiersz[brithday]<br>
         </td>
        </tr>
      tuuu;
    }


     ?>


  </body>
</html>
