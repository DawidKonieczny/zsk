<?php


if (!empty($_POST))
{
    foreach($_POST as $key => $value)
    {
        if (empty($value))
        {
            header('Location: mysql.php?addUserForm&error=Wypełnij pole ' . $key);
            exit();
        }
    }

    require_once "polaczenie.php";

    $sql = "INSERT INTO `user` (`id`, `name`, `surname`, `brithday`, `height`, `cityid`) VALUES (NULL, '$_POST[imie]', '$_POST[nazwisko]', '$_POST[dataUrodzenia]', '$_POST[wzrost]', '$_POST[miasto]')";
    $polaczenie->query($sql);

    if ($polaczenie->affected_rows > 0)
    {
        header('Location: mysql.php?addUserForm&error=Dodano użytkownika');
    }
    else
    {
        header('Location: mysql.php?addUserForm&error=Nie udało się dodać użytkownika');
    }
}
?>
