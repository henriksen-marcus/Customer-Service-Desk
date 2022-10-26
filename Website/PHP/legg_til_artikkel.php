<?php
include 'connect.php';
include 'functions.php';

$navnError = false;
$prisError = false;
$kategoriError = false;
$beskrivelseError = false;
$antallError = false;
$hylleError = false;

if (isset($_POST['submit']))
{
  $navn = processData($_POST['navn']);
  $pris = processData($_POST['pris']);
  $kategori = processData($_POST['kategori']);
  $beskrivelse = processData($_POST['beskrivelse']);
  $antall = processData($_POST['antall']);
  $hylle = processData($_POST['hylle']);

  if (!isset($navn) || $navn.strlen() < 2) { $nanvError = true; }

  if (!isset($kategori)) { $kategoriError = true; }
  $sql = "SELECT COUNT(1) FROM Kategori WHERE Bokstav = "

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
