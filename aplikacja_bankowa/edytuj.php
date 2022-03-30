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
     if (isset($_GET["braki"]))
     {

       ?>
         <p><?= $_GET["braki"];?></p><br>

       <?php
     }
     ?>

     <article>
      <?php

      if($_SESSION['id_przywileju']>0)
      {
        if(is_null($_GET['id']))
        {
          header('Location: ./');
          exit();
        }
        if($_SESSION['id_przywileju']>1)
        {
          $kwerenda ="SELECT * FROM `konta` WHERE `id` =".$_GET['id'];
          $wynik=$connect -> query($kwerenda);
          $wiersz= $wynik -> fetch_assoc();
          $kwerenda="SELECT * FROM `uzytkownicy` WHERE `id`= '$wiersz[id_uzytkownika]'";
          $wiersz2 = $connect -> query($kwerenda);
          $wiersz2 = $wiersz2 -> fetch_assoc();
        }
        else
        {
          $kwerenda ="SELECT * FROM `konta` WHERE `id` =".$_GET['id'] AND `id_przywileju` < 2;
          $wynik=$connect -> query($kwerenda);
          $wiersz= $wynik -> fetch_assoc();
          $kwerenda="SELECT * FROM `uzytkownicy` WHERE `id`= '$wiersz[id_uzytkownika]'";
          $wiersz2 = $connect -> query($kwerenda);
          $wiersz2 = $wiersz2 -> fetch_assoc();
        }
        ?>
          <form action=<?="edytuj.php?id=".$_GET['id'];?> method="post">
            <label>
              Numer konta
              <input type="text" name="id" value="<?=$_GET['id'];?>">
            </label><br>

            <label>
              Imie
              <input type="text" name="imie" value="<?=$wiersz2['imie'];?>">
            </label><br>

            <label>
              Nazwisko
              <input type="text" name="nazwisko" value="<?=$wiersz2['nazwisko'];?>">
            </label><br>

            <label>
              <?php
              switch ($wiersz['id_przywileju']) {
                case '1':
                {
                  echo <<< here
                  Poziom stanowiska
                  <select  name="id_przywileju">
                    <option value="0">Klient</option>
                    <option value="1" selected>Moderator</option>
                  here;
                    if ($_SESSION['id_przywileju']>1)
                    {
                      echo "<option value='2'>Administrator</option>";
                    }
                  echo "</select>";
                  break;
                }
                case '2':
                {
                  echo <<< here
                  Poziom stanowiska
                  <select  name="id_przywileju">
                    <option value="0">Klient</option>
                    <option value="1">Moderator</option>
                    <option value='2' selected>Administrator</option>
                  </select>
                  here;
                  break;
                }


                default:
                  {
                    echo <<< here
                    Poziom stanowiska
                    <select  name="id_przywileju">
                      <option value="0" selected>Klient</option>
                      <option value="1">Moderator</option>
                    here;
                      if ($_SESSION['id_przywileju']>1)
                      {
                        echo "<option value='2'>Administrator</option>";
                      }
                    echo "</select>";
                    break;
                  }

              }

            ?>
            </label><br>

            <label>
              Miejsce Zamieszkania
              <input type="text" name="home" value="<?=$wiersz2['domek'];?>">
            </label><br>

            <label>
              Pesel
              <input type="text" name="pesel" value="<?=$wiersz2['pesel'];?>">
            </label><br>

            <label>
              Dowód czy Paszport?
              <?php
              switch ($wiersz2['id_typu_dokumentu']) {
                case 'P':
                {
                  echo <<< here
                  Poziom stanowiska
                  <select  name="typy_dokumentow">
                    <option value="D" selected>Dowód</option>
                    <option value="P">Paszport</option>
                  </select>
                  here;
                  break;
                }
                case 'D':
                {
                  echo <<< here
                  Poziom stanowiska
                  <select  name="typy_dokumentow">
                    <option value="D">Dowód</option>
                    <option value="P" selected>Paszport</option>
                  </select>
                  here;
                  break;
                }

              }?>
            </label><br>

            <label>
              Nr Dowodu/Paszportu
              <input type="text" name="dokument_numer" value="<?=$wiersz2['dokument_numer'];?>">
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
            $pwd=true;
            if (empty($_POST['pwd']))
            {
              $pwd=false;
              $kwerenda="SELECT `pwd` FROM `konta` WHERE `id` =".$_GET['id'];
              $wynik=konwerter($kwerenda,$connect);
              $_POST['pwd']=password_hash($wynik,PASSWORD_ARGON2I);
            }
            foreach($_POST as $key => $value)
            {

                if($key == 'id_przywileju')
                {
                  $_POST["$key"]=$wiersz['id_przywileju'];
                }
                elseif (empty($value))
                {
                  header('Location: edytuj.php?id='.$_GET['id'].'&braki=Nie Uzpełniono Pola ' . $key);
                  exit();
                }
                $_POST["$key"]=trim($_POST["$key"]);
                if (str_contains($_POST["$key"], ';'))
                {
                  header('Location: edytuj.php?'.$_GET['id'].'&braki=Pole' . $key.'zawiera niepoprawną wartość');
                  exit();
                }
            }
            if (strlen($_POST["username"])<8)
            {
              header('Location: edytuj.php?id='.$_GET['id'].'&braki=Nazwa użytkownika jest za krótka');
              exit();
            }
            if (strlen($_POST["pwd"])<8)
            {
              header('Location: edytuj.php?id='.$_GET['id'].'&braki=Hasło jest za krótkie');
              exit();
            }
            if($_POST['id']!=$wiersz['id'])
            {
              $minikwerenda="SELECT COUNT(`id`) FROM `konta` WHERE `id` = '$_POST[id]'";
              $licz=$connect -> query($minikwerenda);
              if($licz>0)
              {
                header('Location: edytuj.php?id='.$_GET['id'].'&braki=Nie udało się dodać użytkownika błędny numer konta lub nazwa użytkownika');
                exit();
              }
            }
            if($_POST['username']!=$wiersz['username'])
            {
              $minikwerenda2="SELECT COUNT(`username`) FROM `konta` WHERE `username` = '$_POST[username]'";
              $licz2=$connect -> query($minikwerenda2);
              if($licz2>0)
              {
                header('Location: edytuj.php?id='.$_GET['id'].'&braki=Nie udało się dodać użytkownika błędny numer konta lub nazwa użytkownika');
                exit();
              }
            }

            if($licz>1 or strlen($_POST['id'])!=26 or $licz2>1)
            {
              header('Location: edytuj.php?id='.$_GET['id'].'&braki=Nie udało się dodać użytkownika błędny numer konta lub nazwa użytkownika');
              exit();
            }
            if($pwd)
              $haslo=password_hash($_POST['pwd'],PASSWORD_ARGON2I);
            else {
              $haslo=$_POST['pwd'];
            }
            $kwerenda = "UPDATE `konta` SET `id`= '$_POST[id]', `username`='$_POST[username]', `pwd`='$haslo', `id_przywileju`='$_POST[id_przywileju]' WHERE `id`='$wiersz[id]'";
            $connect -> query($kwerenda);
            $kwerenda = "UPDATE `uzytkownicy` SET `imie`='$_POST[imie]', `nazwisko`='$_POST[nazwisko]', `id_typu_dokumentu`='$_POST[typy_dokumentow]', `dokument_numer`='$_POST[dokument_numer]' WHERE `id`='$wiersz2[id]'";
            $connect -> query($kwerenda);
            if ($connect->affected_rows > 0)
            {

              header('Location: crud.php?id='.$_GET['id'].'&braki=Edycja się udała');
              exit();
            }
            else
            {
              header('Location: edytuj.php?id='.$_GET['id'].'&braki=Nie udało się edytować użytkwonika');
              exit();
            }

        }


      ?>
     <article>
    </main>
  </body>
</html>
