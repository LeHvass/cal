<form id="newJournalForm" method="post" action="/inc/db/insert.php?type=journal">
    <fieldset>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <input type="text" class="date form-control" data-mask="99-99-9999" name="date" value="<?php echo date("d-m-Y"); ?>" readonly>
                </div>

                <div class="form-group">
                    <textarea name="success" class="form-control" rows="2" placeholder="Succes"></textarea>
                </div>

                <div class="form-group">
                    <textarea name="lesson" class="form-control" rows="2" placeholder="Lektie"></textarea>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="checkbox"><label class="modal-popover" data-content='<?php include("inc/routine/morning.php") ?>'><input type="checkbox" name="morning"> Morgen</label></div>
                <div class="checkbox"><label><input type="checkbox" name="homework"> Lektier</label></div>
                <div class="checkbox"><label><input type="checkbox" name="training"> Træning</label></div>
                <div class="checkbox"><label><input type="checkbox" name="creativity" data-content='Musik<br/>Programmering'> Kreativitet</label></div>
                <div class="checkbox"><label><input type="checkbox" name="reading"> Læsning</label></div>
                <div class="checkbox"><label class="modal-popover" data-content='<?php include("inc/routine/evening.php") ?>'><input type="checkbox" name="evening"> Aften</label></div>
                <div class="checkbox"><label class="modal-popover" data-content='PornFree <br/> PE exercises'><input type="checkbox"> Andet</label></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <textarea class="form-control" name="notes" rows="3" placeholder="Noter"></textarea>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Gem</button>
        <button class="btn" type="reset" value="reset">Nulstil</button>
    </fieldset>
</form>