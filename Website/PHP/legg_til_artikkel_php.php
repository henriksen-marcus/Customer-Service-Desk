<?php
require_once 'login.php';

// Åpner forbindelse til databasen.
$link = mysqli_connect($tjener, $bruker, $pass, $db);
if (! $link) {
  // Enkel feilhåndtering , bare avslutter med melding.
  exit ('Feil : Fikk ikke kontakt med databasen.');
}

mysqli_set_charset($link, 'utf8');

$error_arr = [false, false, false];

// Safety check as well as removing unnecessary chars
function processData($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (isset($_POST['submit']))
{
  $artikkelnavn = processData($_POST['artikkelnavn']);
  $pris = processData($_POST['pris']);
  $kategori = processData($_POST['kategori']);
  $beskrivelse = processData($_POST['beskrivelse']);
  $antall = processData($_POST['antall']);
  $hylle = processData($_POST['hylle']);

  if (!isset($artikelnanv) || $artikkelnavn.strlen() < 2) { $error_arr[0] = true; }
  if (!isset($kategori)) { $error_arr[1] = true; }
  if (!isset($antall)) { $error_arr[2] = true; }

  // Check if we have any invalid inputs, if so go back
  foreach ($error_arr as $key) {
    echo "<script>console.log('{$key}' );</script>";
    sleep(1);
    if ($key)
    {
      header("Location: ../legg_til_artikkel.php?success=false&error_arr=$error_arr");
      die;
    }
  }

  $sql = "INSERT INTO ProduktListe (Navn, Pris, Kategori, Beskrivelse, Antall, Hylle)
  VALUES ($artikkelnavn, $pris, $kategori, $beskrivelse, $antall, $hylle);";

  // Database request
  //mysqli_query($link, $sql);

  // Redirect back to html page
  header("Location: ../legg_til_artikkel.php?success=true");
}
?>
