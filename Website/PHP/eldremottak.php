<?php
require_once 'connect.php';
require_once 'functions.php';

$mottaknewcount = $_POST['mottaknewcount'];

$sql = "SELECT * FROM mottak LIMIT $mottaknewcount";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<p>";
      echo $row['Mottaklinje'];
        echo "<br>";
      echo $row['SumVarer'];
        echo "<br>";
      echo $row['Dato'];
      echo "</p>";

    }
}else {
  echo "Nothing here, but you";
}
?>
