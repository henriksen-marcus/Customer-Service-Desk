<?php
  //include 'connect.php';
  include 'login.php';
  //echo "<script>console.log('Hello there.')</script>";
  // Åpner forbindelse til databasen.
  $link = mysqli_connect($tjener, $bruker, $pass, $db);
  if ($link) {echo "true"; } else { echo "false"; }
?>
