<?php
include 'connect.php';
include 'functions.php';


if (isset($_POST['navn'])) {

  $navn = processData($_POST['navn']);
  $pris = processData($_POST['pris']);
  $kategori = processData($_POST['kategori']);
  $beskrivelse = processData($_POST['beskrivelse']);
  $hylleBokstav = processData($_POST['hylleBokstav']);
  $hylleNr = processData($_POST['hylleNr']);

	$sql = "SELECT * FROM ProduktListe WHERE";

  function addSQL($str)
  {
    global $sql;
    $arr = explode(" ", $sql);
    if (end($arr) != "WHERE")
    {
      $sql = $sql . "AND";
    }
    $sql = $sql . " " . $str . " ";
  }

  if (!empty($navn)) { addSQL("Navn LIKE '%$navn%'"); }
  if (!empty($kategori)) { addSQL("Kategori = '$kategori'"); }
  if (!empty($beskrivelse)) { addSQL("Beskrivelse LIKE '%$beskrivelse%'"); }
  if (!empty($pris))
  {
    // More forgiving search for price, user doesn't have
    // to remember decimal values.
    $prisMod = number_format($pris, 0, '.', '');
    $prisModPlus = $prisMod + 1;
    addSQL("Pris BETWEEN $prisMod AND $prisModPlus");
  }
  if (!empty($hylleNr))
  {
    $hylle = $hylleBokstav . $hylleNr;
    addSQL("Hylle = $hylle");
  }
  $sqlPrint = json_encode($sql);
  echo "<script>console.log('SQL query: ' + $sqlPrint)</script>";

	$resultat = mysqli_query($link, $sql);
  $antallRader = mysqli_num_rows($resultat);
  echo "Fant $antallRader artikler.<br><br>";

	printTable($link, $resultat);
}
else {
  echo "Det har oppstått en feil.";
}
?>
