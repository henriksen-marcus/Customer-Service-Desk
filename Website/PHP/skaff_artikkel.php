<?php
require_once 'login.php';

// Åpner forbindelse til databasen.
$link = mysqli_connect($tjener, $bruker, $pass, $db);
if (! $link) {
  // Enkel feilhåndtering , bare avslutter med melding.
  exit ('Feil : Fikk ikke kontakt med databasen.');
}

mysqli_set_charset($link, 'utf8');

// Safety check as well as removing unnecessary chars
function processData($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (isset($_POST['submit'])) {
  echo "Fant post, behandler data.";

  $_SESSION["NavnArr"] = null;

  $searchterm = processData($_POST['searchterm']);
  $type = $_POST['type'];

  echo $searchterm;
  echo $type;

  // Bygger opp en SQL−spørring basert på inndata fra brukeren .
	$sql = "SELECT * FROM ProduktListe WHERE $type LIKE '$searchterm%'";

	// Sender SQL−spørringen til databasen for utførelse
	$resultat = mysqli_query($link, "SELECT * FROM ProduktListe");

  // Behandler spørreresultatet og skriver ut ny nettside (HTML).
	print( ' <table border="1">');
	//print("<div float:left>");
	//print("<tr><td><b>VareNr</b></td><td><b>Pris</b></td><td><img src='sortiment.jpg' alt='Varekatalog' width='42' height='42'></td></tr>");
	print("<tr><td><b>VareNr</b></td>.<td><b>Pris</b></td>.<td><b>Beskrivelse</b></td></tr>");
	$rad = mysqli_fetch_assoc($resultat );

  

	while ($rad) {
		$vnr = $rad['VNr'];
		$pris = $rad['Pris'];
		$betegnelse = $rad['Betegnelse'];
		print("<tr><td>$vnr</td><td>$pris</td><td>$betegnelse</td></tr>");
		$rad = mysqli_fetch_assoc($resultat );
	}
	print( ' </table> </div>');
	// Lukker forbindelsen til databasen .
	mysqli_close($link);
	print("<div float:right>");
	//print("<img src='sortiment.jpg' alt='Varekatalog'>");
	print( '</div>');

}
else {
  echo "Fant ikke post.";
}
?>
