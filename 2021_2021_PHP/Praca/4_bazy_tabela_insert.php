<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/style.css">
    <title>Użytkownicy</title>
  </head>
  <body>
    <h4>Użytkownicy</h4>
    <?php
      require_once './skrypty/connect.php';
      $sql = "SELECT `users`.*, `cities`.`city` FROM `users` LEFT JOIN `cities` ON `users`.`cityid` = `cities`.`id`;";
      $result = $connect->query($sql);
     if (isset($_GET['error'])) {
     echo "$_GET[info]<hr>";
    }
    echo <<< TABLE
      <table>
        <tr>
          <th>id</th>
          <th>Imię</th>
          <th>Nazwisko</th>
          <th>Data urodzenia</th>
          <th>Miasto</th>
        </tr>
    TABLE;
    while ($row = $result->fetch_assoc()) {
      echo <<< ROW
        <tr>
          <td>$row[id]</td>
          <td>$row[name]</td>
          <td>$row[surname]</td>
          <td>$row[birthday]</td>
          <td>$row[city]</td>
          <td><a href="./skrypty/delete.php?id=$row[id]">Usuń</a></td>
        </tr>
      ROW;
    }
    echo "</table><br>";

    if (isset($_GET['addUser'])) {
      echo <<<FORMADDUSER
      <h4>Dodawanie uzytkownika</h4>
      <form action="./skrypty/adduser.php" method="post">
        <input type="text" name="name" placeholder="Podaj imię"><br><br>
        <input type="text" name="surname" placeholder="Podaj Nazwisko"><br><br>
        <input type="date" name="birthday">Data urodzenia<br><br>
        <input type="text" name="cityid" placeholder="Podaj id miasta"><br><br>
        <input type="submit" value="Dodaj uzytkownika">
        </form>
FORMADDUSER;
}else {
  echo '<a href="./4_bazy_tabela_insert.php?addUser=">Dodaj uzytkownika</a>';
}

      $connect->close();
      ?>



  </body>
</html>
