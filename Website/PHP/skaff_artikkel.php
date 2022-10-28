<?php
include 'connect.php';
include 'functions.php';


if (isset($_POST['navn'])) {

  $navn = processData($_POST['navn']);
  $pris = processData($_POST['pris']);
  $kategori = processData($_POST['kategori']);
  $beskrivelse = processData($_POST['beskrivelse']);
  $antall = processData($_POST['antall']);
  $hylleBokstav = processData($_POST['hyllebokstav']);
  $hylleNr = processData($_POST['hyllenr']);

	$sql = "SELECT * FROM ProduktListe WHERE $type LIKE '$searchterm%'";

	$resultat = mysqli_query($link, "SELECT * FROM ProduktListe");

	while ($rad = mysqli_fetch_assoc($resultat );) {
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
