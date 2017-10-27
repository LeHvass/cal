<?php

include("db.inc");

$type = $_GET['type'];
$id = $_GET['id'];

$sql = "DELETE FROM $type WHERE id='$id'";
$q = $pdo->prepare($sql);
$q->execute();

header("location:" . $_SERVER['HTTP_REFERER']);
?>
