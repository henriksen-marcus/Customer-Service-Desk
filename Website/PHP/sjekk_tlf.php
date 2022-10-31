<?php
    include 'connect.php';
    include 'functions.php';

    $return = array();

    if (isset($_POST['tlfNr']))
    {
      $tlfNr = processData($_POST['tlfNr']);
      $sql = "SELECT tlf FROM medlem WHERE tlf = $tlfNr";
      $result = mysqli_query($link, $sql);

      if ($result)
      {
        if (mysqli_num_rows($result) > 0)
        {
          $row = mysqli_fetch_assoc($result);
          if ($tlfNr == $row['tlf'])
          {
            $sql =
            "SELECT o.ordrenr, o.dato, o.betalingsmetode, SUM(ol.pris) AS Sum
             FROM medlem m
             LEFT JOIN ordre o ON m.kundenr = o.kundenr
             LEFT JOIN ordrelinje ol ON o.ordrenr = ol.ordrenr
             WHERE (SELECT kundenr FROM medlem WHERE tlf = $tlfNr LIMIT 1)";
             $result = mysqli_query($link, $sql);

             if (mysqli_num_rows($result) > 0)
             {
               $return['ordreliste'] = fetchTable($link, $result);

               $sql =
               "SELECT kundenr, navn, tlf, adresse
                FROM medlem
                WHERE tlf = $tlfNr LIMIT 1";

                $result = mysqli_query($link, $sql);
                $rad = $result->fetch_assoc();

                $return['kundenr'] = $rad['kundenr'];
                $return['navn'] = $rad['navn'];
                $return['tlf'] = $rad['tlf'];
                $return['adresse'] = $rad['adresse'];
                $return['success'] = true;
             }
             else
             {
               $sql = "SELECT navn FROM medlem WHERE tlf = $tlfNr";
               $result = mysqli_query($link, $sql);
               $row = $result->fetch_assoc();
               $navn = $row['navn'];

               $return['success'] = false;
               $return['error'] = "Ingen ordre funnet for medlem '$navn'.";
             }
          }
          else
          {
            $return['success'] = false;
            $return['error'] = "Nummeret $tlfNr finnes ikke hos noen aktive medlem.";
          }
        }
        else
        {
          $return['success'] = false;
          $return['error'] = "Noe rart har skjedd....";
        }
      }
      else
      {
        $return['success'] = false;
        $return['error'] = "Nummeret $tlfNr finnes ikke hos noen aktive medlem.";
      }
    }
    else {
      $return['success'] = false;
      $return['error'] = "Could not send information
                          to the server";
    }

    echo json_encode($return);
?>
