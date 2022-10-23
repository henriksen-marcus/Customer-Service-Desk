<?php
require_once 'login.php';

// Åpner forbindelse til databasen.
$link = mysqli_connect($tjener, $bruker, $pass, $db);
if (!$link) {
  // Enkel feilhåndtering , bare avslutter med melding.
  exit ('Feil : Fikk ikke kontakt med databasen.');
}

mysqli_set_charset($link, 'utf8');
?>
