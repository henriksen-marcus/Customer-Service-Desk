<?php
include 'connect.php';
include 'functions.php';

$return = array();
$return['sumvarererror'] = false;

if (isset($_POST['sumvarer']))
{
  $sumvarer = processData($_POST['sumvarer']);
  if (empty($sumvarer) || strlen((string)$sumvarer) > 8) { $return['sumvarererror'] = true; }

  $sql = "INSERT INTO mottak (sumvarer) VALUES ($sumvarer);";
  $result = mysqli_query($link, $sql);

  if ($result) {
      $return['success'] = true;

      }
      else {
        $return['success'] = false;
        $return['error'] = $link->error;

      }
}
else {
  $return['success'] = false;
}
    echo json_encode($return);
?>
