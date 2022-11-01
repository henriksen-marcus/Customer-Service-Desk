<?php
include 'connect.php';
include 'functions.php';

$mlnr = processData($_POST['mlnr']);
$sumvarer = processData($_POST['sumvarer']);
$dato = processData($_POST['dato']);

//php check date

$sql = "INSERT INTO mottak (`mottaksnr`, `sumvarer`, `dato`) VALUES ($mlnr, $sumvarer, $dato);";
$success = mysqli_query($link, $sql);

if ($success==TRUE) {
  echo "Data inserted!";
  echo "<script>console.log($bool)</script>";
}
else {
  echo "Failed!";
}
header("Location: ../mottak.html?mottak=success");
?>
