<nav class="navmenu navmenu-inverse navmenu-fixed-left offcanvas-sm">
    <a class="navmenu-brand" href="/">Christian Hvass</a>

    <a class="navmenu-date" href="#" data-target="#newHomework" data-toggle="modal"><i class="fa fa-book fa-lg fa-fw"></i></a>
    <a class="navmenu-date" href="#" data-target="#newEvent" data-toggle="modal"><i class="fa fa-calendar fa-lg fa-fw"></i></a>
    <a class="navmenu-date" href="#" data-target="#newToDo" data-toggle="modal"><i class="fa fa-check-square-o fa-lg fa-fw"></i></a>
    <a class="navmenu-date" href="#" data-target="#newJournal" data-toggle="modal"><i class="fa fa-archive fa-lg fa-fw"></i></a>

    <span class="navmenu-date"><?php echo ucfirst(strftime("%A, d. %e. %B, Uge %V")); ?></span>
    <ul class="nav navmenu-nav">
        <li <?php echoActiveClassIfRequestMatches("index") ?>><a href="/"><i class="fa fa-home fa-lg fa-fw"></i> Oversigt</a></li>
        <li <?php echoActiveClassIfRequestMatches("calendar") ?>><a href="/calendar"><i class="fa fa-calendar fa-lg fa-fw"></i> Kalender</a></li>
        <li <?php echoActiveClassIfRequestMatches("homework") ?>><a href="/homework"><i class="fa fa-book fa-lg fa-fw"></i> Lektier</a></li>
        <li <?php echoActiveClassIfRequestMatches("training") ?> class="dropdown">
            <a href="/training" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-trophy fa-lg fa-fw"></i> Træning <b class="caret"></b></a>
            <ul class="dropdown-menu navmenu-nav">
                <li><a href="/training"><b>Overblik</b></a></li>
                <li><a href="/training/stats">Statistik</a></li>
                <li><a href="/training/workouts">Træningspas</a></li>
                <li><a href="/training/measures">Kropsmål</a></li>
            </ul>
        </li>
        <?php
        $count = $pdo->prepare("
                    SELECT * FROM to_do
                    WHERE list='Indbakke' AND done='0'");
        $count->execute();
        $count_rows = $count->rowCount();
        ?>
        <li <?php echoActiveClassIfRequestMatches("to-do") ?>><a href="/to-do"><i class="fa fa-check-square-o fa-lg fa-fw"></i> To-Do <span class="badge pull-right"><?php
                    if ($count_rows != 0) {
                        echo $count_rows;
                    }
                    ?></span></a></li>
        <li <?php echoActiveClassIfRequestMatches("journal") ?>><a href="/journal"><i class="fa fa-archive fa-lg fa-fw"></i> Logbog</a></li>
        <li <?php echoActiveClassIfRequestMatches("music") ?> class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-music fa-lg fa-fw"></i> Musik <b class="caret"></b></a>
            <ul class="dropdown-menu navmenu-nav">
                <li><a href="/music?drum=songs"><b>Overblik</b></a></li>
                <li><a href="/music/drums?type=songs">Sange</a></li>
                <li><a href="/music/drums?type=techniques">Teknikker</a></li>
                <li><a href="/music/rudiments">Rudimenter</a></li>
            </ul>
        </li>
        <li <?php echoActiveClassIfRequestMatches("other") ?> class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-puzzle-piece fa-lg fa-fw"></i> Andet <b class="caret"></b></a>
            <ul class="dropdown-menu navmenu-nav">
                <li><a href="/other/plugins">Plugins</a></li>
            </ul>
        </li>
    </ul>

    <ul class="nav navmenu-nav">
        <li><a href="/logout.php"><i class="fa fa-lg fa-fw fa-power-off"></i> Log af</a></li>
    </ul>
</nav>