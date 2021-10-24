<?php
    $config = require("config.php");
    $db = new mysqli($config["database"]["host"], $config["database"]["username"], $config["database"]["password"], $config["database"]["dbname"]);
    if ($db->connect_error) {
        die("Database Error: " . $db->connect_error);
    }
    $maxdays = array(
        "01" => "31",
        "02" => "28",
        "03" => "31",
        "04" => "30",
        "05" => "31",
        "06" => "30",
        "07" => "31",
        "08" => "31",
        "09" => "30",
        "10" => "31",
        "11" => "30",
        "12" => "31"
    );
    switch($_GET["v"]){
        case "month":
            #
            $stmt = $db->prepare("SELECT `name` FROM `meter` WHERE `id` = ?");
            $stmt->bind_param("s", $_GET["m"]);
            $stmt->execute();
            $metername = $stmt->get_result()->fetch_assoc()["name"];
            #
            $date = $_GET["d"];
            $month = explode("-", $date)[1];
            $year = explode("-", $date)[1];
            $starttime = $date . "-01 00:00:00";
            $endtime = $date . "-" . $maxdays[$month] . " 23:59:59";
            # Last
            $stmt = $db->prepare("SELECT * FROM `" . $metername . "` WHERE `time` >= ? AND `time` <= ? ORDER BY `time` ASC LIMIT 1");
            $stmt->bind_param("ss", $starttime, $endtime);
            $stmt->execute();
            $first = $stmt->get_result()->fetch_assoc()["value"];
            # First
            $stmt = $db->prepare("SELECT * FROM `" . $metername . "` WHERE `time` >= ? AND `time` <= ? ORDER BY `time` DESC LIMIT 1");
            $stmt->bind_param("ss", $starttime, $endtime);
            $stmt->execute();
            $last = $stmt->get_result()->fetch_assoc()["value"];
            # Last Last
            $stmt = $db->prepare("SELECT * FROM `" . $metername . "` WHERE `time` >= ? AND `time` <= ? ORDER BY `time` DESC LIMIT 1");
            $stmt->bind_param("ss", date("Y-m-d H:i:s", strtotime($starttime . " - 1 month")), date("Y-m-d H:i:s", strtotime($endtime . " - 1 month")));
            $stmt->execute();
            $lastlast = $stmt->get_result()->fetch_assoc()["value"];
            # first next
            $stmt = $db->prepare("SELECT * FROM `" . $metername . "` WHERE `time` >= ? AND `time` <= ? ORDER BY `time` ASC LIMIT 1");
            $stmt->bind_param("ss", date("Y-m-d H:i:s", strtotime($starttime . " + 1 month")), date("Y-m-d H:i:s", strtotime($endtime . " + 1 month")));
            $stmt->execute();
            $firstnext = $stmt->get_result()->fetch_assoc()["value"];
            # Durchschnitt
            $avgstart = (floatval($first)+floatval($lastlast))/2;
            $avgend = (floatval($last)+floatval($firstnext))/2;
            $energy = $avgend-$avgstart;
            echo $energy;
            break;
    }
?>