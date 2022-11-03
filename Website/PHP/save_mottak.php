<?php
include 'connect.php';
include 'functions.php';

$return = array();

$mlnrerror = false;
$sumvarererror = false;
$datoerror = false;

if (isset($_POST['mlnr']))
{

  $mlnr = processData($_POST['mlnr']);
  $sumvarer = processData($_POST['sumvarer']);
  $sumvarer = processData($_POST['dato']);

  if (empty($mlnr)) { $mlnrerror = true; }
  if (empty($sumvarer)) { $sumvarererror = true; }
  if (empty($dato)) { $datoerror = true; }


  $sql = "INSERT INTO mottak (mottaksnr, sumvarer, dato) VALUES ($mlnr, $sumvarer, $dato);";
  $result = mysqli_query($link, $sql);


  if ($result) {

      $result = mysqli_query($link, $sql);
      $rad = $result->fetch_assoc();

      $return['mlnr'] = $rad['mlnr'];
      $return['sumvarer'] = $rad['sumvarer'];
      $return['dato'] = $rad['dato'];
      $return['success'] = true;


      }
      else {
        $return['success'] = false;
        $return['error'] = "Mottak ikke akseptert";

      }
      if ($mlnrerror || $sumvarererror || $datoerror) {

        echo json_encode(array($mlnrerror, $sumvarererror, $datoerror));
      }
      else {
        $data = array();
        $data += array("mottaknr" => $mlnr);
        $data += array("sumvarer" => $sumvarer);
        $data += array("dato" => $dato);

        $key = array_keys($data);
        $val = array_values($data);

        $sql = "INSERT INTO mottak (" . implode(', ', $key) . ")"
              . "VALUES ('" . implode("', '", $val) . "')";
              if (mysqli_query($link, $sql)) { echo "1"; die; }
              else { $return['success'] = false; }
      }
}
else {
  $return['success'] = false;
}


// I jQuery: se 'last_ordre.php' linje 37 og ned
// Bruk jQuery.parseJSON(response) til å lage et objekt av arrayen du fikk fra php
// Så kan du bare kalle på variablene i klasseobjektet, slik som vi gjør i c++

    echo json_encode($return);
?>
