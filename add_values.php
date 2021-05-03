<?php
	$config = include('config.php');
	$timezone = $config['timezone'];
	foreach ($config['zaehler'] as $key => $value) {
		exec ("python3 add_values.py $key $timezone");
	};
?>
