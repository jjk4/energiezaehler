		<?php 
			$site_name = "Jahre im monatlichen Vergleich - Visualisierung";
			include ("header.php"); 
		?>
		<div class="content" id="center">
			<form action="months_submit.php">
			<input type="hidden" name="number" value="<?php echo $_GET["number"];?>">
			<?php
				for ($i = 1; $i <= $_GET["number"]; $i++) {
					echo "  <label>Jahr" . $i . ":
							<select name=\"year". $i . "\">";
								for ($j = 2015; $j <= 2030; $j++) {
								    echo "<option value=" . $j . ">" . $j . "</option>"; 
								}
								echo"
							</select>
						</label><br><br>"; 
				}
			?>
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
