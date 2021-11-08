<?php
  if (!empty($_POST['name'])&&!empty($_POST['surname'])&&!empty($_POST['birthday'])&&!empty($_POST['cityid'])) {
    echo"Dane wypełnione";
  }
  else {
    header('location: ../4_bazy_tabela_insert.php?error=1&info=Wypełnij wszystkie dane!&addUser=');
  }
 ?>
