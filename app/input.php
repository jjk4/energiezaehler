		<?php 
			$site_name = "Dateneingabe";
			include ("header.php"); 
		?>
		<form action="submitinput.php">
			<label>Zähler:
				<select name="zaehler">
					<?php
						foreach ($config['zaehler'] as $key => $value) {
   							echo "<option value=" . $key . ">" . $value . "</option>", PHP_EOL;
						};
					?>
				</select>
			</label><br><br>
			<label>Datum:
				<?php 
					$timestamp = time(); 
					$datum = date("Y-m-d", $timestamp); 
					echo("<input name=\"datum\" type=\"date\" value=$datum>\n"); 
				?>
			</label><br><br>
			<label>Uhrzeit:
				<?php 
					$timestamp = time(); 
					$datum = date("H:i", $timestamp); 
					echo("<input name=\"zeit\" type=\"time\" value=$datum>\n"); 
				?>
			</label><br><br>
			<label>Zählerstand:
				<input name="wert" type="number" step="0.1">
			</label><br><br>
			<input type="submit">
		</form>
	</body>
</html>
