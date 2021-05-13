<html>
	<head>
		<title><?=$site_name?> - Energiezähler</title>
		<link rel="stylesheet" href="style.css">
		<link rel="icon" href="favicon.ico" />

	</head>
	<body>
		<a href="index.php"><img src="logobig.png" id="logo"></a>
		<div class="header">
			<a href="index.php">Start</a>
			<a href="input.php">Dateneingabe</a>
			<a href="analysis.php">Auswertung</a>
			<a href="configuration.php">Einstellungen</a>
		</div>
		<h2><?=$site_name?> - Energiezähler</h2>
		<?php
			$config = json_decode(file_get_contents('config.json'), true);
		?>
