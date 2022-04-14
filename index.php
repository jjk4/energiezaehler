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

    // Farben für Diagramme
    $colors = array(
        0 => ["rgba(255, 0, 0, 1)", "rgba(255, 0, 0, 0.4)"],
        1 => ["rgba(0, 255, 0, 1)", "rgba(0, 255, 0, 0.4)"],
        2 => ["rgba(0, 0, 255, 1)", "rgba(0, 0, 255, 0.4)"],
        3 => ["rgba(255, 255, 0, 1)", "rgba(255, 255, 0, 0.4)"],
        4 => ["rgba(255, 0, 255, 1)", "rgba(255, 0, 255, 0.4)"],
        5 => ["rgba(0, 255, 255, 1)", "rgba(0, 255, 255, 0.4)"],
        6 => ["rgba(255, 128, 0, 1)", "rgba(255, 128, 0, 0.4)"],
        7 => ["rgba(128, 255, 0, 1)", "rgba(128, 255, 0, 0.4)"],
        8 => ["rgba(0, 255, 128, 1)", "rgba(0, 255, 128, 0.4)"],
        9 => ["rgba(255, 0, 128, 1)", "rgba(255, 0, 128, 0.4)"],
        10 => ["rgba(128, 0, 255, 1)", "rgba(128, 0, 255, 0.4)"],
        11 => ["rgba(0, 128, 255, 1)", "rgba(0, 128, 255, 0.4)"],

    );
    // Maximale Anzahl an Tage für Monate
    $maxdays = array(
        "01" => 31,
        "02" => 28,
        "03" => 31,
        "04" => 30,
        "05" => 31,
        "06" => 30,
        "07" => 31,
        "08" => 31,
        "09" => 30,
        "10" => 31,
        "11" => 30,
        "12" => 31
    );

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
        case "output_visu":
            // -------------------------------------------------- Visualisierung --------------------------------------------------
            $years = array();
            for($i = 0; $i < 10; $i++){
                 $years[] = date("Y") - $i;
            }
            render("default", "output_visu", 
                array(  "title" => "Visualisierung", 
                        "messages" => $messages,
                        "daten" => $daten,
                        "years" => $years,
                        "zaehler" => getZaehler()
                    ));
            break;
        case "output_chart_monthly":
            // -------------------------------------------------- Graph für montatliche Ansicht --------------------------------------------------
            $years = explode(",", $_GET["y"]);
            $zaehler_id = $_GET["z"];
            $data = array();
            foreach($years as $year){
                $data[$year] = array();
                foreach($maxdays as $month=>$days){
                    // Erster Wert des Monats ermitteln
                    $first = getMinByTime($zaehler_id, $year."-".$month."-01 00:00:00", $year."-".$month."-" . $days . " 23:59:59");
                    $last = getMaxByTime($zaehler_id, $year."-".$month."-01 00:00:00", $year."-".$month."-" . $days . " 23:59:59");
                    $data[$year][] = $last-$first;
                }
            }
            render("empty", "chart_monthly", 
                array(  "title" => "Graph", 
                        "data" => $data,
                        "colors" => $colors,
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