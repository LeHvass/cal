<?php
if (isset($_GET[month])) {
    $mon = $_GET[month];
} else {
    $mon = idate("m");
}
if (isset($_GET[year])) {
    $year = $_GET[year];
} else {
    $year = idate("Y");
}

$timestamp = mktime(0, 0, 0, $mon, 1, $year);
$mon = idate("m", $timestamp);
$year = idate("Y", $timestamp);

// Opretter forbindelse til database
require_once('inc/db/db.inc');

$curmonth = idate("m");
$curyear = idate("Y");
$thismonth = mktime(0, 0, 0, $mon, 1, $year);
$nextmonth = mktime(0, 0, 0, $mon + 1, 30, $year);
$firstday = "'" . date('Y-m-d', $thismonth) . "'";
$lastday = "'" . date('Y-m-d', $nextmonth) . "'";

$prev_month = $mon - 1;
$next_month = $mon + 1;
?>
<div class="page-header">
    <form class="form-inline" method="get" action="/calendar" name="sel_date">
        <span class="pull-right">
            <select class="form-control" name="month" onchange="sel_date.submit();">
                <?php
                for ($i = 1; $i < 13; $i++) {

                    echo '<option value="' . $i . '" ';
                    if ($i == $mon) {
                        echo 'selected="selected"';
                    }
                    echo '>' . ucfirst(strftime("%B", mktime(0, 0, 0, $i, 1, $year))) . "</option>\r\n";
                }
                ?>
            </select>
            <select class="form-control" name="year" onchange="sel_date.submit();">
                <?php
                for ($i = (2013); $i < (idate("Y") + 3); $i++) {
                    echo '<option value="' . $i . '" ';
                    if ($i == $year) {
                        echo 'selected="selected"';
                    }
                    echo '>' . $i . "</option>\r\n";
                }
                ?>
            </select>
        </span>
    </form>
    <h1>Kalender <small><?php echo ucfirst(strftime("%B", mktime(0, 0, 0, $mon, 1, $year))) . " $year"; ?></small></h1>
</div>

<div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-plus-circle fa-lg"></i> Tilføj <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li><a href="#" data-target="#newEvent" data-toggle="modal"><i class="fa fa-star fa-fw"></i> Begivenhed</a></li>
        <li><a href="#" data-target="#newBirthday" data-toggle="modal"><i class="fa fa-gift fa-fw"></i> Fødselsdag</a></li>
        <li><a href="#" data-target="#newHomework" data-toggle="modal"><i class="fa fa-book fa-fw"></i> Lektier</a></li>
    </ul>
</div>

<div class="btn-group pull-right">
    <a class="btn btn-default" href="<?php echo "?month=$prev_month&amp;year=$year" ?>"><i class="fa fa-chevron-left"></i></a>
    <a class="btn btn-default" href="<?php echo "?month=$curmonth&amp;year=$curyear" ?>"><b>I dag</b></a>
    <a class="btn btn-default" href="<?php echo "?month=$next_month&amp;year=$year" ?>"><i class="fa fa-chevron-right"></i></a>
</div>
<br/><br/>

