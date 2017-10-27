<div class="page-header">
    <h1>Trommer</h1>
</div>
<?php
if ($_GET['type'] == 'songs') {
    $songs = $pdo->prepare("
                    SELECT * FROM drum_songs");
    $songs->execute();
    ?>
    <table id="songs_table" class='table table-hover table-condensed table-bordered tablesorter tablesorter-bootstrap'>
        <thead>
            <tr>
                <th class="span6">Artist</th>
                <th class="span6">Titel</th>
                <th class="filter-select filter-match" data-placeholder="">Status</th>
                <th class="fit filter-false sorter-false table-right"></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th colspan="4" id="pager1" class="pager form-horizontal">
                    <button type="button" class="btn btn-default btn-small first"><i class="fa fa-step-backward"></i></button>
                    <button type="button" class="btn btn-default btn-small prev"><i class="fa fa-arrow-left"></i></button>
                    <span class="pagedisplay"></span>
                    <button type="button" class="btn btn-default btn-small next"><i class="fa fa-arrow-right"></i></button>
                    <button type="button" class="btn btn-default btn-small last"><i class="fa fa-step-forward"></i></button>
                    <select class="pagesize" title="Select page size">
                        <option selected="selected" value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                    </select>
                    <button type="button" class="btn btn-small btn-primary reset">Nulstil</button>
                </th>
            </tr>
        </tfoot>
        <tbody>
            <?php
            while ($row = $songs->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['artist'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td class='table-right'>
                            <a href='/inc/db/delete.php?type=drum_songs&amp;id=$row[id]'><i class='fa fa-times-sign text-muted fa-fw fa-lg'></i></a>
                          </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <?php
} else if ($_GET['type'] == 'techniques') {
    $techniques = $pdo->prepare("
                    SELECT * FROM drum_techniques");
    $techniques->execute();
    ?>
    <table id="techniques_table" class='table table-hover table-condensed table-bordered tablesorter tablesorter-bootstrap'>
        <thead>
            <tr>
                <th>Title</th>
                <th class="fit">Link</th>
                <th class="filter-select filter-match" data-placeholder="">Status</th>
                <th class="fit filter-false sorter-false table-right"></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th colspan="4" id="pager1" class="pager form-horizontal">
                    <button type="button" class="btn btn-default btn-small first"><i class="fa fa-step-backward"></i></button>
                    <button type="button" class="btn btn-default btn-small prev"><i class="fa fa-arrow-left"></i></button>
                    <span class="pagedisplay"></span>
                    <button type="button" class="btn btn-default btn-small next"><i class="fa fa-arrow-right"></i></button>
                    <button type="button" class="btn btn-default btn-small last"><i class="fa fa-step-forward"></i></button>
                    <select class="pagesize" title="Select page size">
                        <option selected="selected" value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                    </select>
                    <button type="button" class="btn btn-small btn-primary reset">Nulstil</button>
                </th>
            </tr>
        </tfoot>
        <tbody>
            <?php
            while ($row = $techniques->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td><a href='$row[link]' target='_blank'>Link</a></td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td class='table-right'>
                            <a href='/inc/db/delete.php?type=drum_techniques&amp;id=$row[id]'><i class='fa fa-trash fa-lg'></i></a>
                          </td>";
            }
            ?>
        </tbody>
    </table>
    <?php
}
?>