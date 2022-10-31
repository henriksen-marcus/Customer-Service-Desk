<?php
    include 'connect.php';
    include 'functions.php';

    $return = array();

    if (isset($_POST['orderNr']))
    {
      $orderNr = $_POST['orderNr'];

      $sql = "SELECT * FROM ordre WHERE ordrenr = $orderNr";
      $ordreResult = mysqli_query($link, $sql);

      if (mysqli_num_rows($ordreResult) < 1)
      {
        $sql = "SELECT
        ordrelinje.artnr,
        p.navn,
        ordrelinje.pris,
        ordrelinje.antall
        FROM ordrelinje
        LEFT JOIN produktliste p on ordrelinje.artnr = p.artnr
        WHERE ordrelinje.ordrenr = $ordrenr";

        $ordrelinjeResult = mysqli_query($link, $sql);

        if (mysqli_num_rows($ordrelinjeResult) < 1)
        {
          $ordreRad = mysqli_fetch_assoc($ordreResult);

          $return['success'] = true;
          $return['ordreNr'] = $ordreRad['ordrenr'];
          $return['date'] = $ordreRad['dato'];
          $return['ordrelinje'] = fetchTable($link, $ordrelinjeResult);
        }
        else
        {
          $return['success'] = false;
          $return['error'] = "Could not fetch order items.";
        }

      }
      else
      {
        $return['success'] = false;
        $return['error'] = "No order with id '$orderNr' exists.";
      }
    }
    else
    {
      $return['success'] = false;
      $return['error'] = "Could not send information
                          to the server";
    }

    echo json_encode($return);
?>
