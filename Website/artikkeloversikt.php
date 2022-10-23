<html lang="en">
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="CSS/stylesheet.css"/>
		<title>Home</title>
	</head>
	<body>
    <img id="logo" src="https://i.imgur.com/oyQFzWx.png">

  <div id="wrapper">
    <form method="POST" action="PHP/skaff_artikkel.php">
      <label for="searchterm">Søk artikkel:</label><br>
      <input type="text" name="searchterm" placeholder="Skriv her" autofocus>
      <label for="type">Type søk:</label>
      <select name="type">
        <option value="searchterm">Art.nr</option>
        <option value="navn">Navn</option>
        <option value="kategori">Kategori</option>
        <option value="pris">Pris</option>
      </select>
      <br>
      <button type="submit" name="submit" style="margin-top: 5px">Søk</button>
    </form>
  </div>


	</body>
</html>
