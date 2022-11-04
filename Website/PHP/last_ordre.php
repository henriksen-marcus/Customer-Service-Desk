<?php
    include 'connect.php';
    include 'functions.php';

    function returnError($msg)
    {
      global $return;
      $return['success'] = false;
      $return['error'] = $msg;
    }

    $return = array();
    $return['servicelinje'] = array();

    if (isset($_POST['orderNr']))
    {
      $orderNr = $_POST['orderNr'];

      $sql = "SELECT * FROM ordre WHERE ordrenr = $orderNr";
      $ordreResult = mysqli_query($link, $sql);

      $fields = $ordreResult->fetch_fields();
      $return['hello'] = "Hey";
      if (mysqli_num_rows($ordreResult) > 0)
      {
        $sql = "SELECT
        ordrelinje.artnr,
        p.navn,
        ordrelinje.pris,
        ordrelinje.antall
        FROM ordrelinje
        LEFT JOIN produktliste p on ordrelinje.artnr = p.artnr
        WHERE ordrelinje.ordrenr = $orderNr";

        $ordrelinjeResult = mysqli_query($link, $sql);

        if (mysqli_num_rows($ordrelinjeResult) > 0)
        {
          $ordreRad = mysqli_fetch_assoc($ordreResult);
          $return['success'] = true;
          $return['ordrenr'] = $orderNr;
          $return['date'] = $ordreRad['dato'];
          //mysqli_data_seek($ordreResult, 0);
          $return['ordrelinje'] = fetchTable($link, $ordrelinjeResult);

          // Check if any services has been done on the order
          $sql = "SELECT servicenr FROM service WHERE ordrenr = $orderNr LIMIT 1";
          $result = mysqli_query($link, $sql);

          if (mysqli_num_rows($result) > 0)
          {
            // Find all services done on the order
            $servicenr = $result->fetch_assoc()['servicenr'];
            $sql = "SELECT artnr, type FROM servicelinje WHERE servicenr = $servicenr";
            $result = mysqli_query($link, $sql);

            if (mysqli_num_rows($result) > 0)
            {
              while ($row = $result->fetch_assoc())
              {
                array_push($return['servicelinje'], array(
                  'artnr' => $row['artnr'],
                  'type' => $row['type']
                ));
              }
            } // Else: Ingen service funnet på ordre
          } // Else: Ingen service funnet på ordre

        }
        else { returnError("Order contains no items."); }
      }
      else { returnError("No order with id '$orderNr' exists."); }
    }
    else { returnError("Could not send information to the server."); }

    echo json_encode($return);
?>
