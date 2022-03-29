<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="css.css">
  </head>
  <body>
      <?php
      if (isset($_GET["error"]))
      {
        ?>
          <p><?= $_GET["error"];?></p><br>
        <?php
      }

      ?>
      <form action="rejestracja.php" method="post">

        <label>
          Imie
          <input type="text" name="name">
        </label><br>

        <label>
          Nazwisko
          <input type="text" name="surname">
        </label><br>

        <label>
          Miejsce Zamieszkania
          <input type="text" name="home">
        </label><br>

        <label>
          Pesel
          <input type="text" name="pesel">
        </label><br>

        <label>
          Dowód czy Paszport?
          <select  name="D_czy_P">
            <option value="D">Dowód</option>
            <option value="P">Paszport</option>
          </select>
        </label><br>

        <label>
          Nr Dowodu/Paszportu
          <input type="text" name="doc_nr">
        </label><br>

        <label>
          Nazwa użytkownika (powinna posiadać min 8 znaków)
          <input type="text" name="username">
        </label><br>

        <label>
          Hasło (powinno posiadać min 8 znaków)
          <input type="password" name="pwd">
        </label><br>

        <label>
          Powtórz hasło
          <input type="password" name="pwdchk">
        </label><br>

        <label>
          Czy chcesz odrazu się zalogować?
          <input type="checkbox" name="zalog">
        </label><br>

        <label>
          <input type="submit" name="zatwierdz" value="zatwierdź">
        </label><br>
      </form>
      <?php
        require_once "connect.php";
        if (!empty($_POST))
        {

            foreach($_POST as $key => $value)
            {
                if (empty($value))
                {
                  if($key!="zalog")
                  {
                    header('Location: rejestracja.php?error=Wypełnij pole ' . $key);
                    exit();
                  }

                }
                if (str_contains($_POST["$key"], ';'))
                {
                  header('Location: rejestracja.php?error=Pole' . $key.'zawiera niepoprawną wartość');
                  exit();
                }
            }

            if (strlen($_POST["username"])<8)
            {
              header('Location: rejestracja.php?error=Nazwa użytkownika jest za krótka');
              exit();
            }
            if (strlen($_POST['pwd'])<8)
            {
              header('Location: rejestracja.php?error=Hasło jest za krótkie');
              exit();
            }
            if ($_POST["pwd"]=!$_POST['pwdchk'])
            {
              header('Location: rejestracja.php?error=Podałeś różne hasła');
              exit();
            }


            $minik="SELECT `username` FROM `konta` WHERE `id` LIKE '$_POST[username]'";
            $licz2 = $connect -> query($minik);
            if(mysqli_num_rows($licz2)>0)
            {
              header("Location: rejestracja.php?error=Istnieje już taka nazwa użytkownika $licz2");
              exit();
            }
            $pre="1000";
            $id= $pre . random_int(1000,9999) . random_int(1000,9999) . random_int(1000,9999) . random_int(1000,9999) . random_int(1000,9999).random_int(10,99);
            $minik2="SELECT `id` FROM `konta` WHERE `id` = '$id'";
            $licz=$connect -> query($minik2);
            while (mysqli_num_rows($licz)>0)
            {
              $id= $pre . random_int(1000,9999) . random_int(1000,9999) . random_int(1000,9999) . random_int(1000,9999). random_int(1000,9999) . random_int(10,99);
              $minik2="SELECT `id` FROM `konta` WHERE `id` = '$id'";
              $licz=$connect -> query($minik2);
            }

            $haslo = password_hash($_POST['pwdchk'], PASSWORD_ARGON2I);
            $kwerenda = "INSERT INTO `konta` (`konta`.`id`, `konta`.`username`, `konta`.`pwd`, `konta`.`id_przywileju`, `konta`.`amount`,`uzytkownik`.`name`, `uzytkownik`.`surname`, `uzytkownik`.`domek`, `uzytkownik`.`pesel`, `uzytkownik`.`id_typu_dokumentu`, `uzytkownik`.`dokument_numer`) VALUES ('$id', '$_POST[username]', '$haslo', '0', '0', '$_POST[name]', '$_POST[surname]', '$_POST[home]', '$_POST[pesel]', '$_POST[D_czy_P]', '$_POST[doc_nr]')";
            $connect -> query($kwerenda);

            if ($connect->affected_rows == 0)
            {
              header('Location: rejestracja.php?error=Nie udało się dodać użytkownika');
              exit();
            }
            else
            {
              header('Location: logowanie.php?error=Utworzono konto');
              exit();
            }

        }


      ?>
  </body>
</html>
