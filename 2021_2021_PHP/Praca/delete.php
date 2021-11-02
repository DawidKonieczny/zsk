<?php

require_once '/connect.php';
if(!empty($_GET["id"]))
{
  $id=$_GET['id'];
  $sql="DELETE FROM 'user' WHERE 'user'.'id' =$id";
  $connect->query($sql);
  /*if(mysqli_result($connect->query($sql)))
  {
    echo "ok";
  }
  else
  {
    echo "errrror";
  } nie działa*/
}
else {
  header('location:/baza_danych_delete.php');
}



 ?>
