<?php
include 'connect.php';
include 'functions.php';

//ER428
// Her må du ha en sjekk om vi får data fra jquery i det hele tatt,
// se 'mottak_php.php' linje 7. hvis vi bruker en verdi vi ikke får
// krasjer koden

$mlnr = processData($_POST['mlnr']);
$sumvarer = processData($_POST['sumvarer']);
$dato = processData($_POST['dato']);

//php check date

//ER428
// Ikke bruk '' inni ""..
// Du skriver allerede inne i anførselstegn. Skriv kolonnenavnet direkte
$sql = "INSERT INTO mottak (`mottaksnr`, `sumvarer`, `dato`) VALUES ($mlnr, $sumvarer, $dato);";
//ER428
// Bruk helst "result" som mysqli_query navn, det er standard
$success = mysqli_query($link, $sql);

//ER428
// if($success) - Du trenger ikke "==TRUE"
if ($success==TRUE) {
  echo "Data inserted!";
  //ER428
  // Du kopierte koden min direkte.. du må jo endre "$bool" til booleanen
  // du vil sjekke
  // Her får du error fordi det er ingen variablel $bool definert
  // Dessuten vil dette aldri kjøre hvis veriden er false fordi det er inni en
  // if setning
  echo "<script>console.log($bool)</script>";
}
else {
  echo "Failed!";
}
//ER428
// Vi bruker ikke headers siden vi bruker ajax som laster inn
// php direkte uten å reloade sida. Fjern
header("Location: ../mottak.html?mottak=success");

//ER428
// Tips: Bruk JSON til å kommunisere mellom jQuery og PHP
// Se hvordan jeg bruker $return i 'sjekk_tlf.php'.

// $return = array(); Lag array
// $return['someIndexName'] = someValue; Lag en index som heter 'someIndexName'
// og sett den lik someValue
// $return['someIndexName'] = newValue; Oppdater verdien, hvis du trenger det
// Når du er ferdig, bruk 'echo json_encode($return)'.
// Da gjør php arrayen om til JSON, som du kan dekode i jQuery

// I jQuery: se 'last_ordre.php' linje 37 og ned
// Bruk jQuery.parseJSON(response) til å lage et objekt av arrayen du fikk fra php
// Så kan du bare kalle på variablene i klasseobjektet, slik som vi gjør i c++

?>
