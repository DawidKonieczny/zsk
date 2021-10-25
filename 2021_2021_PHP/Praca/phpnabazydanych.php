<!Doctype html>
<html lang="pl">
  <head>
    <meta charset="utf-8">

  </head>
  <body>
    <?php
      $polonczenie = new mysqli("localhost","root","","dawidkoniecznyt");

      $sql = "SELECT * FROM `user`";

      $wynik=$polonczenie -> query($sql);

      while ($wiersz = $wynik->fetch_assoc())
      {

        echo <<< tuuu
          Imie: $wiersz[Name];
          Nazwisko:$wiersz[Surname];
          Urodziny:$wiersz[brithday];

        tuuu;
      }

     ?>


  </body>
</html>
