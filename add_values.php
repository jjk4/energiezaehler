<?php
	$config = include('config.php');
	$timezone = $config['timezone'];
	$database = $config['database'];
	foreach ($config['zaehler'] as $key => $value) {
		exec ("python3 add_values.py $database $key $timezone");
	};
?>
