<form id="newToDoForm" method="post" action="/inc/db/insert.php?type=to_do" autocomplete="off">
    <fieldset>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <input type="text" class="form-control input-lg" name="title" placeholder="Titel" required />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <input type="text" class="date form-control" data-mask="99-99-9999" name="duedate" placeholder="<?php echo date("d-m-Y"); ?>" readonly>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <select class="form-control" name="list" title="Test">
                        <?php include("inc/datalists/to_do.php") ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <textarea class="form-control" placeholder="Beskrivelse" name="description" rows="3"></textarea>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Gem</button>
        <button class="btn" type="reset" value="reset">Nulstil</button>
    </fieldset>
</form>