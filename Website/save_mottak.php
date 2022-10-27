<?php
include 'connect.php';

$mlnr = $_POST['Mottaklinje'];
$sumvarer = $_POST['SumVarer'];
$dato = $_POST['Dato'];

$sql = "INSERT INTO mottak VALUES (`mlnr`, `sumvarer`, `dato`);"
if (mysqli_query($link, $sql)) {
  echo json_encode(array("statusCode"=>200));
}
else {
  echo json_encode(array("statusCode"=>201));
}
mysqli_close($link);
?>
