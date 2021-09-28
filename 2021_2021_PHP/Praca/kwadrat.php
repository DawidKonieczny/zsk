
<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>kwadrat</title>
  </head>
  <body>
    <h3>kwadrat</h3>
    <form method="post">
      <input type="text" name="aSide" placeholder="PodajBok"><br>
      <input type="submit" value="Zatwierdź"><br>
    </form>
    <?php
    if (!empty($_POST['aSide']))
    {
      $aSide=str_replace(',','.',$_POST['aSide'])
      $area=pow($_POST['aSide'],2);
      $circuit=4*$_POST['aSide'];
      echo <<< RESULT
      <hr>
      Pole kwadratu to $area <br>
      Obwód kwadratu to $circuit
      RESULT;
    }
    else
    {

    }

     ?>
  </body>
</html>
