<?php
  include 'connect.php';
  include 'functions.php';


  $sql = "SELECT *FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_NAME = 'produktliste';";

  $result = mysqli_query($link, $sql);

  while ($rad = mysqli_fetch_assoc($result))
  {
    $colName = $rad['COLUMN_NAME'];
    $colModName = ucfirst($colName);
    echo "<option value='$colName'>$colModName</option>";
  }
