<?php
include 'connect.php';
include 'functions.php';

$navnError = false;
$prisError = false;
$kategoriError = false;
$beskrivelseError = false;
$antallError = false;
$hylleError = false;

if (isset($_POST['navn']))
{
  $navn = processData($_POST['navn']);
  $pris = processData($_POST['pris']);
  $kategori = processData($_POST['kategori']);
  $beskrivelse = processData($_POST['beskrivelse']);
  $antall = processData($_POST['antall']);
  $hylleBokstav = processData($_POST['hyllebokstav']);
  $hylleNr = processData($_POST['hyllenr']);

  // Check article name for errors
  if (!isset($navn) || strlen($navn) < 2) { $navnError = true; }

  //Check price for error
  if (!empty($pris))
  {
    $pris = number_format($pris, 2, '.', '');
    if ($pris > 99999.99 || $pris < 0) { $prisError = true; }
  }

  // Check category for errors
  if (!isset($kategori)) { $kategoriError = true; }

  $sql = "SELECT bokstav FROM kategori";
  $resultat = mysqli_query($link, $sql);

  for ($i = 0; $i < mysqli_num_rows($resultat); $i++)
  {
    $rad = mysqli_fetch_assoc($resultat);
    $val = $rad["bokstav"];
    // If the category is valid
    if ($kategori == $val)
    {
      break;
    }
    else if ($i == mysqli_num_rows($resultat) - 1)
    {
      $kategoriError = true;
    }
  }

  // Check description for error
  if (strlen($beskrivelse) > 1500)
  {
    $beskrivelseError = true;
  }

  // Check number for error
  $antall = number_format($antall, 0, '', '');
  if (!isset($antall) || $antall < 0) { $antallError = true; }

  // Check shelf pos error
  if (!empty($hylleNr))
  {
    $resultat = mysqli_query($link, $sql);
    for ($i = 0; $i < mysqli_num_rows($resultat); $i++)
    {
      $val = $resultat->fetch_assoc()["bokstav"];
      // If the category is valid
      if ($hylleBokstav == $val)
      {
        break;
      }
      else if ($i == mysqli_num_rows($resultat) - 1)
      {
        $hylleError = true;
      }
    }
    if ($hylleNr > 999) { $hylleError = true; }
  }

  // Check if we found any errors
  if ($navnError || $prisError || $kategoriError || $beskrivelseError
      || $antallError || $hylleError)
  {
    echo "0";
    echo json_encode(array($navnError, $prisError, $kategoriError,
    $beskrivelseError, $antallError , $hylleError));
  }
  else
  {
    $data = array();
    $data += array("Navn" => $navn);
    $data += array("Kategori" => $kategori);
    $data += array("Antall" => $antall);

    if (!empty($pris)) {$data += array("Pris" => $pris);}
    if (!empty($beskrivelse)) {$data += array("Beskrivelse" => $beskrivelse);}
    if (!empty($hylleNr)) {$data += array("Hylle" => $hylleBokstav . $hylleNr);}

    $key = array_keys($data);
    $val = array_values($data);
    $sql = "INSERT INTO ProduktListe (" . implode(', ', $key) . ") "
         . "VALUES ('" . implode("', '", $val) . "')";
    if (mysqli_query($link, $sql)) { echo "1"; die; }
    else { echo "Could not load database information: " . $link->error; }
  }
}
?>
