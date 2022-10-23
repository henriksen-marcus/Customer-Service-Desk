<html lang="en">
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="CSS/stylesheet.css"/>
		<title>Home</title>
	</head>
	<body>
    <img id="logo" src="https://i.imgur.com/oyQFzWx.png">

  <div id="wrapper" style="width: 200px;">
	    <form method="POST" action="PHP/legg_til_artikkel_php.php">
		      <label for="artikkelnavn">Artikkelnavn:</label><br>
		      <input type="text" name="artikkelnavn" autofocus>*
					<br>
		      <label for="pris">Pris:</label><br>
					<input type="text" name="pris">
					<br>
					<label for="kategori">Kategori:</label><br>
					<input type="text" name="kategori">*
					<br>
					<label for="beskrivelse">Beskrivelse:</label><br>
					<textarea type="text" name="beskrivelse" rows="5"></textarea>
					<br>
					<label for="antall">Antall:</label><br>
					<input type="text" name="antall" value="0">*
					<br>
					<label for="hylle">Hylle:</label><br>
					<input type="text" name="hylle">
					<br>
		      <button type="submit" name="submit" style="margin-top: 5px">Legg til</button>
	    </form>

			<?php
			echo isset($_GET['success']);
			if (isset($_GET['success']))
			{
				// Grønn mld og at det er lagt til
				echo "<p class='successmsg'>Artikkel lagt til!</p><br>";

				// Hent det brukeren la til fra databasen, og vis det
				// $sql = "SELECT * FROM ProduktListe ORDER BY ArtNr LIMIT 1;";
				// $resultat =  mysqli_querey($link, $sql);
				// $rad = mysqli_fetch_assoc($resultat);
				//
				// echo "<tr><td><b>Art.Nr</b></td></tr>.<tr><td><b>Navn</b></td></tr>";
				// echo "<tr><td>$rad['ArtNr']</td><td>$rad['Navn']</td></tr>";
			}
			elseif (isset($_GET['error_arr'])) {
				$error_arr = $_GET['error_arr'];
				echo $error_arr;
			}
			?>
  </div>


	</body>
</html>

<!--
<select name="type">
	<option value="searchterm">Art.nr</option>
	<option value="navn">Navn</option>
	<option value="kategori">Kategori</option>
	<option value="pris">Pris</option>
</select>
 -->
