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

    // Check if service for order already exists
    $sql = "SELECT servicenr FROM service WHERE ordrenr = $ordrenr";
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) > 0)
    {
      // Service for this order already exists,
      // use same service number in servicelinje
      $row = $result->fetch_assoc();
      $servicenr = $row['servicenr'];
    }
    else {
      // Service does not exists, create new
      $sql = "INSERT INTO service (ordrenr) VALUES ($ordrenr)";
      $result = mysqli_query($link, $sql);

      // Get the service number back
      $sql = "SELECT servicenr FROM service ORDER BY servicenr DESC LIMIT 1";
      $result = mysqli_query($link, $sql);
      $servicenr = $result->fetch_row()[0];
    }

    // NOTE: The only thing that changes here is the $servicenr

    // Insert service items
    $sql =
    "INSERT INTO
     servicelinje (servicenr, artnr, type)
     VALUES ";

     for ($i = 0; $i < sizeof($items); $i++)
     {
       if ($i == sizeof($items) - 1) {
         $sql = $sql . "($servicenr, $items[$i], '$type')";
       }
       else {
         $sql = $sql . "($servicenr, $items[$i], '$type'), ";
       }

     }
     $result = mysqli_query($link, $sql);

     $return['success'] = $result ? true : false;
     $return['error'] = $result ? "" : $link->error;
  }
  else
  {
    $return['success'] = false;
    $return['error'] = "Did not receive any data.";
  }

  echo json_encode($return);
?>
