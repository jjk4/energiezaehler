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
        case "settings":
            // -------------------------------------------------- Einstellungen --------------------------------------------------
            switch($_GET["s"]){
                case "add":
                    // Zähler hinzufügen
                    if(isset($_POST["name"])){
                        $statement = $db->prepare("INSERT INTO meters (name, unit) VALUES (?, ?)");
                        $statement->bind_param("ss", $_POST["name"], $_POST["unit"]);
                        $statement->execute();
                        $messages["success"] .= "Zähler erfolgreich hinzugefügt!";
                    }
                    render("default", "meter_add", 
                        array("title" => "Zähler hinzufügen", 
                            "messages" => $messages,
                        ));
                    break;
                case "delete": 
                    // Bestätigung
                    if(isset($_POST["id"])){
                        $statement = $db->prepare("DELETE FROM meters WHERE id = ?");
                        $statement->bind_param("i", $_POST["id"]);
                        $statement->execute();
                        $messages["success"] .= "Zähler erfolgreich gelöscht!";
                        render("default", "backtosettings", 
                            array("title" => "Zähler gelöscht", 
                                "messages" => $messages,
                            ));
                    } else {
                        render("default", "meter_delete", 
                            array("title" => "Zähler löschen", 
                                "messages" => $messages,
                                "zaehler" => getZaehlerById($_GET["id"])
                            ));
                    }
                    break;
                case "edit":
                    // Zähler bearbeiten
                    if(isset($_POST["id"])){
                        $statement = $db->prepare("UPDATE meters SET name = ?, unit = ? WHERE id = ?");
                        $statement->bind_param("ssi", $_POST["name"], $_POST["unit"], $_POST["id"]);
                        $statement->execute();
                        $messages["success"] .= "Zähler erfolgreich bearbeitet!";
                        render("default", "backtosettings", 
                            array("title" => "Zähler bearbeitet", 
                                "messages" => $messages,
                            ));
                    } else {
                        render("default", "meter_edit", 
                            array("title" => "Zähler bearbeiten", 
                                "messages" => $messages,
                                "zaehler" => getZaehlerById($_GET["id"])
                            ));
                    }
                    break;

                default:
                    render("default", "settings", 
                        array(  "title" => "Einstellungen", 
                                "messages" => $messages,
                                "zaehler" => getZaehler(true),
                            ));
                    break;
            }
            
            break;
        case "output_rawdata":
            // -------------------------------------------------- Rohdaten anzeigen --------------------------------------------------
            // Wenn Formular gesendet wurde, dann Daten aus DB holen
            if(isset($_POST["id"])){
                $daten = getZaehlerByTime($_POST["id"], $_POST["start"], $_POST["end"]);
                $starttime = $_POST["start"];
                $endtime = $_POST["end"];
            } else {
                $daten = null;
                $starttime = $datetime;
                $endtime = $datetime;
            }
            render("default", "output_rawdata", 
                array(  "title" => "Rohdaten", 
                        "messages" => $messages,
                        "daten" => $daten,
                        "starttime" => $starttime,
                        "endtime" => $endtime,
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