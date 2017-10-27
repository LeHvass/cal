<?php
if ($_GET['list'] == NULL) {
    $list = 'Indbakke';
} else {
    $list = $_GET['list'];
}

function echoActiveList($requestList) {
    global $list;
    if (strpos($list, $requestList) !== false) {
        echo 'class="active"';
    }
}
?>
<div class="page-header">
    <ul class="nav nav-pills pull-right">
        <?php
        $lists = $pdo->prepare("SELECT DISTINCT list FROM to_do WHERE list NOT IN
    (
        SELECT list
        FROM to_do
        WHERE list = ''
    )");

        $lists->execute();
        while ($row = $lists->fetch(PDO::FETCH_ASSOC)) {
            $count = $pdo->prepare("
                    SELECT * FROM to_do
                    WHERE list='$row[list]' AND done='0'");
            $count->execute();
            $count_rows = $count->rowCount();
            echo "<li ";
            echo echoActiveList($row['list']);
            echo "><a href='?list=$row[list]'>$row[list] <span class='badge'>$count_rows</span></a></li>";
        }
        ?>
    </ul>
    <h1>To-Do</h1>
</div>
<?php
$to_do = $pdo->prepare("
                    SELECT * FROM to_do
                    WHERE list='$list' AND done='0' ORDER BY starred DESC, CASE WHEN duedate is null then 1 else 0 end, duedate DESC");
$to_do->execute();
?>
<table id="to-do" class="table table-hover table-striped table-bordered">
    <tbody>
        <?php
        while ($row = $to_do->fetch(PDO::FETCH_ASSOC)) {
            $starred = $row[starred] ? 'fa-star text-gold' : 'fa-star-o text-muted';
            if ($row[duedate] === null || '0000-00-00') {
                $row[duedate1] = "";
            } else {
                $row[duedate1] = ucfirst(strftime("%a. %d. %b.", strtotime($row[duedate])));
            }
            echo "<tr>";
            echo "<td>";
            echo "<a href='/inc/db/edit.php?type=to_do&amp;action=done&amp;id=$row[id]'><i class='fa fa-check text-muted fa-2x fa-fw'></i></a>";
            echo "<a href='/inc/db/edit.php?type=to_do&amp;action=starred&amp;id=$row[id]'><i class='star fa $starred fa-2x fa-fw'></i></a>";
            echo "<b class='fixed-width'>$row[duedate1]</b>";
            echo "$row[title] ";
            echo "<span class='text-muted'>$row[description]</span>";
            echo "<span class='pull-right'>";
            echo "<a href='/edit?type=to_do&amp;id=$row[id]'><i class='fa fa-pencil text-muted fa-2x'></i></a> ";
            echo "<a href='/inc/db/delete.php?type=to_do&amp;id=$row[id]'><i class='fa fa-times-circle text-muted fa-2x'></i></a>";
            echo "</span>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>