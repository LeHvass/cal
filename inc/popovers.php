<?php

function popover($type, $use, $id) {
    require("../../inc/db/db.inc");

    $type = $_GET['type'];

    $id = $_GET['id'];

    $data = $pdo->prepare("SELECT * FROM $type WHERE id = $id");
    $data->execute();
    $dataQ = $data->fetch(PDO::FETCH_ASSOC);
    echo $dataQ["id"];
// Switch to determine color of label
    switch ($type) {
        case homework:
            $label = "label-info";
            break;
        case events:
            $label = "label-success";
            break;
        case "to-do":
            $label = "label";
            break;
        case "birthday":
            $label = "label-danger";
            break;
        default:
            $label = "Forside";
            break;
    }

    echo "<div class='label $label' data-title='$done2 $row[title] $editHomework $deleteLink' data-content='";
    include("inc/homeworkPopover.php");
    echo "'>$done1 &nbsp;$row[subject]</div>";
}
?>

<?php
$row['duedate2'] = strftime("%A, d. %e. %b %Y", strtotime($row[duedate]));
?>

<dl class="dl-horizontal">
    <dt><i class="fa fa-calendar fa-fw"></i></dt>
    <dd><?php echo $row['duedate2'] ?></dd>
    <dt><i class="fa fa-folder-open fa-fw"></i></dt>
    <dd><?php echo $row['subject'] ?></dd>
    <dt><i class="fa fa-comment fa-fw"></i></dt>
    <dd><?php echo htmlspecialchars($row["description"]) ?></dd>
</dl>