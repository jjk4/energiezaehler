		<?php 
			$site_name = "Dateneingabe";
			include ("header.php"); 
		?>
		<div class="content" id="center">
			<form action="submitinput.php">
				<label>Zähler:
					<select name="zaehler">
						<?php
							foreach ($config['zaehler'] as $key => $value) {
	   							echo "<option value=" . $key . ">" . $value['displayname'] . "</option>", PHP_EOL;
							};
						?>
					</select>
				</label><br><br>
				<label>Zeit: 
					<?php 
						$timestamp = time(); 
						$datum = date("Y-m-d", $timestamp) . "T" . date("H:i", $timestamp);
						echo("<input name=\"datum\" type=\"datetime-local\" value=$datum>\n"); 
					?>
				</label><br><br>
				<label>Zählerstand:
					<input name="wert" type="number" step="0.1">
				</label><br><br>
				<input type="submit">
			</form>
		</div>
	</body>
</html>
