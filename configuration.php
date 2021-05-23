		<?php 
			$site_name = "Einstellungen";
			include ("header.php"); 
			$timestamp = time(); 
			$datum = date("Y-m-d", $timestamp) . "_" . date("H:i", $timestamp);
			exec("rm downloads/*");
			exec("cp config.json downloads/config-" . $datum . ".json");
		?>
		<div style="text-align:right; float:right;">
			<a href="<?php echo("downloads/config-" . $datum . ".json");?>" download><button type="button">Konfigurationsdatei herunterladen</button></a><br><br>
			<button onclick="location.href='uploadconfig.php'" type="button">Konfigurationsdatei hochladen</button><br><br>
		</div>
		<div class="content">
			<form action="submitconfiguration.php">
				<h3>Datenbankeinstellungen</h3>
				<label>Hostname/IP Adresse
					<input name="host" type="text" placeholder="Host" value="<?php echo($config['host']);?>">
				</label><br><br>
				<label>Port
					<input name="port" type="number" placeholder="Port" value="<?php echo($config['port']);?>">
				</label><br><br>
				<label>Datenbank
					<input name="database" type="text" placeholder="Datenbank" value="<?php echo($config['database']);?>">
				</label><br><br>
				<h3>Zählereinstellungen</h3>
				<table border="1">
					<tr>
						<td>Technischer Name</td><td>Anzeigename</td><td>Einheit</td><td>Art</td><td><span style="color:red;">Löschen?</span></td>
					</tr>
					<?php
						foreach ($config['zaehler'] as $key => $value) {
							$displayname = $value['displayname'];
							$unit = $value['unit'];
							echo "
								<tr>
									<td>
										<b>$key</b>
									</td>
									<td>
										<input name=\"" . $key . "_displayname\" type=\"text\" value=\"$displayname\"> 
									</td>
									<td>
										<input name=\"" . $key . "_unit\" type=\"text\" value=\"$unit\">
									</td>
									<td>
										<select name=\"" . $key . "_type\">
											<option value=\"manual\">Manuelle Eingabe</option>
										</select>
									</td>
									<td>
										<input type=\"checkbox\"name=\"" . $key . "_delete\">
									</td>
								</tr>", PHP_EOL;
							$displayname = "";
							$unit = "";
						};
					?>
				</table>
				<button onclick="addCounter()" id="add" type="button">+</button><br><br>
				<label id="neu" style="display: none;"><b>neu</b> <br>technischer Name: <input name="neu_name" type="text" value=""> Anzeigename: <input name="neu_displayname" type="text" value=""> Einheit:<input name="neu_unit" type="text" value=""></label><br><br><br>
				<input type="submit">
			</form>
			
		</div>
		<script>
		function addCounter() {
		  document.getElementById("neu").style.display = 'block';
		  document.getElementById("add").style.display = 'none';
		}
		</script>
	</body>
</html>
