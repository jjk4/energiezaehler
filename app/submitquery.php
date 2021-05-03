<html>
	<head>
		<title>Rohdaten - Energiezählerapp</title>
		<link rel="stylesheet" href="style.css">

	</head>
	<body>
		<h1>Rohdaten</h1>
		<a href=rawdata.php>Zurück</a><br>
		<?php
			$config = include('config.php');
			$timezone = $config['timezone'];
			$zaehler = $_GET["zaehler"];
			$startdatum = $_GET["startdatum"] . ":00Z";
			$enddatum = $_GET["enddatum"] . ":00Z";
			echo shell_exec("python3 ../query.py $startdatum $enddatum $zaehler");
		?>
	</body>
</html>
