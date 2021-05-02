		<?php 
			$site_name = "Auswertung - Rohdaten";
			include ("header.php");
		?>
		<a href=rawdata.php>Zurück</a><br>
		<?php
			$zaehler = $_GET["zaehler"];
			$startdatum = $_GET["startdatum"] . ":00Z";
			$enddatum = $_GET["enddatum"] . ":00Z";
			echo shell_exec("python3 query.py $startdatum $enddatum $zaehler");
		?>
	</body>
</html>
