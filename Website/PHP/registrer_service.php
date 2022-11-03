<?php
  include 'connect.php';
  include 'functions.php';

  $return = array();

  if (isset($_POST['data']))
  {
    $data = $_POST['data'];
    $ordrenr = $data['ordrenr'];
    $items = $data['items'];
    $type = $data['type'];

    $sql = "INSERT INTO service (ordrenr)
            VALUES ($ordrenr)";
    $result = mysqli_query($link, $sql);

    $val = $result ? "true" : "false";
    echo $val;
    echo $link->error;

    if ($type == "retur")
    {
      $sql =
      "INSERT INTO
       servicelinje (servicenr, artnr, antall, type)
       VALUES ()";

      $return['success'] = $result ? true : false;
    }
    else
    {

    }
  }

  echo json_encode($return);
?>