<table id="bigCal" class="table table-bordered table-equal table-condensed">
    <thead>
        <tr class="active">
            <th style="width:38px">Uge</th>
            <th>Man</th>
            <th>Tir</th>
            <th>Ons</th>
            <th>Tor</th>
            <th>Fre</th>
            <th>Lør</th>
            <th>Søn</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $weekday = 1;
        for ($day = 1; $day < idate("t", mktime(0, 0, 0, $mon, 1, $year)) + 1; $day++) {

            $tid = mktime(0, 0, 0, $mon, $day, $year); // Timestamp for dagen udregnes
            $dagsdato = date('Y-m-d', mktime(0, 0, 0, $mon, $day, $year)); //Datoen for dagen udregnes til mysql-værdi
            // Skifter til en ny uge
            if ($weekday == 8) {
                echo "</tr><tr>\r\n";
                echo "<td class='active'>" . strftime("%V", $tid) . "</td>";
                $weekday = 1;
            }

            //Den forige måneds sidste dage.
            if ($day == 1) {
                echo "<td class='active'>" . strftime("%V", $tid) . "</td>";
                $weekday = intval(strftime("%u", $tid));
                for ($k = 1; $k < $weekday; $k++) {
                    $lastdays = $k - $weekday;
                    echo '<td class="text-muted">' . date("d", strtotime("$lastdays day", $tid)) . "</td>\r\n";
                }
            }

//              Markér dags dato
            if ($dagsdato == date('Y-m-d')) {
                echo "<td class='success'><b>" . date("d", $tid) . "</b>";
            } else {
                echo "<td>" . date("d", $tid);
            }

//              Fødselsdage
            $bdays = $pdo->prepare("
                    SELECT * FROM birthdays WHERE DAY(birthdate) = DAY('$dagsdato') AND MONTH(birthdate) = MONTH('$dagsdato') ORDER BY birthdate ASC");
            $bdays->execute();
            while ($row = $bdays->fetch(PDO::FETCH_ASSOC)) {
                $date1 = new DateTime($row['birthdate']);
                $date2 = new DateTime($dagsdato);
                $interval = $date2->diff($date1);
                $age = $interval->y;
                echo "<div class='label label-danger'>$row[name] <b>$age</b></div>";
            }

//              To Dos
            $todos = $pdo->prepare("
                    SELECT * FROM to_do WHERE duedate = '$dagsdato' AND done = 0");
            $todos->execute();
            while ($row = $todos->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='label label-warning'>$row[title]</div>";
            }

//              Begivenheder
            $stmt = $pdo->prepare("
                    SELECT * FROM events WHERE date = '$dagsdato' ORDER BY time ASC");
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($row['time'] != NULL) {
                    $time = date('H:i', strtotime($row['time']));
                } else {
                    $time = NULL;
                }
                switch ($row['category']) {
                    case "Andet":
                        $label = "label-default";
                        break;
                    case "Sport":
                        $label = "label-success";
                        break;
                    case "Skole":
                        $label = "label-primary";
                        break;
                    case "Musik":
                        $label = "label-warning";
                        break;
                    case "Arbejde":
                        $label = "label-info";
                        break;
                    default:
                        $label = "label-default";
                        break;
                }
                $buttons = '<div class="btn-group pull-right">
        <a href="edit?type=events&amp;id=' . $row['id'] . '"><i class="fa fa-edit fa-lg text-primary"></i></a>
        <a href="/inc/db/delete.php?type=events&amp;id=' . $row['id'] . '"><i class="fa fa-times fa-lg text-danger"></i></a>
      </div>
      <div class="clearfix"></div>';
                echo "<div class='label $label' data-title='$row[title]" . $buttons . "' data-content='";
                require("inc/eventPopover.php");
                echo "'>$time $row[title]</div>";
            }

//              Lektier
            $homework = $pdo->prepare("
                    SELECT * FROM homework WHERE duedate = '$dagsdato' ORDER BY duedate ASC");
            $homework->execute();
            while ($row = $homework->fetch(PDO::FETCH_ASSOC)) {
                $editHomework = '<a href="edit?type=homework&amp;id=' . $row['homework.id'] . '"><i class="fa fa-edit fa-lg text-primary pull-right"></i></a>';
                $done1 = $row[done] ? "<i class='fa fa-check fa-fw text-success'></i>" : "<i class='fa fa-times fa-fw text-danger'></i>";
                $done2 = $row[done] ? '<a href="/inc/db/edit.php?type=homeworkDone&amp;id=' . $row['id'] . '"><i class="fa fa-check fa-lg text-success"></i></a>' : '<a href="/inc/db/edit.php?type=homeworkDone&amp;id=' . $row[id] . '"><i class="fa fa-times fa-lg text-danger"></i></a>';
                $deleteLink = '<a href="/inc/db/delete.php?type=homework&amp;id=' . $row[id] . '"><i class="fa fa-trash-o fa-lg pull-right"></i></a>';
                echo "<div class='label label-info' data-title='$done2 $row[title] $editHomework $deleteLink' data-content='";
                include("inc/homeworkPopover.php");
                echo "'>$done1 &nbsp;$row[subject]</div>";
            }

            echo "</td>\r\n";
            //næste måneds datoer når den sidste dag i måneden er nået
            if ($day == idate("t", mktime(0, 0, 0, $mon, 1, $year))) {
                $weekday = intval(strftime("%u", $tid));
                $nextdays = 0;
                for ($k = 7; $k > $weekday; $k--) {
                    $nextdays += 1;
                    echo '<td class="text-muted">' . date("d", strtotime("+$nextdays day", $tid)) . "</td>\r\n";
                }
            }
            $weekday +=1;
        }
        ?>
    </tbody>
</table>

<div id="newBirthday" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Fødselsdage</h4>
            </div>

            <div class="modal-body">
                <ul class="nav nav-pills">
                    <li class="active"><a href="#new" data-toggle="tab">Tilføj</a></li>
                    <li><a href="#view" data-toggle="tab">Vis tabel</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active fade in" id="new">
                        <form id="newBirthdayForm" method="post" action="inc/db/insert.php?type=birthdays">
                            <fieldset>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Navn" required>
                                </div>

                                <div class="form-group">
                                    <input class="form-control date" name="birthdate" type="text" data-date-start-view="2" placeholder="<?php echo date("d-m-Y"); ?>" required>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <i class="fa fa-bell-alt fa-lg"></i> Påmindelse <input type="checkbox" name="notify" value="">
                                    </label>
                                </div>

                                <button class="btn btn-primary" type="submit">Gem</button>
                                <button class="btn" type="reset" value="reset">Nulstil</button>
                            </fieldset>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="view">
                        <?php
                        $stmt = $pdo->prepare("
                    SELECT * FROM birthdays
                    GROUP BY MONTH(birthdate),DAY(birthdate) ASC");
                        $stmt->execute();
                        ?>
                        <table class='table table-striped table-hover table-condensed'>
                            <thead>
                                <tr>
                                    <th>Navn</th>
                                    <th>Fødselsdato</th>
                                    <th>Alder</th>
                                    <th class="table-right"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $date2 = new DateTime(date('Y-m-d'));
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . date('d-m-Y', strtotime($row['birthdate'])) . "</td>";
                                    $date1 = new DateTime($row['birthdate']);
                                    $interval = $date1->diff($date2);
                                    echo "<td>" . $interval->y . " år</td>";
                                    echo "<td class='table-right'><a href='inc/db/edit.php?id=$row[id]'><i class='fa fa-pencil fa-lg'></i></a>&nbsp;&nbsp;<a href='inc/db/delete.php?type=birthdays&amp;id=$row[id]'><i class='fa fa-trash fa-lg'></i></a>";
                                    echo "</tr>\r\n";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>