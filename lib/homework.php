<div class="page-header">
    <h1>Lektier</h1>
</div>

<table id="table-homework" class='table table-hover table-condensed table-bordered tablesorter tablesorter-bootstrap'>
    <thead>
        <tr>
            <th class="sorter-false"></th>
            <th>Dato</th>
            <th>Fag</th>
            <th class="hidden-xs">Titel</th>
            <th class="hidden-xs sorter-false">Beskrivelse</th>
            <th class="table-right sorter-false"></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th colspan="6" class="pager form-horizontal">
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
            </th>
        </tr>
    </tfoot>
    <tbody>
        <?php
        $stmt = $pdo->prepare("
                    SELECT * FROM homework WHERE done = 0 OR DATE(duedate) >= CURDATE() ORDER BY duedate ASC");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $done = $row[done] ? '<i class="fa fa-check-square fa-2x text-success"></i>' : '<i class="fa fa-check-square fa-2x text-muted"></i>';
            $done1 = $row[done] ? 'success' : 'danger';
            echo "<tr class='$done1 popover-click' data-title='$row[title]' data-content='";
            include("inc/homeworkPopover.php");
            echo "'>";

            echo "<td class='fit'><a href='/inc/db/edit.php?type=homeworkDone&amp;id=$row[id]'>$done</a></td>";
            echo "<td class='fit fixed-width'>" . ucfirst(strftime('%a. %d. %b.', strtotime($row['duedate']))) . "</td>";
            echo "<td>" . $row['subject'] . "</td>";
            echo "<td class='hidden-xs'>" . $row['title'] . "</td>";
            echo "<td class='hidden-xs'>" . $row ["description"] . "</td>";
            echo "<td class='fit table-centered'>
                    <a href='/edit?type=homework&amp;id=$row[id]'>
                        <i class='fa fa-pencil-square fa-2x text-muted'></i>
                    </a>
                    <a href='/inc/db/delete.php?type=homework&amp;id=$row[id]'><i class='fa fa-times fa-2x text-muted'></i>
                    </a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>