<?php
if ($row[time] != null) {
    $row[time] = strftime('%k:%M', strtotime($row[time]));
}
$row[description] = nl2br($row[description]);
$row[date] = strftime("%A, d. %e. %b %Y", strtotime($row[date]));
?>

<dl class="dl-horizontal">
    <dt><i class="fa fa-calendar fa-fw"></i></dt>
    <dd><?php echo $row['date'] ?></dd>
    <dt><i class="fa fa-time fa-fw"></i></dt>
    <dd><?php echo $row[time] ?></dd>
    <dt><i class="fa fa-map-marker fa-fw"></i></dt>
    <dd><?php echo $row['location'] ?></dd>
    <dt><i class="fa fa-folder-open fa-fw"></i></dt>
    <dd><?php echo $row['category'] ?></dd>
    <dt><i class="fa fa-comment fa-fw"></i></dt>
    <dd><?php echo $row['description'] ?></dd>
</dl>