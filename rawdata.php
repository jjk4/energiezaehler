<html>
	<head>
		<title>Auswertung - Energiezählerapp</title>
		<link rel="stylesheet" href="style.css">

	</head>
	<body>
		<?php
			$config = include('../config.php');
		?>
		<h1>Rohdaten</h1>
		<form action="submitquery.php">
			<label>Zähler:
				<select name="zaehler">
					<?php
						foreach ($config['zaehler'] as $key => $value) {
   							echo "<option value=" . $key . ">" . $value . "</option>", PHP_EOL;
						};
					?>
				</select>
			</label><br><br>
			<label>Von: 
				<?php 
					$timestamp = time(); 
					$datum = date("Y-m-d", $timestamp) . "T" . date("H:i", $timestamp);
					echo("<input name=\"startdatum\" type=\"datetime-local\" value=$datum>\n"); 
				?>
			</label><br><br>
			<label>Bis: 
				<?php 
					$timestamp = time(); 
					$datum = date("Y-m-d", $timestamp) . "T" . date("H:i", $timestamp);
					echo("<input name=\"enddatum\" type=\"datetime-local\" value=$datum>\n"); 
				?>
			</label><br><br>
			<input type="submit">
		</form>
	</body>
</html>
