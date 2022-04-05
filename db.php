<?php
    // Konfigurationsdatei laden
    $config = require("config.php");

    // Verbindung zur Datenbank
    $db = new mysqli($config['db']['host'], $config['db']['user'], $config['db']['password'], $config['db']['database']);
    if (isset($db->connect_error)) {
        // Error Zu array hinzufügen
        $messages['error'] .= 'Datenbankverbindung fehlgeschlagen: ' . $db->connect_error . "<br>";
    }

    // Funktion zum Holen der Zähler
    function getZaehler($max=false) {
        global $db;
        $sql = "SELECT * FROM meters";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $zaehler[] = $row;
            }
        } else {
            $zaehler = null;
        }
        // Bei Bedarf Für jeden Zähler Maximum holen
        if($max){
            foreach($zaehler as $key => $value){
                $zaehler[$key]['max'] = getMax($value['id']);
            }
        }

        return $zaehler;
    }
    // FUnktion zum holen eines Zählers
    function getZaehlerById($id) {
        global $db;
        $statement = $db->prepare("SELECT * FROM meters WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();
        $zaehler = $result->fetch_assoc();
        return $zaehler;
    }

    // FUnktion um größten Wert für bestimmten Zähler zu bekommen
    function getMax($zaehler) {
        global $db;
        $statement = $db->prepare("SELECT MAX(value) FROM data WHERE meter_id = ?");
        $statement->bind_param("i", $zaehler);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        $max = $row['MAX(value)'];
        return $max;
    }
?>