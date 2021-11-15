<?php

require_once "polaczenie.php";

if (!empty($_GET['id']))
{
    $sql = "DELETE FROM `user` WHERE `user`.`id` = " . $_GET['id'];
    $polaczenie->query($sql);
    if ($polaczenie->affected_rows > 0)
    {
        header("Location: mysql.php?deletedUser=" . $_GET['id']);
    }
    else
    {
        echo "<strong>Błąd:</strong> Nie udało się usuąć wiersza " . $_GET['id'];
    }
}
else
{
    header("Location: mysql.php");
}
?>
