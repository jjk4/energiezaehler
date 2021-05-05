<html>
	<head>
		<title><?=$site_name?> - Energiezähler</title>
		<link rel="stylesheet" href="../style.css">
		<link rel="icon" href="../favicon.ico" />

	</head>
	<body>
		<img src="../logobig.png" id="logo">
		<div class="header">
			<a href="../index.php">Start</a>
			<a href="../input.php">Dateneingabe</a>
			<a href="../analysis.php">Auswertung</a>
		</div>
		<h2><?=$site_name?> - Energiezähler</h2>
		<?php
			$config = include('../config.php');
		?>
