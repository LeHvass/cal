<?php

require("db.inc");

$type = $_GET['type'];

switch ($type) {
    case birthdays:
        $notify = isset($_POST[notify]) ? 1 : 0;
        $sql = "INSERT INTO birthdays (name, birthdate, notify) VALUES(:name, STR_TO_DATE(:birthdate,'%d-%m-%Y'), :notify)";
        $q = $pdo->prepare($sql);
        $q->execute(array(':name' => $_POST[name], ':birthdate' => $_POST[birthdate], ':notify' => $notify));
        break;
    case events:
        if ($_POST[time] == "") {
            $time = null;
        } else {
            $time = $_POST[time];
        }
        $sql = "INSERT INTO events (date, time, category, location, title, description) VALUES(STR_TO_DATE(:date,'%d-%m-%Y'), :time, :category, :location, :title, :description)";
        $q = $pdo->prepare($sql);
        $q->execute(array(':date' => $_POST[date], ':time' => $time, ':category' => $_POST[category], ':location' => $_POST[location], ':title' => $_POST[title], ':description' => $_POST[description]));
        break;
    case homework:
        $done = isset($_POST[done]) ? 1 : 0;
        $sql = "INSERT INTO homework (duedate, subject, title, description, done) VALUES (STR_TO_DATE(:duedate,'%d-%m-%Y'), :subject, :title, :description, :done)";
        $q = $pdo->prepare($sql);
        $q->execute(array(':duedate' => $_POST[duedate], ':subject' => $_POST[subject], ':title' => $_POST[title], ':description' => $_POST[description], ':done' => $done));
        break;
    case journal:
        $sql = "INSERT INTO journal (date, success, lesson, notes) VALUES (STR_TO_DATE(:date,'%d-%m-%Y'), :success, :lesson, :notes)";
        $q = $pdo->prepare($sql);
        $q->execute(array(':date' => $_POST[date], ':success' => $_POST[success], ':lesson' => $_POST[lesson], ':notes' => $_POST[notes]));
        break;
    case routines:
        $sql = "INSERT INTO routines (duedate, title, frequency) VALUES (:duedate, :title, :frequency)";
        $q = $pdo->prepare($sql);
        $q->execute(array(':duedate' => $_POST[duedate], ':title' => $_POST[title], ':frequency' => $_POST[frequency]));
        break;
    case workouts:
        $sql = "INSERT INTO workouts (date, exercise, sets, weight, notes) VALUES (:date, :exercise, :sets, :weight, :notes)";
        $q = $pdo->prepare($sql);
        $q->execute(array(':date' => $_POST[date], ':exercise' => $_POST[exercise], ':sets' => $_POST[sets], ':weight' => $_POST[weight], ':notes' => $_POST[notes]));
        break;
    case drum_songs:
        $sql = "INSERT INTO drum_songs (artist, title, status, notes) VALUES (:artist, :title, :status, :notes)";
        $q = $pdo->prepare($sql);
        $q->execute(array(':artist' => $_POST[artist], ':title' => $_POST[title], ':status' => $_POST[status], ':notes' => $_POST[notes]));
        break;
    case drum_rudiments:
        $sql = "INSERT INTO drum_rudiments (title, link, status, notes) VALUES (:title, :link, :status, :notes)";
        $q = $pdo->prepare($sql);
        $q->execute(array(':title' => $_POST[title], ':link' => $_POST[link], ':status' => $_POST[status], ':notes' => $_POST[notes]));
        break;
    case to_do:
        if ($_POST[duedate] === "0000-00-00") {
            $_POST[duedate] = null;
        }
        $sql = "INSERT INTO to_do (duedate, list, title, description) VALUES (STR_TO_DATE(:duedate,'%d-%m-%Y'), :list, :title, :description)";
        $q = $pdo->prepare($sql);
        $q->execute(array(':duedate' => $_POST[duedate], ':list' => $_POST['list'], ':title' => $_POST[title], ':description' => $_POST[description]));
        break;
    case pmo:
        $pmo = $pdo->prepare("
                    SELECT date FROM pmo
                    WHERE type='$_POST[type]'
                    ORDER BY id DESC LIMIT 1");
        $pmo->execute();

        $newPMO = new DateTime($_POST[date]);
        while ($row = $pmo->fetch(PDO::FETCH_ASSOC)) {
            $lastPMO = new DateTime($row['date']);
            $difference = $lastPMO->diff($newPMO);
            $interval = $difference->d;
        }

        $sql = "INSERT INTO pmo (date, type, `interval`) VALUES (STR_TO_DATE(:date,'%d-%m-%Y'), :type, :interval)";
        $q = $pdo->prepare($sql);
        $q->execute(array(':date' => $_POST[date], ':type' => $_POST['type'], ':interval' => $interval));
        break;
    default:
        die('Error: Type not valid');
}

header("location:" . $_SERVER['HTTP_REFERER']);
?>