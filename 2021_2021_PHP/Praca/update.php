<?php


if (!empty($_POST))
{
    foreach($_POST as $key => $value)
    {
        if (empty($value))
        {
            header('Location: mysql.php?updateUserForm&error=Wypełnij pole ' . $key);
            exit();
        }
    }

    require_once "polaczenie.php";

    $sql = "INSERT INTO `user` (`id`, `name`, `surname`, `brithday`, `height`, `cityid`) VALUES (NULL, '$_POST[imie]', '$_POST[nazwisko]', '$_POST[dataUrodzenia]', '$_POST[wzrost]', '$_POST[miasto]')";
    // trzeba dokończyć $sql1="UPDATE `user` SET `id` = '$_POST, `name` = 'Patryk', `surname` = 'janiak', `birthday` = '2008-06-04', `wzrost` = '162.3', `city_id` = '1' WHERE `user`.`id` = 2;"
    $polaczenie->query($sql);

    if ($polaczenie->affected_rows > 0)
    {
        header('Location: mysql.php?updateUserForm&error=Zaktualizowano użytkownika');
    }
    else
    {
        header('Location: mysql.php?updateUserForm&error=Nie udało się zaktualizować użytkownika');
    }
}
?>
