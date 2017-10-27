<?php

require("db.inc");

$type = $_GET['type'];
$id = $_GET['id'];
$action = $_GET['action'];

switch ($type) {
    case events:
        if ($_POST[time] == "") {
            $time = null;
        } else {
            $time = $_POST[time];
        }
        $sql = "UPDATE events SET title=:title, date=STR_TO_DATE(:date,'%d-%m-%Y'), time=:time, category=:category, location=:location, description=:description WHERE id=$id";
        $q = $pdo->prepare($sql);
        $q->execute(array(':title' => $_POST[title], ':date' => $_POST[date], ':time' => $time, ':category' => $_POST[category], ':location' => $_POST[location], ':description' => $_POST[description]));
        break;

    case homework:
        $done = isset($_POST[done]) ? 1 : 0;
        $sql = "UPDATE homework SET title=:title, duedate=STR_TO_DATE(:duedate,'%d-%m-%Y'), subject=:subject, description=:description, done=:done WHERE id=$id";
        $q = $pdo->prepare($sql);
        $q->execute(array(':title' => $_POST[title], ':duedate' => $_POST[duedate], ':subject' => $_POST[subject], ':description' => $_POST[description], ':done' => $done));
        break;

    case to_do:
        if ($action === "starred") {
            $sql = "UPDATE to_do
                SET starred = !starred
                WHERE id = :id";
            $q = $pdo->prepare($sql);
            $q->execute(array(':id' => $_GET[id]));
        } else if ($action === "done") {
            $sql = "UPDATE to_do
                SET done = !done
                WHERE id = :id";
            $q = $pdo->prepare($sql);
            $q->execute(array(':id' => $_GET[id]));
        } else {
            $sql = "UPDATE to_do
                SET title=:title, duedate=STR_TO_DATE(:duedate,'%d-%m-%Y'), list=:list, description=:description WHERE id=$id";
            $q = $pdo->prepare($sql);
            $q->execute(array(':title' => $_POST[title], ':duedate' => $_POST[duedate], ':list' => $_POST["list"], ':description' => $_POST[description]));
        }
        break;

    case homeworkDone:
        $sql = "UPDATE homework
            SET done = !done
            WHERE id = :id";
        $q = $pdo->prepare($sql);
        $q->execute(array(':id' => $_GET[id]));
        break;

    case drum_rudiments:
        $sql = "UPDATE drum_rudiments
            SET status = status+1
            WHERE id=:id";
        $q = $pdo->prepare($sql);
        $q->execute(array(':id' => $_GET[id]));
        break;
}

header("location:" . $_SERVER['HTTP_REFERER']);
?>