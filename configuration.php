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
				<h3>Energiezählereinstellungen</h3>
				<label>Installationspfad
					<input name="installationpath" type="text" placeholder="Installationspfad" value="<?php echo($config['installationpath']);?>">
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
							$type = $value['type'];
							$sdm630_usb = $value['sdm630_usb'];
							$sdm630_id = $value['sdm630_id'];
							$sdm630_counter = $value['sdm630_counter'];
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
										<select name=\"" . $key . "_type\" id=\"" . $key . "_type\">
											<option value=\"manual\""; if ($type == "manual") {echo(" selected ");}; echo ">Manuelle Eingabe</option>
											<option value=\"sdm630\""; if ($type == "sdm630") {echo(" selected ");}; echo ">SDM630 Modbus</option>
										</select>
										<div class=\"" . $key . "_sdm630\">
											<label>USB Schnittstelle<br>
												<input name=\"" . $key . "_sdm630_usb\" type=\"text\" value=\"$sdm630_usb\">
											</label><br>
											<label>Modbus ID<br>
												<input name=\"" . $key . "_sdm630_id\" type=\"number\" value=\"$sdm630_id\">
											</label><br>
											<label>Zähler<br>
												<select name=\"" . $key . "_sdm630_counter\">
													<option value=\"l1\""; if ($sdm630_counter == "l1") {echo(" selected ");}; echo ">L1</option>
													<option value=\"l2\""; if ($sdm630_counter == "l2") {echo(" selected ");}; echo ">L2</option>
													<option value=\"l3\""; if ($sdm630_counter == "l3") {echo(" selected ");}; echo ">L3</option>
													<option value=\"all\""; if ($sdm630_counter == "all") {echo(" selected ");}; echo ">Gesamt</option>
												</select>
											</label><br>
											
										</div>
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
		};
		$( document ).ready(function() {
		<?php
		   foreach ($config['zaehler'] as $key => $value) {
		  		echo "
				   if (document.getElementById('" . $key . "_type').value == 'sdm630'){
				   	$(\"." . $key . "_sdm630\").show();
				   } else if (this.value == 'manual'){
				   	$(\"." . $key . "_sdm630\").hide();
				   }";
			}
		?>
		});
		  <?php 
		  	foreach ($config['zaehler'] as $key => $value) {
		  		echo "$(\"." . $key . "_sdm630\").hide();
		  		let sel_" . $key . " = document.getElementById('" . $key . "_type');
					sel_" . $key . ".addEventListener ('change', function () {
					   if (this.value == 'sdm630'){
					   	$(\"." . $key . "_sdm630\").show();
					   } else if (this.value == 'manual'){
					   	$(\"." . $key . "_sdm630\").hide();
					   }
					});";
			}
		?>
		</script>
	</body>
</html>
