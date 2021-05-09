		<?php 
			$site_name = "1 Jahr alle Monate - Diagramme";
			include ("header.php"); 
		?>
		<form action="3months_submit.php">
			<label>Jahr1:
				<select name="year1">
					<?php 
						for ($i = 2015; $i <= 2030; $i++) {
						    echo "<option value=" . $i . ">" . $i . "</option>"; 
						}
					?>
				</select>
			</label><br><br>
			<label>Jahr2:
				<select name="year2">
					<?php 
						for ($i = 2015; $i <= 2030; $i++) {
						    echo "<option value=" . $i . ">" . $i . "</option>"; 
						}
					?>
				</select>
			</label><br><br>
			<label>Jahr3:
				<select name="year3">
					<?php 
						for ($i = 2015; $i <= 2030; $i++) {
						    echo "<option value=" . $i . ">" . $i . "</option>"; 
						}
					?>
				</select>
			</label><br><br>
			<label>Zähler:
				<select name="database">
					<?php
						foreach ($config['zaehler'] as $key => $value) {
   							echo "<option value=" . $key . ">" . $value . "</option>", PHP_EOL;
						};
					?>
				</select>
			</label><br><br>
			<input type="submit">
		</form>
