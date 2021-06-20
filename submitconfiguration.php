		<?php 
			$crontab = fopen("/etc/cron.d/energiezaehler", "w" );
			$site_name = "Einstellungen";
			include ("header.php"); 
			$new_configuration = [];
			$new_configuration['host'] = $_GET["host"];
			$new_configuration['port'] = $_GET["port"];
			$new_configuration['database'] = $_GET["database"];
			$new_configuration['installationpath'] = $_GET["installationpath"];
			foreach ($config['zaehler'] as $key => $value) {
				$new_configuration["zaehler"][$key] = array(	'displayname' => $_GET[$key . "_displayname"], 
										'unit' => $_GET[$key . "_unit"], 
										'type' => $_GET[$key . "_type"],
										'sdm630_usb' => $_GET[$key . "_sdm630_usb"],
										'sdm630_id' => $_GET[$key . "_sdm630_id"],
										'sdm630_counter' => $_GET[$key . "_sdm630_counter"],
										);
				if ($_GET[$key . "_delete"] == "on")
					unset($new_configuration["zaehler"][$key]);
			};
			$new_counter = $_GET["neu_name"];
			$new_counter_display = $_GET["neu_displayname"];
			$new_counter_unit = $_GET["neu_unit"];
			if (($new_counter != "") and ($new_counter_display != "") and ($new_counter_unit != ""))
				$new_configuration["zaehler"][$new_counter] = array('displayname' => $new_counter_display, 'unit' => $new_counter_unit);
			//var_dump($new_configuration);
			exec ("mv config.json config.json.old");
			file_put_contents("config.json",json_encode($new_configuration));
			#Crontab erstellen
			fwrite( $crontab, "00  12  * * *   www-data      php " . $new_configuration["installationpath"] . "/add_values.php\n" ); #Zwischenberechnungen
			#auszulesende Zähler:
			foreach ($new_configuration['zaehler'] as $key => $value) {
				if ($value["type"] == "sdm630") {
					fwrite( $crontab, "*  00  * * *   www-data      python3 " . $new_configuration["installationpath"] . "/sdm630.py " . $new_configuration['host'] . " " .  $new_configuration['port'] . " " . $new_configuration['database'] . " " . $key . " " . $value['sdm630_counter'] . " " . $value['sdm630_usb'] . " " . $value['sdm630_id'] . "\n"); 
				};

			};

			fclose( $crontab );
		?>
		<div class="content">
			Die Einstellungen wurden gespeichert. <a href="configuration.php">Zurück</a>
		</div>
	</body>
</html>
