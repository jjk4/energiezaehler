<?php 
	$site_name = "Dateneingabe";
	include ("header.php");
?>
<?php
	if(isset($_POST["meter"])){
		$datetime = date("Y-m-d H:i:s", strtotime($_POST["date"]));
		$value = $_POST["value"];
		#
		$stmt = $db->prepare("SELECT `name` FROM `meter` WHERE `id` = ?");
		$stmt->bind_param("s", $_POST["meter"]);
		$stmt->execute();
		$meter = $stmt->get_result()->fetch_assoc()["name"];
		#
		$sql = "INSERT INTO `" . $meter . "` (`time`, `value`, `type`) VALUES (\"" . $datetime . "\", \"" . $value . "\", \"manual\")";
		$result = $db->query($sql);
		if($result){
			echo "<div id=okay>&#9989;</div>";
		} else {
			echo "<div id=okay>&#10060;</div>";
		}
		if(isset($_GET["m"])){
			header("refresh:3;url=input.php?m=" . strval(intval($_GET["m"])+1));
		} else {
			header("refresh:3;url=input.php?m=1");
		}
	} else {
		?>
<div id="center">
	<form method="post">
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
		<label>Zeit: 
			<?php 
				$timestamp = time(); 
				$datum = date("Y-m-d", $timestamp) . "T" . date("H:i", $timestamp);
				echo("<input name=\"date\" type=\"datetime-local\" value=$datum>\n"); 
			?>
		</label><br><br>
		<label>Zählerstand:
			<input name="value" type="number" step="0.1" required>
		</label><br><br>
		<input type="submit" class="button">
	</form>
</div>
<?php if(isset($_GET["m"])){
	?>
	<script>
		$("option:eq(<?php echo $_GET["m"];?>)").attr('selected','selected');
	</script>
<?php
}
?>


<?php } include("footer.php");?>