<?php
  // Laster siste line som ble lagt til i produktliste.

  //include 'connect.php';

  $tjener = 'localhost';
  $db = 'jula';
  $bruker = 'root';
  $pass = '';

  // Åpner forbindelse til databasen.
  $link = mysqli_connect($tjener, $bruker, $pass, $db);
  if (!$link) {
    // Enkel feilhåndtering , bare avslutter med melding.
    exit ('Feil : Fikk ikke kontakt med databasen.');
  }

  mysqli_set_charset($link, 'utf8');

  echo "<p>Laster!!!!!!!!!!!!!!</p>"
?>

  <!-- $sql = "SELECT * FROM Produktliste LIMIT 1;";
  $resultat = mysqli_query($link, $sql);

  if (mysqli_num_rows($result) > 0)
  {
    $artnr = $rad['artnr'];
		$pris = $rad['pris'];
		$beskrivelse = $rad['beskrivelse'];

    echo "<tr><td><b>VareNr</b></td>.<td><b>Pris</b></td>.<td><b>Beskrivelse</b></td></tr>";
    echo "<tr><td>$artnr</td><td>$pris</td><td>$beskrivelse</td></tr>";
  }
  else
  {
      echo "<p>Could not load database result. No rows returned.</p>";
  }
?> -->
