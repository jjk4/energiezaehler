		<?php 
			$site_name = "3 Jahre monatlicher Vergleich - Diagramme";
			include ("header.php"); 
		?>
		<div class="content" id="center">
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
	   							echo "<option value=" . $key . ">" . $value['displayname'] . "</option>", PHP_EOL;
							};
						?>
					</select>
				</label><br><br>
				<input type="submit">
			</form>
		</div>
	</body>
</html>
