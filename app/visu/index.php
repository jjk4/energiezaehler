		<?php 
			$site_name = "Visualisierung";
			include ("header.php"); 
		?>
		<div class="content" id="center">
			Bitte Visualisierung auswählen:<br><hr>
			<div class="visutype">
				<b>Jahre im monatlichen Vergleich</b>
				<form action="months.php">
					<label>Anzahl der Jahre:
						<input type="number" name="number">
					</label><br>
					<input type="submit">
				</form>
			</div><hr>
			<div class="visutype">
				<b>Jahre im Gesamtvergleich</b>
				<form action="years.php">
					<label>Anzahl der Jahre:
						<input type="number" name="number">
					</label><br>
					<input type="submit">
				</form>
			</div>
		</div>
	</body>
</html>
