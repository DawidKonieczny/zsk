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
          <p><?= $_GET["error"];?></p>
        <?php
      }

      ?>
      <form action="" method="post">

        <label>
          Imie
          <input type="text" name="name">
        </label>

        <label>
          Nazwisko
          <input type="text" name="surname">
        </label>

        <label>
          Miejsce Zamieszkania
          <input type="text" name="home">
        </label>

        <label>
          Pesel
          <input type="text" name="pesel">
        </label>

        <label>
          Dowód czy Paszport?
          <select  name="D_czy_P">
            <option value="D">Dowód</option>
            <option value="P">Paszport</option>
          </select>
        </label>

        <label>
          Nr Dowodu/Paszportu
          <input type="text" name="doc_nr">
        </label>

        <label>
          Nazwa użytkownika (powinna posiadać min 8 znaków)
          <input type="text" name="username">
        </label>

        <label>
          Hasło (powinno posiadać min 8 znaków)
          <input type="text" name="password">
        </label>

        <label>
          Powtórz hasło
          <input type="text" name="passwordchk">
        </label>

        <label>
          Czy chcesz odrazu się zalogować?
          <input type='hidden' value='0' name='zalog'>
          <input type="checkbox" name="zalog">
        </label>

        <label>
          <input type="submit" name="zatwierdz" value="zatwierdź">
        </label>
      </form>
      <?php
        if (!empty($_POST))
        {
            foreach($_POST as $key => $value)
            {
                if (empty($value))
                {
                  header('Location: rejestracja.php?error=Wypełnij pole ' . $key);
                  exit();
                }
            }
            if (strlen($_POST["username"])<8)
            {
              header('Location: rejestracja.php?error=Nazwa użytkownika jest za krótka');
              exit();
            }
            if (strlen($_POST["password"])<8)
            {
              header('Location: rejestracja.php?error=Hasło jest za krótkie');
              exit();
            }
            if ($_POST["password"]=!$_POST["passwordchk"])
            {
              header('Location: rejestracja.php?error=Podałeś różne hasła');
              exit();
            }

            require_once "connect.php";

            $pre="1000";
            $id= $pre . random_int(1000,9999) . random_int(1000,9999) . random_int(1000,9999) . random_int(1000,9999) . random_int(10,99);
            $minikwerenda="SELECT COUNT(`id`) FROM `konta` WHERE `id` LIKE '$id'";
            $licz=$connect -> query($minikwernda);
            while ($licz>0)
            {
              $id= $pre . random_int(1000,9999) . random_int(1000,9999) . random_int(1000,9999) . random_int(1000,9999) . random_int(10,99);
              $minikwerenda="SELECT COUNT(`id`) FROM `konta` WHERE `id` LIKE '$id'";
              $licz=$connect -> query($minikwernda);
            }
            $haslo=password_hash($_POST['password'],PASSWORD_ARGON2I);
            $kwerenda = "INSERT INTO `konta` (`id`, `username`, `password`, `type`, `amount`,`name`, `surname`, `home`, `pesel`, `D_czy_P`, `doc_nr`, `date_account`) VALUES ('$id', '$_POST[username]', '$haslo', '0', '0', '$_POST[name]', '$_POST[surname]', '$_POST[home]', '$_POST[pesel]', '$_POST[D_czy_P]', '$_POST[doc_nr]', '$_POST[date_account]')";
            $connect -> query($kwerenda);

            if ($connect->affected_rows == 0)
            {
              header('Location: rejestracja.php?error=Nie udało się dodać użytkownika');
            }
            else
            {
              header('Location: logowanie.php?error=Utworzono konto');
            }

        }


      ?>
  </body>
</html>
