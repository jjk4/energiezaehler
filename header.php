<?php
	$config = require("config.php");
	$db = new mysqli($config["database"]["host"], $config["database"]["username"], $config["database"]["password"], $config["database"]["dbname"]);
	if ($db->connect_error) {
		die("Database Error: " . $db->connect_error);
	}
	

?>
<html>
	<head>
		<title><?=$site_name?> - Energiezähler</title>
		<link rel="stylesheet" href="style.css">
		<link rel="icon" href="favicon.ico" />
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://kit.fontawesome.com/f54f800e80.js" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	</head>
	<body>
		<a href="index.php"><img src="logobig.png" id="logo"></a>
		<div class="header">
			<a href="index.php">Start</a>
			<a href="input.php">Dateneingabe</a>
			<a href="analysis.php">Auswertung</a>
			<a href="import.php">Import</a>
			<a href="configuration.php">Einstellungen</a>
		</div>
		<h2><?=$site_name?> - Energiezähler</h2>

		<div class="content">