<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>prostokat</title>
  </head>
  <body>
    <h3>Prostokat</h3>
    <form method="post">
      <input type="text" name="aSide" placeholder="Podaj Bok a"><br>
      <input type="text" name="bSide" placeholder="Podaj Bok b"><br>
      <input type="submit" value="Zatwierdź"><br>
    </form>
    <?php
    if (!empty($_POST['aSide']))
    {
      $area= $_POST['aSide']*$_POST['bSide'];
      $circuit=2*$_POST['aSide']+2*$_POST['bSide'];
      echo <<< RESULT
      <hr>
      Pole Prostokąta to $area <br>
      Obwód Prostokąta to $circuit
      RESULT;
    }
    else
    {

    }

     ?>
  </body>
</html>
