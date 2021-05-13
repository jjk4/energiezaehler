		<?php 
			$site_name = "Auswertung - Rohdaten";
			include ("header.php");
		?>
		<div class="content">
		<a href=rawdata.php>Zurück</a><br>
			<?php
				$database = $config['database'];
				$host = $config['host'];
				$port = $config['port'];
				$zaehler = $_GET["zaehler"];
				$startdatum = $_GET["startdatum"] . ":00Z";
				$enddatum = $_GET["enddatum"] . ":00Z";
				echo shell_exec("python3 query.py $host $port $database $zaehler $startdatum $enddatum");
			?>
		</div>
	</body>
</html>
