<?php

function CreateForm($action) {
    if ($action == "edit") {
        require("../../inc/db/db.inc");

        $type = $_GET['type'];

        $id = $_GET['id'];

        $data = $pdo->prepare("SELECT * FROM $type WHERE id = $id");
        $data->execute();
        $dataQ = $data->fetch(PDO::FETCH_ASSOC);
    }
    echo $dataQ["id"];
}

CreateForm("edit")
?>
