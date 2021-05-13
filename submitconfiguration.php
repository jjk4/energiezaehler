		<?php 
			$site_name = "Einstellungen";
			include ("header.php"); 
			$new_configuration = [];
			$new_configuration['host'] = $_GET["host"];
			$new_configuration['port'] = $_GET["port"];
			$new_configuration['database'] = $_GET["database"];
			foreach ($config['zaehler'] as $key => $value) {
				$new_configuration["zaehler"][$key] = array('displayname' => $_GET[$key . "_displayname"], 'unit' => $_GET[$key . "_unit"]);
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
		?>
		<div class="content">
			Die Einstellungen wurden gespeichert. <a href="configuration.php">Zurück</a>
		</div>
	</body>
</html>
