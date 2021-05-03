<?php
	$config = include('config.php');
	foreach ($config['zaehler'] as $key => $value) {
		exec ("python3 add_values.py $key");
	};
?>
