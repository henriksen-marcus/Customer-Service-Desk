<?php
    include 'connect.php';
    include 'functions.php';

    function returnError($msg)
    {
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
          mysqli_data_seek($ordreResult, 0);
          $return['ordrelinje'] = fetchTable($link, $ordrelinjeResult);

          $sql = "SELECT servicenr FROM service WHERE ordrenr = $orderNr LIMIT 1";
          $result = mysqli_query($link, $sql);

          if (mysqli_num_rows($result) > 0)
          {
            $servicenr = $result->fetch_assoc()['servicenr'];
            $sql = "SELECT artnr, antall, type FROM servicelinje WHERE servicenr = $servicenr";
            $result = mysqli_query($link, $sql);

            if (mysqli_num_rows($result) > 0)
            {
              while ($row = $result->fetch_assoc())
              {
                $artnrStr = strval($row['artnr']);
                $return['servicelinje'][$arnrStr] = array(
                  "antall" => $row['antall'],
                  "type" => $row['type']
                );
              }
            }


          }

        }
        else { returnError("Could not fetch order items."); }
      }
      else { returnError("No order with id '$orderNr' exists."); }
    }
    else { returnError("Could not send information to the server"); }

    echo json_encode($return);
?>
