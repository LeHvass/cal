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