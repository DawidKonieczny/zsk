

<!DOCTYPE html>

<html lang="pl" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>

    </head>
    <body>

      <form>
        <h3>Dane</h3>
        <input type="text" name="name" placeholder="imię"><br>
        <input type="text" name="surname" placeholder="nazwisko"><br>
        <input type="submit" value="wypełnij dane"><br>
      </form>
      <?php
      //formularze
      if (!empty($_GET["name"]) && !empty($_GET["surname"]))//!empty jest lepszy niż isset
      {
        echo <<<L
        Imie: $_GET[name];
        Nazwisko: $_GET[surname];
L;
      }
      else
      {
        echo "brakuje danych!!";
      }
      






    ?>
    </body>

</html>