<html>
	<head>
		<title>Abgabe - Energiezähler</title>
		<meta http-equiv="refresh" content="1; URL=input.php">
		<link rel="stylesheet" href="style.css">

	</head>
	<body>
		<div id=okay>&#9989;</div>
		
		<?php
		$config = include('config.php');
		$timezone = $config['timezone'];
		$database = $config['database'];
		$zaehler = $_GET["zaehler"];
		$datum = $_GET["datum"];
		$wert = $_GET["wert"];
		$zeit = $_GET["zeit"];
		exec ("python3 input.py $database $zaehler $datum $zeit $wert $timezone", $output);
		?>
	</body>
</html>
