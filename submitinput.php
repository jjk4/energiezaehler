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
		$database = $config['database'];
		$host = $config['host'];
		$port = $config['port'];
		$zaehler = $_GET["zaehler"];
		$datum = $_GET["datum"];
		$wert = $_GET["wert"];
		exec ("python3 input.py $host $port $database $zaehler $datum $wert", $output);
		?>
	</body>
</html>
