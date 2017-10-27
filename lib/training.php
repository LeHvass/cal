<div class="page-header">
    <ul class="nav nav-pills pull-right">
        <li class="active"><a href="#program" data-toggle="tab">Program</a></li>
        <li><a href="#warmup" data-toggle="tab">Opvarmning &amp; Udstræk</a></li>
        <li><a href="#mobility" data-toggle="tab">Mobilitet</a></li>
    </ul>
    <h1>Træning </h1>
</div>

<div class="tab-content">
    <div class="tab-pane fade in active" id="program">

        <div class="row">
            <div class="col-lg-3">
                <h3>Korte intervaller</h3>
                3 x 6 x 50 (80%) [3' &amp; 8']<br>
                <b class="popover-hover" data-content="<?php include("inc/routine/plyometrics.php") ?>">Spændstighed</b>
            </div>
            <div class="col-lg-3">
                <h3>Lange intervaller</h3>
                2 x 3 x 250 (80%) [3' &amp; 8']<br>
                <b class="popover-hover" data-content="<?php include("inc/routine/plyometrics.php") ?>">Spændstighed</b>
            </div>
            <div class="col-lg-3">
                <h3>Styrke A</h3>
                3*5 Squat<br/>3*5 Bænkpres<br/>3*5 Rows<br/>2*8 Curls<br/>
                <b class='popover-hover' data-content='<?php include("inc/routine/abs.php") ?>'>Core</b>
            </div>
            <div class="col-lg-3">
                <h3>Styrke B</h3>
                3*5 Dødløft<br/>3*5 Overhead Press<br/>3*7+ Pull-ups<br/>2*8+ Dips<br/>
                <b class='popover-hover' data-content='<?php include("inc/routine/abs.php") ?>'>Core</b>
            </div>
        </div>
    </div>
    <div class="tab-pane row fade" id="warmup">
        <div class="col-lg-12">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Opvarmning</h3>
                    </div>
                    <div class="panel-body">
                        <?php include("inc/routine/warmup.php"); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Udstræk</h3>
                    </div>
                    <div class="panel-body">
                        <?php include("inc/routine/cooldown.php"); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="mobility">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Mobilitet</h3>
                </div>
                <div class="panel-body">
                    <?php include("inc/routine/mobility.php"); ?>
                </div>
            </div>
        </div>
    </div>
</div>