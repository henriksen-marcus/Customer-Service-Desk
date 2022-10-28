<?php
  // Load the specified number of rows from the table 'mottak'

  include 'connect.php';
  include 'functions.php';

  if (isset($_POST["newLoadCount"]))
  {
    $newLoadCount = $_POST["newLoadCount"];

    $sql = "SELECT * FROM mottak LIMIT $newLoadCount";
    $result = mysqli_query($link, $sql);
    $cols = mysqli_field_count($link);
    if (mysqli_num_rows($result) > 0) {

      printTable($link, $result);

      if (mysqli_num_rows($result) < $newLoadCount)
      {
        echo "<p>Ingen flere mottak.</p>";
      }
    }
    else
    {
      echo "Ingen mottak funnet!";
    }
  }
?>
