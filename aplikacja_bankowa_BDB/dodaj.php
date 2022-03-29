<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Strona Główna</title>
    <link rel="stylesheet" href="css.css">
  </head>
  <body>
    <?php
    require_once "header.php";
    require_once "connect.php";
    ?>
    <main>
      <?php
      if ($_SESSION['id_przywileju']>0)
      {
        $pre="1000";
        $id= $pre . random_int(1000,9999) . random_int(1000,9999) . random_int(1000,9999) . random_int(1000,9999) . random_int(10,99);
        $minikwerenda="SELECT COUNT(`id`) FROM `konta` WHERE `id` LIKE '$id'";
        $licz=konwerter($minikwerenda,$connect);
        while ($licz>0)
        {
          $id= $pre . random_int(1000,9999) . random_int(1000,9999) . random_int(1000,9999) . random_int(1000,9999) . random_int(10,99);
          $minikwerenda="SELECT COUNT(`id`) FROM `konta` WHERE `id` LIKE '$id'";
          $licz=$connect -> query($minikwerenda);
        }
        if (isset($_GET['error']))
        {
          ?>
            <p><?= $_GET['error'];?></p><br>
          <?php
        }

        ?>

        <form action="dodaj.php" method="post">
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
              if ($_SESSION['id_przywileju']>1)
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
            <input type="password" name="pwd">
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
            if (strlen($_POST["pwd"])<8)
            {
              header('Location: edytuj.php?error=dodawanie&braki=Hasło jest za krótkie');
              exit();
            }
            $haslo=password_hash($_POST['pwd'],PASSWORD_ARGON2I);
            $kwerenda = "INSERT INTO `konta` (`id`, `username`, `pwd`, `type`,`name`, `surname`, `home`, `pesel`, `D_czy_P`, `doc_nr`,`amount`) VALUES ('$_POST[id]', '$_POST[username]', '$haslo', '$_POST[type]', '$_POST[name]', '$_POST[surname]', '$_POST[home]', '$_POST[pesel]', '$_POST[D_czy_P]', '$_POST[doc_nr]','0')";
            $connect -> query($kwerenda);
            if ($connect->affected_rows == 0)
            {
              header('Location: dodaj.php?error=Nie udało się dodać użytkownika');
            }
            else
            {
              header('Location: logowanie.php?error=Utworzono konto');
            }

        }

      }
      else {
        header('Location: ./');
      }
      ?>
    </main>
  </body>
</html>
