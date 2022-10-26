<?php
  include 'connect.php';

  $sql1 = "SELECT * FROM kategori;";
  $resultat = mysqli_query($link, $sql1);
  $num_rows = mysqli_num_rows($resultat);

  $index = 0;

  while ($index < $num_rows)
  {
    $rad = mysqli_fetch_assoc($resultat);
    $val = $rad["Bokstav"];
    $navn = $rad["Navn"];
    echo "<option value='$val'>$val - $navn</option>";
    $index++;
  }
?>
