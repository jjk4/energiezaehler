<html>
	<head>
		<title><?=$site_name?> - Energiezählerapp</title>
		<link rel="stylesheet" href="style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
		<script src="jquery.js"></script>


	</head>
	<body>
		<h2><?=$site_name?></h2>
		<?php
			$config = json_decode(file_get_contents('../config.json'), true);
		?>
