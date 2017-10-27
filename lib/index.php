<?php
$birthday = $pdo->prepare("
                    SELECT * FROM birthdays
                    WHERE notify = 1
                    AND DAY(birthdate)=DAY('" . date('Y-m-d') . "')
                    AND MONTH(birthdate)=MONTH('" . date('Y-m-d') . "')");
$birthday->execute();

$date2 = new DateTime(date('Y-m-d'));
while ($row = $birthday->fetch(PDO::FETCH_ASSOC)) {
    echo "<div class='alert alert-info'>";
    echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
    $date1 = new DateTime($row['birthdate']);
    $interval = $date1->diff($date2);
    echo "<i class='fa fa-flag'></i> <strong>Se her!</strong> " . $row['name'] . " bliver " . $interval->y . " i dag.";
    echo "</div>";
}
?>
<div class="row">
    <!-- LEKTIER -->
    <div class="col-lg-6 col-md-6 col-sm-6">
        <article class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-book fa-lg"></i> Lektier<a href="#" data-target="#newHomework" type="button" data-toggle="modal" class="pull-right"><i class="fa fa-plus-circle fa-lg"></i></a></h3>
            </div>
            <table class="table table-hover table-condensed">
                <tbody>
                    <?php
                    $homeworkQ = $pdo->prepare("
                    SELECT * FROM homework WHERE done = 0 OR DATE(duedate) >= CURDATE() ORDER BY duedate ASC LIMIT 5");
                    $homeworkQ->execute();
                    $homework = $homeworkQ->fetchAll(PDO::FETCH_ASSOC);
                    if (count($homework) < 5) {
                        $homework = array_pad($homework, 5, null);
                    }

                    foreach ($homework as $row) {
                        if ($row[title] != "") {
                            echo "<tr class='popover-click' data-title='$row[title]' data-content='";
                            include("inc/homeworkPopover.php");
                            echo "'>";
                        } else {
                            echo "<tr>";
                        }
                        if ($row[duedate] != null) {
                            $row[duedate1] = ucfirst(strftime("%a. %d. %b.", strtotime($row[duedate])));
                            $row[duedate2] = ucfirst(strftime("%A, d. %e. %B %Y, uge %V", strtotime($row[duedate])));
                            $row[duedate3] = ucfirst(strftime("%a %d/%m", strtotime($row[duedate])));
                        };
                        echo "<td class='fit'>";
                        if ($row[done] != "") {
                            echo "<a href='/inc/db/edit.php?type=homeworkDone&amp;id=$row[id]'>";

                            $done = $row[done] ? '<i class="fa fa-fw fa-check-circle fa-lg text-success"></i>' : '<i class="fa fa-fw fa-check-circle fa-lg text-muted"></i>';
                            echo "$done";
                            echo "</a>";
                        }
                        echo "</td>";
                        echo "<td class='fit fixed-width'><abbr title='$row[duedate2]'><b class='hidden-xs hidden-sm'>$row[duedate1]</b><b class='visible-xs visible-sm'>$row[duedate3]</b></abbr></td>";
                        echo "<td>$row[subject]&nbsp;</td>";
                        echo "<td class='text-muted visible-lg table-right'>$row[title]</td>";
                        echo "<td class='fit table-right'>";
                        if ($row[subject] != "") {
                            echo "<a href='/edit?type=homework&amp;id=$row[id]'><i class='fa fa-pencil fa-lg text-muted'></i></a> ";
                            echo "<a href='/inc/db/delete.php?type=homework&amp;id=$row[id]'><i class='fa fa-times-circle fa-lg text-muted'></i></a>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </article>
    </div>
    <!-- EVENTS -->
    <div class="col-lg-6 col-md-6 col-sm-6">
        <article class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-calendar fa-lg"></i> Begivenheder<a href="#" data-target="#newEvent" type="button" data-toggle="modal" class="pull-right"><i class="fa fa-plus-circle fa-lg"></i></a></h3>
            </div>
            <table class="table table-striped table-bordered table-bordered-outer table-hover table-condensed">
                <tbody>
                    <?php
                    $eventsQ = $pdo->prepare("
                    SELECT * FROM events WHERE DATE(date) >= CURDATE() ORDER BY date ASC, time LIMIT 5");
                    $eventsQ->execute();
                    $events = $eventsQ->fetchAll(PDO::FETCH_ASSOC);
                    if (count($events) < 5) {
                        $events = array_pad($events, 5, null);
                    }

                    foreach ($events as $row) {
                        if ($row[date] != null) {
                            $row[date1] = ucfirst(strftime("%a. %d. %b.", strtotime($row[date])));
                            $row[date2] = ucfirst(strftime("%A, d. %e. %B %Y, uge %V", strtotime($row[date])));
                            $row[date3] = ucfirst(strftime("%a %d/%m", strtotime($row[date])));
                        };
                        if ($row[time] != null) {
                            $time = date('H:i', strtotime($row[time]));
                        } else {
                            $time = $row [time];
                        }
                        echo "<tr>";
                        echo "<td class='fit fixed-width'><abbr title='$row[date2]'><b class='hidden-xs hidden-sm'>$row[date1]</b><b class='visible-xs visible-sm'>$row[date3]</b></abbr></td>";
                        echo "<td class='fit fixed-width'>$time</td>";
                        echo "<td>$row[title]</td>";
                        echo "<td class='fit table-right'>
                            <a href='/edit?type=events&amp;id=$row[id]'><i class='fa fa-pencil text-muted fa-lg'></i></a>
                            <a href='/inc/db/delete.php?type=events&amp;id=$row[id]'><i class='fa fa-times-circle text-muted fa-lg'></i></a>
                          </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </article>
    </div>
</div>
<!-- TODOS -->
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <article class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-check-square-o fa-lg"></i> To-Do<a href="#" data-target="#newToDo" type="button" data-toggle="modal" class="pull-right"><i class="fa fa-plus-circle fa-lg"></i></a></h3>
            </div>
            <?php
            $to_do = $pdo->prepare("
                    SELECT * FROM to_do
                    WHERE list = 'Indbakke'
                    AND done = 0
                    ORDER BY CASE WHEN duedate is null then 1 else 0 end, duedate
                    LIMIT 5");
            $to_do->execute();
            $to_dos = $to_do->fetchAll(PDO::FETCH_ASSOC);
            if (count($to_dos) < 5) {
                $to_dos = array_pad($to_dos, 5, null);
            }
            ?>
            <table class="table table-hover table-striped table-bordered table-bordered-outer">
                <tbody>
                    <?php
                    foreach ($to_dos as $row) {
                        if ($row[duedate] == null || "" || "0000-00-00") {
                            $row[duedate1] = "";
                        } else {
                            $row[duedate1] = ucfirst(strftime("%a. %d. %b.", strtotime($row[duedate])));
                        }
                        echo "<tr>";
                        echo "<td class='fit'>";
                        if ($row[title] != "") {
                            echo "<a href='/inc/db/edit.php?type=to_do&amp;action=done&amp;id=$row[id]'><i class='fa fa-check-circle text-muted fa-lg'></i></a>";
                            echo "</td><td class='fit'>";
                            echo "<b class='fixed-width'>$row[duedate1]</b>";
                            echo "</td><td>";
                            echo "$row[title] ";
                            echo "<span class='text-muted'>$row[description]</span>";
                            echo "<a class='pull-right' href='/inc/db/delete.php?type=to_do&amp;id=$row[id]'><i class='fa fa-times text-muted fa-lg'></i></a>";
                        } else {
                            echo "<td></td><td>";
                            echo "&nbsp;";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </article>
    </div>
</div>