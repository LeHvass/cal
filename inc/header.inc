<?php

header('Content-type: text/html; charset=utf-8');

include("inc/db/db.inc");

if (!isset($_COOKIE['Cal'])) {
    header("location:/login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
}

if (isset($_GET['content'])) {
    $content = $_GET['content'];
} else {
    $content = "index";
}

function echoActiveClassIfRequestMatches($requestUri) {
    global $content;
    if (strpos($content, $requestUri) !== false) {
        echo 'class="active dropdown"';
    }
}

setlocale(LC_TIME, 'da_DK.utf8');

switch ($content) {
    case index:
        $title = "Forside";
        break;
    case calendar:
        $title = "Kalender";
        break;
    case homework:
        $title = "Lektier";
        break;
    case journal:
        $title = "Logbog";
        break;
    case music:
        $title = "Musik";
        break;
    case "to-do":
        $title = "To-Do";
        break;
    case training:
        $title = "Træning";
        break;
    case "404":
        $title = "Side ikke fundet";
        break;
    case "training/measures":
        $title = "Træning - Kropsmål";
        break;
    case "training/stats":
        $title = "Træning - Statistik";
        break;
    case "training/workouts":
        $title = "Træning - Træningspas";
        break;
    case "music/drums":
        $title = "Musik - Trommer";
        break;
    case "music/guitar":
        $title = "Musik - Guitar";
        break;
    case "music/piano":
        $title = "Musik - Klaver";
        break;
    case "calendar/routines":
        $title = "Kalender - Rutiner";
        break;
    case test:
        $title = "Test";
        break;
    default:
        $title = "Forside";
        break;
}
?>