<?php 
	$site_name = "Auswertung - Rohdaten";
	include ("header.php"); 
	if(isset($_POST["meter"])){
		?>
			<div id="center">
			<table>
				<tr>
					<td>Zeitpunkt</td><td>Wert</td><td>Typ</td><td></td>
				</tr>
		<?php
		$startdate = date("Y-m-d H:i:s", strtotime($_POST["startdate"]));
		$enddate = date("Y-m-d H:i:s", strtotime($_POST["enddate"]));
		#
		$stmt = $db->prepare("SELECT `name` FROM `meter` WHERE `id` = ?");
		$stmt->bind_param("s", $_POST["meter"]);
		$stmt->execute();
		#
		$meter = $stmt->get_result()->fetch_assoc()["name"];
		$result = $db->query("SELECT * FROM `" . $meter . "` WHERE `time` <= \"" . $enddate . "\" AND `time` >= \"" . $startdate . "\"");
		while($row = $result->fetch_assoc()) {
			echo "
				<tr>
					<td>
						" . $row["time"] . "
					</td>
					<td>
						" . $row["value"] . "
					</td>
					<td>
						" . $row["type"] . "
					</td>
					<td>
						<a href=\"?m=" . $meter . "&a=delete&t=" . $row["time"] . "\" title=\"Löschen\" id=\"trashicon\"><i class=\"fas fa-trash-alt\"></i></a>
					</td>
				</tr>";
		}
		echo "</table></div>";
		
	} elseif(isset($_GET["a"])){
		switch($_GET["a"]){
			case "delete":
				$sql = "DELETE FROM " . $_GET["m"] . " WHERE `time` = ?";
				$stmt = $db->prepare($sql);
				$stmt->bind_param("s", $_GET["t"]);
				$stmt->execute();
				header("Location: rawdata.php");
				break;
		}
	} else {
?>
	<form method="POST" id="center">
		<label>Zähler:
			<select name="meter">
				<?php
					$result = $db->query("SELECT `id`, `displayname` FROM `meter`");
					while($row = $result->fetch_assoc()) {
						echo "<option value=" . $row["id"] . ">" . $row['displayname'] . "</option>", PHP_EOL;
					};
				?>
			</select>
		</label><br><br>
		<label>Von: 
			<?php 
				$timestamp = time(); 
				$datum = date("Y-m-d", $timestamp) . "T" . date("H:i", $timestamp);
				echo("<input name=\"startdate\" type=\"datetime-local\" value=$datum>\n"); 
			?>
		</label>
		<label>Bis: 
			<?php 
				$timestamp = time(); 
				$datum = date("Y-m-d", $timestamp) . "T" . date("H:i", $timestamp);
				echo("<input name=\"enddate\" type=\"datetime-local\" value=$datum>\n"); 
			?>
		</label><br><br>
		<input type="submit" class="button">
	</form>
<?php }include("footer.php");?>