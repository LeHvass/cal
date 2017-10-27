<div class="page-header">
    <h1>Rudimenter</h1>
</div>

<?php
foreach (array("Single Stroke", "Paradiddle", "Drum Roll", "Flam Based", "Drag Based") as $rud_type) {
    $stmt = $pdo->prepare("
                    SELECT * FROM drum_rudiments WHERE type='$rud_type'");
    $stmt->execute();

    echo "<div class='row'>";
    echo "<h3 class='text-center'>$rud_type</h3>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        switch ($row[status]) {
            case 0:
                $width = "0%";
                $label = "";
                break;
            case 1:
                $width = "20%";
                $label = "Bronze";
                $color = "progress-bar-danger";
                break;
            case 2:
                $width = "40%";
                $label = "Silver";
                $color = "progress-bar-danger";
                break;
            case 3:
                $width = "60%";
                $label = "Gold";
                $color = "progress-bar-warning";
                break;
            case 4:
                $width = "80%";
                $label = "Platinum";
                $color = "progress-bar-success";
                break;
            case 5:
                $width = "100%";
                $label = "Diamond";
                $color = "progress-bar-success";
                break;
            default:
                break;
        }
        ?>
        <div class='col-xs-6 col-sm-4 col-md-3'>
            <div class='panel panel-default'>
                <div class='panel-body'>
                    <h5 class='text-center'><a href='<?php echo $row[url] ?>'><?php echo $row[title] ?></a></h5>
                    <a href='/inc/db/edit.php?type=drum_rudiments&amp;id=<?php echo $row[id] ?>'>
                        <div class='progress'>
                            <div class='progress-bar <?php echo $color ?>' style='width: <?php echo $width ?>'>
                                <span><?php echo $label ?></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <?php
    }
    echo "</div>";
}
?>