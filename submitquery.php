		<?php 
			$site_name = "Auswertung - Rohdaten";
			include ("header.php");
		?>
		<a href=rawdata.php>Zurück</a><br>
		<?php
			$timezone = $config['timezone'];
			$database = $config['database'];
			$zaehler = $_GET["zaehler"];
			$startdatum = $_GET["startdatum"] . ":00+0" . $timezone . ":00";
			$enddatum = $_GET["enddatum"] . ":00+0" . $timezone . ":00";
			echo shell_exec("python3 query.py $database $startdatum $enddatum $zaehler");
		?>
	</body>
</html>
