		<?php 
			$site_name = "1 Jahr alle Monate - Diagramme";
			include ("header.php"); 
		?>
		<form action="months1year_submit.php">
			<label>Zähler:
				<select name="database">
					<?php
						foreach ($config['zaehler'] as $key => $value) {
   							echo "<option value=" . $key . ">" . $value . "</option>", PHP_EOL;
						};
					?>
				</select>
			</label><br><br>
			<label>Jahr:
				<select name="year">
					<?php 
						for ($i = 2015; $i <= 2030; $i++) {
						    echo "<option value=" . $i . ">" . $i . "</option>"; 
						}
					?>
				</select>
			</label><br><br>
			<input type="submit">
		</form>
