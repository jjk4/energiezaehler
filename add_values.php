<?php
	$config = include('config.php');
	$host = $config['host'];
	$port = $config['port'];
	$database = $config['database'];
	foreach ($config['zaehler'] as $key => $value) {
		exec ("python3 add_values.py $host $port $database $key");
	};
?>
