<?php
	$config = json_decode(file_get_contents('config.json'), true);
	$new_configuration['host'] = $argv[1];
	$new_configuration['port'] = $argv[2];
	$new_configuration['database'] = $argv[3];
	$new_configuration['installationpath'] = $argv[4];
	$new_configuration['zaehler'] = $config['zaehler'];
	file_put_contents("config.json",json_encode($new_configuration));
?>
