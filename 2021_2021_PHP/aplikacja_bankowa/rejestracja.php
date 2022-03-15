<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Rejestracja</title>
  </head>
  <body>
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
                  header('Location: rejestracja.php?info&error=Wypełnij pole ' . $key);
                  exit();
                }
            }
            if (strlen($_POST["username"])<8)
            {
              header('Location: rejestracja.php?info&error=Nazwa użytkownika jest za krótka');
              exit();
            }
            if (strlen($_POST["password"])<8)
            {
              header('Location: rejestracja.php?info&error=Hasło jest za krótkie');
              exit();
            }
            if ($_POST["password"]=!$_POST["passwordchk"])
            {
              header('Location: rejestracja.php?info&error=Podałeś różne hasła');
              exit();
            }

            require_once "connect.php";
            $minikwerenda="SELECT `id` FROM `konta` ORDER BY `id` DESC LIMIT 1"
            $id=$connect -> query($minikwernda);
            $kwerenda = "INSERT INTO `konta` (`id`, `username`, `password`, `type`, `amount`,`name`, `surname`, `home`, `pesel`, `D_czy_P`, `doc_nr`, `date_account`) VALUES (NULL, '$_POST[imie]', '$_POST[nazwisko]', '$_POST[dataUrodzenia]', '$_POST[wzrost]', '$_POST[miasto]')";
            $connect -> query($kwerenda);

            if ($connect->affected_rows == 0)
            {
              header('Location: rejestracja.php?info&error=Nie udało się dodać użytkownika');
            }

        }


      ?>
  </body>
</html>
