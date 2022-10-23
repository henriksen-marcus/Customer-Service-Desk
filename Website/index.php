<?php
	//session_start();
	//$_SESSION["NavnArr"] = array();
	require_once 'PHP/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="CSS/index.css"/>
		<title>Jula</title>
	</head>
	<body>
    <img id="logo" src="https://i.imgur.com/oyQFzWx.png">
    <div id="wrapper">
      <span style="padding-left: 32px;"></span>
      <span>Server status:</span>
      <!-- This will change depending on the feedback from PHP. -->
			<?php
			if (isset($link))
			{
				if ($link)
				{
					echo "<span style='color:green'>Connected</span>";
				}
				else
				{
					echo "<span style='color:red'>Not connected</span>";
				}
			}
			else
			{
				echo "<span style='color:red'>Not connected</span>";
			}
			?>
      <br>
      <div class="flex-container">
        <a href="after_sales.php">After sales</a>
        <a href="registrer_medlem.php">Registrer medlem</a>
        <a href="vedlikehold_medlem.php">Vedlikehold medlem</a>
        <a href="artikkeloversikt.php">Artikkeloversikt</a>
        <a href="mottak.php">Mottak</a>
        <a href="endre_artikkel.php">Endre artikkel</a>
				<a href="legg_til_artikkel.php">Legg til artikkel</a>
      </div>
    </div>
	</body>
</html>
