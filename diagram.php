		<?php 
			$site_name = "Auswertung - Rohdaten";
			include ("header.php"); 
		?>
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
			<label>
				<select name="month">
				<?php
				for ($i = 2015; $i <= 2030; $i++) {
  					echo "<option value=01-$i>Januar $i</option>";
  					echo "<option value=02-$i>Februar $i</option>";
  					echo "<option value=03-$i>März $i</option>";
  					echo "<option value=04-$i>April $i</option>";
  					echo "<option value=05-$i>Mai $i</option>";
  					echo "<option value=06-$i>Juni $i</option>";
  					echo "<option value=07-$i>Juli $i</option>";
  					echo "<option value=08-$i>August $i</option>";
  					echo "<option value=09-$i>September $i</option>";
  					echo "<option value=10-$i>Oktober $i</option>";
  					echo "<option value=11-$i>November $i</option>";
  					echo "<option value=12-$i>Dezember $i</option>";
				}
				?>
				</select>
			</label><br><br>
			<input type="submit">
		</form>
	</body>
</html>
