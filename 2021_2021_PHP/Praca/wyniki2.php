<?php
if (!empty($_POST["name"]) && !empty($_POST["kw"]))
{
 switch ($_POST["kw"]) {
   case 'kw':
    header("Location: kwadrat.php");
     break;

   case 'pr':
    header("Location: prostokat.php");
     break;
 }
}
else
{
  ?>
  <script>history.back()</script>
  <?php
}




 ?>
