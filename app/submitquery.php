<html>
	<head>
		<title>Rohdaten - Energiezählerapp</title>
		<link rel="stylesheet" href="style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

	</head>
	<body>
		<h1>Rohdaten</h1>
		<a href=rawdata.php>Zurück</a><br>
		<?php
			$config = include('../config.php');
			$timezone = $config['timezone'];
			$database = $config['database'];
			$zaehler = $_GET["zaehler"];
			$startdatum = $_GET["startdatum"] . ":00Z";
			$enddatum = $_GET["enddatum"] . ":00Z";
			echo shell_exec("python3 ../query.py $database $startdatum $enddatum $zaehler")
		?>
	</body>
</html>
