<div class="content-mid">
    <h1>Energiezähler - Übersicht</h1>

    <?php
        // Zählerstand aller Zähler anzeigen
        foreach($data["zaehler"] as $zaehler_id => $zaehler) {
            echo "<h3>" . $zaehler["name"] . "</h3>";
            echo "<p>Zählerstand: " . $zaehler["max"] . " " . $zaehler["unit"] . "</p>";
        }
    ?>
</div>
