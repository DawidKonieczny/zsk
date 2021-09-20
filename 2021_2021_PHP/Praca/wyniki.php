<!DOCTYPE html>

<html lang="pl" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>

    </head>
    <body>


      <?php
      if (!empty($_GET["name"]) && !empty($_GET["surname"]) && !empty($_GET["nation"]) && !empty($_GET["age"]))
      {
        echo <<< L
      Imie: $_GET[name] <br>
      Nazwisko: $_GET[surname]<br>
      Narodowość: $_GET[nation]<br>
      Wiek: $_GET[age]

      L;

      }
      else
      {
        echo "brakuje danych!!";
      }
      
    


    ?>
    </body>

</html>