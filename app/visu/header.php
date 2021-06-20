<html>
	<head>
		<title><?=$site_name?> - Energiezähler</title>
		<link rel="stylesheet" href="../style.css">
		<link rel="icon" href="../../favicon.ico" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
		<script src="jquery.js"></script>
	</head>
	<body>
		<h2><?=$site_name?> - Energiezähler</h2>
		<?php
			$config = json_decode(file_get_contents('../../config.json'), true);
		?>
