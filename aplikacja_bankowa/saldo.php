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

        $kwerenda="SELECT * FROM `uzytkownicy` WHERE `id` = '$_SESSION[id_uzytkownika]'";
        $wynik= $connect -> query($kwerenda);
        $wiersz= $wynik -> fetch_assoc();

        $kwerenda="SELECT * FROM `konta` WHERE `id` = '$_SESSION[id]'";
        $wynik= $connect -> query($kwerenda);
        $wiersz1= $wynik -> fetch_assoc();
        echo "<p> Numer konta : <br> $wiersz1[id]</p>";
        echo "<p> Stan konta : <br> $wiersz1[amount]zł</p>";
        if(true)
        {
        ?>
          <form action="saldo.php" method="post">

            <label>
              Imie
              <input type="text" name="name" value="<?=$wiersz['imie'];?>">
            </label><br>

            <label>
              Nazwisko
              <input type="text" name="surname" value="<?=$wiersz['nazwisko'];?>">
            </label><br>

            <label>
              Miejsce Zamieszkania
              <input type="text" name="home" value="<?=$wiersz['domek'];?>">
            </label><br>

            <label>
              Pesel
              <input type="text" name="pesel" value="<?=$wiersz['pesel'];?>">
            </label><br>

            <label>
              Dowód czy Paszport?
              <select  name="D_czy_P" value="<?=$wiersz['id_typu_dokumentu'];?>">
                <?php
                if ($wiersz['id_typu_dokumentu'] == "P" )
                {
                  echo <<< here
                  <option value="D">Dowód</option>
                  <option value="P" selected>Paszport</option>
                  here;
                }
                else {
                  echo <<< here
                  <option value="D" selected>Dowód</option>
                  <option value="P" >Paszport</option>
                  here;
                }

                 ?>
              </select>
            </label><br>

            <label>
              Nr Dowodu/Paszportu
              <input type="text" name="doc_nr" value="<?=$wiersz['dokument_numer'];?>">
            </label><br>

            <label>
              Nazwa użytkownika (powinna posiadać min 8 znaków)
              <input type="text" name="username" value="<?=$wiersz1['username'];?>">
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
            $licz2=$connect -> query($minikwerenda2);
            if($licz2>1)
            {
              header('Location: saldo.php?braki=Nie udało się zmienić danych, błędna nazwa użytkownika');
              exit();
            }
            $haslo=password_hash($_POST['pwd'],PASSWORD_ARGON2I);
            $kwerenda = "UPDATE `konta` SET  `username`='$_POST[username]', `pwd`='$haslo' WHERE `id`='$_SESSION[id]'";
            $connect -> query($kwerenda);
            $kwerenda = "UPDATE `uzytkownicy` SET `imie`='$_POST[name]', `nazwisko`='$_POST[surname]', `domek`='$_POST[home]', `pesel`='$_POST[pesel]', `id_typu_dokumentu`='$_POST[D_czy_P]',
            `dokument_numer`='$_POST[doc_nr]' WHERE `id`='$_SESSION[id_uzytkownika]'";
            $connect -> query($kwerenda);
            if ($connect->affected_rows > 0)
            {

              header('Location: saldo.php?braki=Udało zmienić się dane użytkownika');
              exit();
            }
            else
            {
              header('Location: saldo.php?braki=Nie udało się zmienić danych użytkownika');
              exit();
            }

        }




          ?>
      </article>
    </main>

  </body>
</html>
