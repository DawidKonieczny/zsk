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

      if($_SESSION['type']>0)
      {
        $kwerenda ="SELECT * FROM `konta` WHERE `id` =".$_GET['id'];
        $wynik=$connect -> query($kwerenda);
        $wiersz= $wynik -> fetch_assoc();

        if(is_null($_GET['id']))
        {
          header('Location: ./');
          exit();
        }
        else
        {
        ?>
          <form action=<?="edytuj.php?id=".$_GET['id'];?> method="post">
            <label>
              Numer konta
              <input type="text" name="id" value="<?=$_GET['id'];?>">
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

            if (empty($_POST['pwd']))
            {
              $pwd=false;
              $kwerenda="SELECT `pwd` FROM `konta` WHERE `id` =".$_GET['id'];
              $_POST['pwd']=konwerter($kwerenda,$connect);
            }
            if (empty($_POST['type']))
            {
              $kwerenda="SELECT `type` FROM `konta` WHERE `id` =".$_GET['id'];
              $_POST['type']=konwerter($kwerenda,$connect);

            }
            foreach($_POST as $key => $value)
            {

                if (empty($value))
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

            $minikwerenda="SELECT COUNT(`id`) FROM `konta` WHERE `id` LIKE '$_POST[id]'";
            $licz=$connect -> query($minikwerenda);
            $minikwerenda2="SELECT COUNT(`username`) FROM `konta` WHERE `id` LIKE '$_POST[username]'";
            $licz2=$connect -> query($minikwerenda2);
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
            $kwerenda = "UPDATE `konta` SET `id`= '$_POST[id]', `username`='$_POST[username]', `pwd`='$haslo', `type`='$_POST[type]',`name`='$_POST[name]', `surname`='$_POST[surname]', `home`='$_POST[home]', `pesel`='$_POST[pesel]',`D_czy_P`='$_POST[D_czy_P]', `doc_nr`='$_POST[doc_nr]', `date_account`='$_POST[date_account]')";
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
      }

      ?>
     <article>
    </main>
  </body>
</html>
