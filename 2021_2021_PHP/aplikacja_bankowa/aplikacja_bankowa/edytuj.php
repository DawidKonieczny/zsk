<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Strona Główna</title>
    <link rel="stylesheet" href="css.css">
  </head>
  <body>
    <nav>
      <?php
        session_start();
        require_once "connect.php";
        function wylog()
        {
          session_destroy();
          header('Location: logowanie.php?error=Wylogowano pomyślnie');
        }
        echo <<< p1
          <p><a href="crud.php">Crud</a></p>
        p1;
        echo <<< p1
          <p><a href="historia.php">Historia Przelewów</a></p>
        p1;
        echo <<< p1
          <input type="button" name="Wyloguj" onclick="<?= wylog();?>" value="Wyloguj">
        p1;
      ?>

    </nav>
    <main>
      <?php
      if ($_GET["error"] == "dodawanie")
      {
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
        if (isset($_GET["braki"]))
        {
          echo "<p>$_GET['braki']</p>";
        }
        ?>

        <form action="" method="post">
          <label>
            Numer konta
            <input type="text" name="id" value=<?= $id;?>>
          </label>

          <label>
            Imie
            <input type="text" name="name">
          </label>

          <label>
            Nazwisko
            <input type="text" name="surname">
          </label>

          <label>
            Poziom stanowiska
            <select  name="type">
              <option value="0">Klient</option>
              <option value="1">Moderator</option>
              <?php
              if ($_SESSION['type']>1)
              {
                echo "<option value='2'>Administrator</option>"
              }
              ?>
            </select>
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
                  header('Location: edytuj.php?error=dodawanie&braki=' . $key);
                  exit();
                }
            }
            if (strlen($_POST["username"])<8)
            {
              header('Location: edytuj.php?error=dodawanie&braki=Nazwa użytkownika jest za krótka');
              exit();
            }
            if (strlen($_POST["password"])<8)
            {
              header('Location: edytuj.php?error=dodawanie&braki=Hasło jest za krótkie');
              exit();
            }
            $haslo=password_hash($_POST['password'],PASSWORD_ARGON2I);
            $kwerenda = "INSERT INTO `konta` (`id`, `username`, `password`, `type`, `amount`,`name`, `surname`, `home`, `pesel`, `D_czy_P`, `doc_nr`, `date_account`) VALUES ('$_POST[id]', '$_POST[username]', '$haslo', '$_POST[type]', '$_POST[amount]', '$_POST[name]', '$_POST[surname]', '$_POST[home]', '$_POST[pesel]', '$_POST[D_czy_P]', '$_POST[doc_nr]', '$_POST[date_account]')";
            $connect -> query($kwerenda);
            if ($connect->affected_rows == 0)
            {
              header('Location: rejestracja.php?error=dodawanie&braki=Nie udało się dodać użytkownika');
            }
            else
            {
              header('Location: logowanie.php?error=dodawanie&braki=Utworzono konto');
            }

        }

      }
      else
      {
        $kwerenda="SELECT * `konta` WHERE `id` LIKE $_SESSION['edycja']";
        $wynik= $connect -> query($kwerenda);
        while ($wiersz= $wynik -> fetch_assoc())
        {
        ?>
          <form action="" method="post">
            <label>
              Numer konta
              <input type="text" name="id" value="<?=$wiersz['id'];?>">
            </label>

            <label>
              Imie
              <input type="text" name="name" value="<?=$wiersz['name'];?>">
            </label>

            <label>
              Nazwisko
              <input type="text" name="surname" value="<?=$wiersz['surname'];?>">
            </label>

            <label>
              Poziom stanowiska
              <select  name="type" value="<?=$wiersz['type'];?>">
                <option value="0">Klient</option>
                <option value="1">Moderator</option>
                <?php
                if ($_SESSION['type']>1)
                {
                  echo "<option value='2'>Administrator</option>"
                }
                ?>
              </select>
            </label>

            <label>
              Miejsce Zamieszkania
              <input type="text" name="home" value="<?=$wiersz['home'];?>">
            </label>

            <label>
              Pesel
              <input type="text" name="pesel" value="<?=$wiersz['pesel'];?>">
            </label>

            <label>
              Dowód czy Paszport?
              <select  name="D_czy_P" value="<?=$wiersz['D_czy_P'];?>">
                <option value="D">Dowód</option>
                <option value="P">Paszport</option>
              </select>
            </label>

            <label>
              Nr Dowodu/Paszportu
              <input type="text" name="doc_nr" value="<?=$wiersz['doc_nr'];?>">
            </label>

            <label>
              Nazwa użytkownika (powinna posiadać min 8 znaków)
              <input type="text" name="username" value="<?=$wiersz['username'];?>">
            </label>

            <label>
              Hasło (powinno posiadać min 8 znaków)
              <input type="text" name="password">
            </label>

            <label>
              <input type="submit" name="zatwierdz" value="zatwierdź">
            </label>
          </form>

        <?php
        }
        if (!empty($_POST))
        {
            foreach($_POST as $key => $value)
            {
                if (empty($value))
                {
                  header('Location: edytuj.php?braki=' . $key);
                  exit();
                }
            }
            if (strlen($_POST["username"])<8)
            {
              header('Location: edytuj.php?braki=Nazwa użytkownika jest za krótka');
              exit();
            }
            if (strlen($_POST["password"])<8)
            {
              header('Location: edytuj.php?braki=Hasło jest za krótkie');
              exit();
            }
            $haslo=password_hash($_POST['password'],PASSWORD_ARGON2I);
            $kwerenda = "UPDATE `konta` SET `id`= '$_POST[id]', `username`='$_POST[username]', `password`='$haslo', `type`='$_POST[type]', `amount`='$_POST[amount]',`name`='$_POST[name]', `surname`='$_POST[surname]', `home`='$_POST[home]', `pesel`='$_POST[pesel]', `D_czy_P`='$_POST[D_czy_P]', `doc_nr`='$_POST[doc_nr]', `date_account`='$_POST[date_account]')";
            $connect -> query($kwerenda);
            if ($connect->affected_rows == 0)
            {
              header('Location: rejestracja.php?error=dodawanie&braki=Nie udało się dodać użytkownika');
            }
            else
            {
              header('Location: logowanie.php?error=dodawanie&braki=Utworzono konto');
            }

        }
      }

      ?>
    </main>
  </body>
</html>
