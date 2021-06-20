<?php
	$config = json_decode(file_get_contents('config.json'), true);
	$host = $config['host'];
	$port = $config['port'];
	$username = $config['username'];
	$password = $config['password'];
	$database = $config['database'];
	foreach ($config['zaehler'] as $key => $value) {
		exec ("python3 add_values.py $host $port $database  $username $password $key");
	};
?>
