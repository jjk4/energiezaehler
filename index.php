<?php
    // Array für Meldungen
    $messages = array();
    $messages["error"] = "";
    $messages["warning"] = "";
    $messages["success"] = "";

    // Funktionen für die Datenbank
    include_once 'db.php';

    // Aktuelles Datum und Uhrzeit in Variablen speichern
    $datetime = date("Y-m-d") . "T" . date("H:i");

    // Prüfen, welche Seite aufgerufen werden soll
    switch($_GET["a"]){
        case "input":
            // -------------------------------------------------- Dateneingabe --------------------------------------------------
            // Daten in DB eintragen, falls es welche gibt
            if(isset($_POST["meter_id"])){
                // Vorher noch prüfen, ob der Wert gültig ist
                if($_POST["value"] >= getMax($_POST["meter_id"])){
                    $statement = $db->prepare("INSERT INTO data (meter_id, time, value) VALUES (?, ?, ?)");
                    $statement->bind_param("isd", $_POST["meter_id"], $_POST["time"], $_POST["value"]);
                    $statement->execute();
                    $messages["success"] = "Daten erfolgreich eingetragen!";
                } else {
                    $messages["error"] = "Der eingegebene Wert darf nicht niedriger sein, als der aktuelle Zählerstand!";
                }
                
            }
            render("default", "input", 
                array(  "title" => "Dateneingabe", 
                        "messages" => $messages,
                        "datetime" => $datetime,
                        "zaehler" => getZaehler()
                    ));
            break;
        default:
            render("default", "index", 
                array(   "title" => "Startseite",
                         "messages" => $messages,
                         "zaehler" => getZaehler(true)
                    ));
            break;
    }
    // Seite rendern
    function render($template, $page, $data = array()) {
        ob_start();
        include("pages/" . $page . ".php");
        $content = ob_get_clean();
        include("templates/" . $template . ".php");
    }
?>