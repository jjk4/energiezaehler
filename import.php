<?php 
	$site_name = "Import";
	include ("header.php");

    if(isset($_POST["meter"])){
        $file = file($_FILES['csv']['tmp_name']);
        $firstElement = array_shift($file);
        if (strpos($firstElement, ",") !== false){
            $csvSeparator = ",";
        } else {
            $csvSeparator = ";";
        }
        echo "<h3>Importierte Daten:</h3>";
        foreach ($file as $key => $value) {
            $date = explode($csvSeparator, $value)[0];
            $date = date("Y-m-d H:i:s", strtotime($date));
            $value = explode($csvSeparator, $value)[1];
            echo "Zeit: " . $date . " Wert: " . $value;
            #
            $stmt = $db->prepare("SELECT `name` FROM `meter` WHERE `id` = ?");
            $stmt->bind_param("s", $_POST["meter"]);
            $stmt->execute();
            $meter = $stmt->get_result()->fetch_assoc()["name"];
            #
            $sql = "INSERT INTO `" . $meter . "` (`time`, `value`, `type`) VALUES (\"" . $date . "\", \"" . floatval($value) . "\", \"csv\")";
		    $result = $db->query($sql);
            if(!$result){
                echo " <span style=\"color: red;\">Error</span>";
            }
            echo "<br>";
        }
    }
?>
    <div id="center">
        <h3>Import von Energiesparkonto</h3>
        <form method="post" enctype="multipart/form-data">
            <select name="meter">
				<?php
					$result = $db->query("SELECT `id`, `displayname` FROM `meter`");
					while($row = $result->fetch_assoc()) {
						echo "<option value=" . $row["id"] . ">" . $row['displayname'] . "</option>", PHP_EOL;
					};
				?>
			</select><br>
            <input type="file" name="csv"><br><br><br>
            <input type="submit" value="Importieren" name="submit" class="button">
        </form>
    </div>
<?php include("footer.php");?>