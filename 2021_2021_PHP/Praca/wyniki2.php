<?php
 if (!empty($_POST["name"]) && !empty($_POST["kw"]))//!empty jest lepszy niż isset
 {
  switch ($_POST["kw"]) {
    case 'kw':
      header(Location: kwadrat.php)
      break;

    case 'pr':
        header(Location: prostokat.php)
        break;

  }
}
 else
 {

  ?>
  <script>
    history.back()

  </script>
  <?php
  //history.back() cofa cię w czasie
 }
?>
