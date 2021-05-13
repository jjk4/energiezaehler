		<?php 
			$site_name = "Konfigurationsdatei hochladen";
			include ("header.php"); 
			exec("rm uploads/*");
			//Datei Upload
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			if ($_FILES["fileToUpload"]["size"] > 500000) {
			  echo "Sorry, your file is too large.";
			  $uploadOk = 0;
			}

			if($FileType != "json") {
			  echo "Achtung! Die Datei muss eine .json Datei sein!";
			  $uploadOk = 0;
			}

			if ($uploadOk == 0) {
			  echo "";
			} else {
			  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			    exec("mv config.json config.json.old");
			    exec("cp uploads/*.json config.json");
			    echo "Die Konfigurationsdatei ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " wurde hochgeladen. Du wirst jetzt weitergeleitet";
			    sleep(3);
			    header("refresh:3;url=configuration.php");
			  } else {
			    echo "Es gab einen Fehler beim Hochladen der Datei";
			  }
			}
		?>
	</body>
</html>
