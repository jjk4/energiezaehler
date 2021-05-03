		<?php 
			$site_name = "Vergleich - Auswertung";
			include ("header.php"); 
		?>
		<form action="submitcomparison.php">
			<label>Vergleiche:
				<select id="selection1">
					<option value="day">Tag</option>
					<option value="week">Woche</option>
					<option value="month">Monat</option>
					<option value="year">Jahr</option>
				</select><br>
				<button id="ok1">Weiter</button>
			</label><br><br>
			<label id=selection2>Mit:<br>
				<select id="selection2_day">
					<option value="day_before">Vortag</option>
					<option value="day_last_year">Tag letztes Jahr</option>
				</select><br>
				<select id="selection2_week">
					<option value="week_before">Vorwoche</option>
				</select><br>
				<select id="selection2_month">
					<option value="month_before">Vormonat</option>
					<option value="month_last_year">Monat letztes Jahr</option>
				</select><br>
				<select id="selection2_year">
					<option value="year_before">Vorjahr</option>
				</select><br>
				<button id="okday">Weiter</button>
			</label><br>
			<label id=selection3>Auswahl:<br>
				<input id="selection3_day" type="date"><br>
				<select id="selection3_week">
					<?php
						for ($i = 2015; $i <= 2030; $i++) {
							for ($j = 1; $j <= 52; $j++) {
								echo "<option id=\"" . $i . "-" . $j . "\">" . $i . "KW " . $j . "</option>";
							}
						}
					?>
				</select><br>
				<select id="selection3_month">
					<?php
						for ($i = 2015; $i <= 2030; $i++) {
							for ($j = 1; $j <= 12; $j++) {
								echo "<option id=\"" . $i . "-" . $j . "\">" . $j . "_" . $i . "</option>";
							}
						}
					?>
				</select><br>
				<select id="selection3_year">
					<?php
						for ($i = 2015; $i <= 2030; $i++) {
							echo "<option id=\"" . $i . "\">" . $i . "</option>";
						}
					?>
				</select><br>
				<button id="finish">Fertig</button>
			</label>
			
		</form>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="comparison.js"></script>
	</body>
</html>
