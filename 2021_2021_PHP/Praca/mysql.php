<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Użytkownicy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <table>
        <tr>
            <th>ID</th>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Miasto</th>
            <th>Wzrost</th>
            <th>Usuwanie</th>
        </tr>
    <?php

    require_once "polaczenie.php";

    $kwerenda = "SELECT * FROM `user` INNER JOIN `city` on `users.cityid`= `city.id` ";

    $wynik = $polaczenie->query($kwerenda);

    while ($wiersz = $wynik->fetch_assoc()):
        if ($wiersz["height"] != NULL) {
            $wzrost = $wiersz["height"] . "cm";
        } else {
            $wzrost = "-";
        }
        ?>
        <tr>
            <td><?= $wiersz["id"]; ?></td>
            <td><?= $wiersz["name"]; ?></td>
            <td><?= $wiersz["surname"]; ?></td>
            <td></td>
            <td><?= $wzrost; ?></td>
            <td><a href="delete.php?id=<?= $wiersz["id"]; ?>">usuń</a></td>
        </tr>
        <?php
    endwhile;

    ?>
    </table>

    <?php

    if (isset($_GET["deletedUser"])):
    ?>
    <p>Usunięto użykownika o id = <?=$_GET["deletedUser"]?></p>
    <?php
    endif;

    if (isset($_GET["addUserForm"])):
    ?>
    <h4>Dodawanie użytkownika</h4>
    <form action="insert.php" method="POST">
        <label>
            Imię <br>
            <input type="text" name="imie">
        </label> <br>
        <label>
            Nazwisko <br>
            <input type="text" name="nazwisko">
        </label> <br>
        <label>
            Podaj miasto <br>
            <input type="text" name="miasto">
            <?php
            $kwerenda2 = "SELECT * FROM `city`";
            $wynik = $polaczenie->query($kwerenda2);
            while ($wiersz = $wynik->fetch_assoc()) {
              ?>
              <option value="<?= $wiersz['id'];?>"><?=$wiersz['city'];?> </option>
              <?php
            }

            ?>
        </label> <br>
        <label>
            Data urodzenia <br>
            <input type="date" name="dataUrodzenia">
        </label> <br>
        <label>
            Wzrost <br>
            <input type="text" name="wzrost">
        </label> <br>
        <input type="submit" value="Dodaj">
    </form>
    <?php
        if (isset($_GET["error"])):
        ?>
    <p><?=$_GET["error"]?></p>
        <?php
        endif;
    else:
    ?>
    <a href="?addUserForm">Dodawanie użytkownika</a>
    <?php
    endif;

    ?>



</body>
</html>
