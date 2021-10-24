<?php 
	$site_name = "Einstellungen";
	require ("header.php");
	if(isset($_GET["a"])){
		$action = $_GET["a"];
	} else{
		$action = "main";
	}
	switch($action){
		case "main":# --------------------------------------- Startbildschirm ---------------------------------------
			$result = $db->query("SELECT * FROM `meter`");
			?>
				<h3>Zählereinstellungen</h3>
				<table>
					<tr>
						<td>Technischer Name</td><td>Anzeigename</td><td>Einheit</td><td>Art</td><td></td>
					</tr>
					<?php
						while($row = $result->fetch_assoc()) {
							switch($row["type"]){
								case "manual":
									$type = "Manuelle Eingabe";
									break;
							}
							echo "
								<tr>
									<td>
										" . $row["name"] . "
									</td>
									<td>
										" . $row["displayname"] . "
									</td>
									<td>
										" . $row["unit"] . "
									</td>
									<td>
										" . $type . "
									</td>
									<td>
										<a href=\"?a=edit&m=" . $row["id"] . "\" title=\"Bearbeiten\" id=\"editicon\"><i class=\"fas fa-edit\"></i></a>
										<a href=\"?a=delete&m=" . $row["id"] . "\" title=\"Löschen\" id=\"trashicon\"><i class=\"fas fa-trash-alt\"></i></a>
									</td>
								</tr>";
						}

					?>
				</table><br><br>
				<a class="button" href="?a=add">Zähler hinzufügen</a>
			<?php
			break;
		case "add":# --------------------------------------- Hinzufügen ---------------------------------------
			if(isset($_POST["name"])){
				if(ctype_alpha($_POST["name"]) and $_POST["name"] != "meter"){
					$stmt = $db->prepare("INSERT INTO `meter` (`name`, `displayname`, `unit`) VALUES (?, ?, ?)");
					$stmt->bind_param("sss", $_POST["name"], $_POST["displayname"], $_POST["unit"]);
					$stmt->execute();
					$db->query("CREATE TABLE `" . $_POST["name"] . "` ( `time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `value` FLOAT NOT NULL , `type` VARCHAR(255) NOT NULL , PRIMARY KEY (`time`)) ENGINE = InnoDB;");
					header("Location: configuration.php");
				} else {
					echo "Fehler";
				}

			} else {
				?>
					<h3>Zähler hinzufügen</h3>
					<script>
						var check1 = false;
						var check2 = false;
						var check3 = false;
						function checkNameField(value){
							if(value == "" || !/^[a-zA-Z]+$/.test(value)){
								$("#NamefieldCheck").html("<i class=\"fas fa-times\"></i>");
								check1 = false;
							} else {
								$("#NamefieldCheck").html("<i class=\"fas fa-check\"></i>");
								check1 = true;
							}
							CheckEverything();
						}
						function checkDisplayNameField(value){
							if(value == ""){
								$("#DisplayNamefieldCheck").html("<i class=\"fas fa-times\"></i>");
								check2 = false;
							} else {
								$("#DisplayNamefieldCheck").html("<i class=\"fas fa-check\"></i>");
								check2 = true;
							}
							CheckEverything();
						}
						function checkUnitField(value){
							if(value == ""){
								$("#UnitfieldCheck").html("<i class=\"fas fa-times\"></i>");
								check3 = false;
							} else {
								$("#UnitfieldCheck").html("<i class=\"fas fa-check\"></i>");
								check3 = true;
							}
							CheckEverything();
						}
						function CheckEverything(){
							if(check1 == true && check2 == true && check3 == true){
								document.getElementById("submit").disabled = false;
							} else {
								document.getElementById("submit").disabled = true;
							}
						}
					</script>
					<form method="POST" autocomplete="off">
						<table>
							<tr>
								<td>Technischer Name (nur Buchstaben):</td>
								<td><input type="text" name="name" onchange="checkNameField(this.value)"> <span id="NamefieldCheck"></span></td>
							</tr>
							<tr>
								<td>Anzeigename: </td>
								<td><input type="text" name="displayname" onchange="checkDisplayNameField(this.value)"> <span id="DisplayNamefieldCheck"></span></td>
							</tr>
							<tr>
								<td>Einheit: </td>
								<td><input type="text" name="unit" onchange="checkUnitField(this.value)"> <span id="UnitfieldCheck"></span></td>
							</tr>
							
						</table><br>
						<input type="submit" id="submit" class="button" disabled>
						<a class="button red" href="configuration.php">Abbrechen</a>
					</form>
					
				<?php
			}

			break;
		case "delete":# --------------------------------------- Löschen ---------------------------------------
			if(!isset($_GET["m"])){
				header("Location: configuration.php");
				exit;
			}
			if(isset($_GET["s"])){
				$stmt = $db->prepare("SELECT `name` FROM `meter` WHERE `id` = ?");
				$stmt->bind_param("s", $_GET["m"]);
				$stmt->execute();
				$metername = $stmt->get_result()->fetch_assoc()["name"];
				$stmt = $db->prepare("DELETE FROM `meter` WHERE `id` = ?");
				$stmt->bind_param("s", $_GET["m"]);
				$stmt->execute();
				$db->query("DROP TABLE `" . $metername . "`");

				echo "Zähler gelöscht!";
				header("Location: configuration.php");
				exit;
			}
			?>
				<h3>Zähler löschen</h3>				
				Bist du dir ganz sicher, dass du den Zähler Löschen willst? Es werden der Zähler und die Messdaten gelöscht!<br><br>
				<a class="button red" href="?a=delete&m=<?php echo $_GET["m"];?>&s=1">Ja, ich bin mir sicher!</a><br><br><br>
				<a class="button" href="configuration.php">Nein, lieber nicht!</a>
			<?php
			break;
		case "edit":# --------------------------------------- Bearbeiten ---------------------------------------
			if(!isset($_GET["m"])){
				header("Location: configuration.php");
				exit;
			}
			if(isset($_POST["displayname"])){
				$stmt = $db->prepare("UPDATE `meter` SET `displayname` = ?, `unit` = ? WHERE `meter`.`id` = ?");
				$stmt->bind_param("sss", $_POST["displayname"], $_POST["unit"], $_GET["m"]);
				$stmt->execute();
				header("Location: configuration.php");
			} else {
				$stmt = $db->prepare("SELECT * FROM `meter` WHERE `id` = ?");
				$stmt->bind_param("s", $_GET["m"]);
				$stmt->execute();
				$row = $stmt->get_result()->fetch_assoc();
				?>
				<h3>Zähler bearbeiten</h3>
				<script>
					var check2 = false;
					var check3 = false;
					function checkDisplayNameField(value){
						if(value == ""){
							$("#DisplayNamefieldCheck").html("<i class=\"fas fa-times\"></i>");
							check2 = false;
						} else {
							$("#DisplayNamefieldCheck").html("<i class=\"fas fa-check\"></i>");
							check2 = true;
						}
						CheckEverything();
					}
					function checkUnitField(value){
						if(value == ""){
							$("#UnitfieldCheck").html("<i class=\"fas fa-times\"></i>");
							check3 = false;
						} else {
							$("#UnitfieldCheck").html("<i class=\"fas fa-check\"></i>");
							check3 = true;
						}
						CheckEverything();
					}
					function CheckEverything(){
						if(check2 == true && check3 == true){
							document.getElementById("submit").disabled = false;
						} else {
							document.getElementById("submit").disabled = true;
						}
					}
				</script>
				<form method="POST" autocomplete="off">
						<table>
							<tr>
								<td>Technischer Name (nur Buchstaben):</td>
								<td><input type="text" name="name" onchange="checkNameField(this.value)" value="<?php echo $row["name"];?>" disabled><span id="NamefieldCheck"><i class="fas fa-check"></i></span></td>
							</tr>
							<tr>
								<td>Anzeigename: </td>
								<td><input type="text" name="displayname" onchange="checkDisplayNameField(this.value)" value="<?php echo $row["displayname"];?>"> <span id="DisplayNamefieldCheck"></span></td>
							</tr>
							<tr>
								<td>Einheit: </td>
								<td><input type="text" name="unit" onchange="checkUnitField(this.value)" value="<?php echo $row["unit"];?>"> <span id="UnitfieldCheck"></span></td>
							</tr>
							
						</table><br>
					<input type="submit" id="submit" class="button"> 
					<a class="button red" href="configuration.php">Abbrechen</a>
				</form>
				<script>checkDisplayNameField(); checkUnitField()</script>
			<?php
			}
			break;
		default:# --------------------------------------- . ---------------------------------------
			header("Location: ?a=main");
			exit;
	}
?>

<?php