<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Dane Konta</title>
    <link rel="stylesheet" href="css.css">
  </head>
  <body>
    <?php
    require_once "header.php";
    require_once 'connect.php';
     ?>
    <main>
      <?php
      if (isset($_GET["braki"]))
      {
        ?>
          <p><?= $_GET["braki"];?></p><br>
        <?php
      }

      ?>
      <article>
        <?php
        $kwerenda="SELECT * FROM `konta` WHERE `id` = '$_SESSION[id]';";
        print_r($_SESSION['id']);
        $wynik= $connect -> query($kwerenda);
        function str_contains($heystack, $needle)
        {
          foreach(explode($heystack,"") as $character)
            if ($character == $needle)
              return true;
          return false;
        }
        while ($wiersz= $wynik -> fetch_assoc())
        {

          echo "<p> Numer konta : <br> $wiersz[id]</p>";

        ?>
          <form action="" method="post">

            <label>
              Imie
              <input type="text" name="name" value="<?=$wiersz['name'];?>">
            </label><br>

            <label>
              Nazwisko
              <input type="text" name="surname" value="<?=$wiersz['surname'];?>">
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
              <input type="password" name="pwd">
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
                if (str_contains($_POST["$key"], ';'))
                {
                  header('Location: saldo.php?braki=Pole' . $key.'zawiera niepoprawną wartość');
                  exit();
                }
            }
            if (strlen($_POST["username"])<8)
            {
              header('Location: saldo.php?braki=Nazwa użytkownika jest za krótka');
              exit();
            }
            if (strlen($_POST["pwd"])<8)
            {
              header('Location: saldo.php?braki=Hasło jest za krótkie');
              exit();
            }

            $minikwerenda2="SELECT COUNT(`username`) FROM `konta` WHERE `id` = '$_POST[username]'";
            $licz2=$connect -> query($minikwernda2);
            if($licz2>0)
            {
              header('Location: saldo.php?braki=Nie udało się zmienić danych, błędna nazwa użytkownika');
            }
            $haslo=password_hash($_POST['pwd'],PASSWORD_ARGON2I);
            $kwerenda = "UPDATE `konta` SET  `username`='$_POST[username]', `pwd`='$haslo',`name`='$_POST[name]', `surname`='$_POST[surname]', `home`='$_POST[home]', `pesel`='$_POST[pesel]', `D_czy_P`='$_POST[D_czy_P]',
            `doc_nr`='$_POST[doc_nr]', `date_account`='$_POST[date_account]' WHERE `id`='$_SESSION[id]'";
            $connect -> query($kwerenda);
            if ($connect->affected_rows == 0)
            {
              header('Location: saldo.php?braki=Nie udało się zmienić danych użytkownika');
            }
            else
            {
              header('Location: saldo.php?braki=Udało zmienić się dane użytkownika');
            }

        }




          ?>
      </article>
    </main>

  </body>
</html>
