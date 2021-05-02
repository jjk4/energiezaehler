		<?php 
			$site_name = "Dateneingabe";
			include ("header.php"); 
		?>
		<form action="submit.php">
			<label>Zähler:
				<select name="zaehler">
					<option value="pv_garage">PV Garage</option>
					<option value="wasser">Wasser</option>
					<option value="strom">Strom</option>
					<option value="garten">Garten</option>
					<option value="lueftung_heizraum">Lüftung Heizraum</option>
					<option value="display_flur">Display Flur</option>
					<option value="pv_haus">PV Haus</option>
				</select>
			</label><br><br>
			<label>Datum:
				<?php 
					$timestamp = time(); 
					$datum = date("Y-m-d", $timestamp); 
					echo("<input name=\"datum\" type=\"date\" value=$datum>\n"); 
				?>
			</label>
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
