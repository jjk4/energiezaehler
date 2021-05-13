		<?php 
			$site_name = "Konfigurationsdatei hochladen";
			include ("header.php"); 
		?>
		<div class="content" id="center">
			<span style="color:red;">Achtung! Fehlerhafte Dateien können die Konfiguration beschädigen</span><br><br>
			<form action="submituploadconfig.php" method="post" enctype="multipart/form-data">
				<input accept=".json" type="file" name="fileToUpload" id="fileToUpload" ><br><br>
				<input type="submit" value="Hochladen" name="submit">
			</form>
		</div>
	</body>
</html>
