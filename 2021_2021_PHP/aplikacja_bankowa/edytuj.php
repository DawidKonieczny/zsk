<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Strona Główna</title>
    <link rel="stylesheet" href="css.css">
  </head>
  <body>
    <?php require_once "header.php" ?>
    <main>
      <?php
      if ($_GET["error"] == "dodawanie" && $_SESSION['type']>0)
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

        if (isset($_GET["error"]))
        {
          ?>
            <p><?= $_GET["error"];?></p><br>
          <?php
        }

        ?>

        <form action="" method="post">
          <label>
            Numer konta
            <input type="text" name="id" value=<?= $id;?>>
          </label><br>

          <label>
            Imie
            <input type="text" name="name">
          </label><br>

          <label>
            Nazwisko
            <input type="text" name="surname">
          </label><br>

          <label>
            Poziom stanowiska
            <select  name="type">
              <option value="0">Klient</option>
              <option value="1">Moderator</option>
              <?php
              if ($_SESSION['type']>1)
              {
                echo "<option value='2'>Administrator</option>";
              }
              ?>
            </select>
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
          </label><br><br>

          <label>
            Hasło (powinno posiadać min 8 znaków)
            <input type="password" name="password">
          </label><br>

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
            $kwerenda = "INSERT INTO `konta` (`id`, `username`, `password`, `type`,`name`, `surname`, `home`, `pesel`, `D_czy_P`, `doc_nr`, `date_account`) VALUES ('$_POST[id]', '$_POST[username]', '$haslo', '$_POST[type]', '$_POST[name]', '$_POST[surname]', '$_POST[home]', '$_POST[pesel]', '$_POST[D_czy_P]', '$_POST[doc_nr]', '$_POST[date_account]')";
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
      else if($_SESSION['type']>0)
      {
        $kwerenda ="SELECT * `konta` WHERE `id` LIKE $_SESSION[edycja]";
        $wynik= $connect -> query($kwerenda);
        while ($wiersz= $wynik -> fetch_assoc())
        {
        ?>
          <form action="" method="post">
            <label>
              Numer konta
              <input type="text" name="id" value="<?=$wiersz['id'];?>">
            </label><br>

            <label>
              Imie
              <input type="text" name="name" value="<?=$wiersz['name'];?>">
            </label><br>

            <label>
              Nazwisko
              <input type="text" name="surname" value="<?=$wiersz['surname'];?>">
            </label><br>

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
            </label><br>

            <label>
              Miejsce Zamieszkania
              <input type="text" name="home" value="<?=$wiersz['home'];?>">
            </label><br>

            <label>
              Pesel
              <input type="text" name="pesel" value="<?=$wiersz['pesel'];?>">
            </label><br>

            <label>
              Dowód czy Paszport?
              <select  name="D_czy_P" value="<?=$wiersz['D_czy_P'];?>">
                <option value="D">Dowód</option>
                <option value="P">Paszport</option>
              </select>
            </label><br>

            <label>
              Nr Dowodu/Paszportu
              <input type="text" name="doc_nr" value="<?=$wiersz['doc_nr'];?>">
            </label><br>

            <label>
              Nazwa użytkownika (powinna posiadać min 8 znaków)
              <input type="text" name="username" value="<?=$wiersz['username'];?>">
            </label><br>

            <label>
              Hasło (powinno posiadać min 8 znaków)
              <input type="password" name="password">
            </label><br>

            <label>
              <input type="submit" name="zatwierdz" value="zatwierdź">
            </label><br>
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
                $_POST["$key"]=trim($_POST["$key"]);
                if str_contains($_POST["$key"], ';')
                {
                  header('Location: edytuj.php?braki=Pole' . $key.'zawiera niepoprawną wartość');
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

            $minikwerenda="SELECT COUNT(`id`) FROM `konta` WHERE `id` LIKE '$_POST[id]'";
            $licz=$connect -> query($minikwernda);
            $minikwerenda2="SELECT COUNT(`username`) FROM `konta` WHERE `id` LIKE '$_POST[username]'";
            $licz2=$connect -> query($minikwernda2);
            if($licz>0 or strlen($_POST['id']!=26) or $licz2>0)
            {
              header('Location: edycja.php?braki=Nie udało się dodać użytkownika błędny numer konta lub nazwa użytkownika');
            }
            $haslo=password_hash($_POST['password'],PASSWORD_ARGON2I);
            $kwerenda = "UPDATE `konta` SET `id`= '$_POST[id]', `username`='$_POST[username]', `password`='$haslo', `type`='$_POST[type]',`name`='$_POST[name]', `surname`='$_POST[surname]', `home`='$_POST[home]', `pesel`='$_POST[pesel]', `D_czy_P`='$_POST[D_czy_P]', `doc_nr`='$_POST[doc_nr]', `date_account`='$_POST[date_account]')";
            $connect -> query($kwerenda);
            if ($connect->affected_rows == 0)
            {
              header('Location: edytuj.php?braki=Nie udało się dodać użytkownika');
            }
            else
            {
              header('Location: crud.php?error=Utworzono konto');
            }

        }
      }

      ?>
    </main>
  </body>
</html>
