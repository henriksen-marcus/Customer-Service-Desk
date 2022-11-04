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
  $sort_by = processData($_POST['sort_by']);
  $sortOptn = processData($_POST['sortOptn']);

	$sql = "SELECT * FROM produktliste WHERE";

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

  if (!empty($navn)) { addSQL("navn LIKE '%$navn%'"); }
  if (!empty($kategori)) { addSQL("kategori = '$kategori'"); }
  if (!empty($beskrivelse)) { addSQL("beskrivelse LIKE '%$beskrivelse%'"); }
  if (!empty($pris))
  {
    // More forgiving search for price, user doesn't have
    // to remember decimal values.;
    $prisMod = number_format($pris, 0, '.', '');
    $prisModPlus = number_format($pris + 1, 0, '.', '');
    addSQL("pris BETWEEN $prisMod AND $prisModPlus");
  }
  if (!empty($hylleNr))
  {
    $hylle = $hylleBokstav . $hylleNr;
    addSQL("hylle = '$hylle'");
  }


  $sql = $sql . "ORDER BY " . $sort_by . " " . $sortOptn;

  $sqlPrint = json_encode($sql);
  echo "<script>console.log('SQL query: ' + $sqlPrint)</script>";

	$resultat = mysqli_query($link, $sql);
  if ($resultat)
  {
    $antallRader = mysqli_num_rows($resultat);
    echo "Fant $antallRader artikler.<br><br>";

  	printTable($link, $resultat);
  }
}
else {
  echo "Det har oppstått en feil.";
}
?>
