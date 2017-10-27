<form id="newEventForm" method="post" action="/inc/db/insert.php?type=events" autocomplete="off">
    <fieldset>
        <div class="row">
            <div class='col-lg-12'>
                <div class="form-group">
                    <input type="text" class="form-control input-lg" name="title" placeholder='Titel' required>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <input type="text" class="date form-control" data-mask="99-99-9999" name="date" placeholder="<?php echo date("d-m-Y"); ?>" readonly required >
                </div>
            </div>
            <div class="col-xs-6">
                <div class="bootstrap-timepicker form-group">
                    <input type="time" class="time form-control" name="time" placeholder="<?php echo date("G:i") ?>">
                </div>
            </div>
            <div class="col-xs-6">

                <div class="form-group">
                    <select class="form-control" name="category" required data-placeholder="Kategori">
                        <option></option>
                        <option>
                            Skole
                        </option>
                        <option>
                            Arbejde
                        </option>
                        <option>
                            Musik
                        </option>
                        <option>
                            Sport
                        </option>
                        <option>
                            Andet
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <input type="text" class="form-control" name="location" placeholder="Hvor">
                </div>
            </div>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="description" rows="3" placeholder="Beskrivelse"></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Gem</button>
        <button class="btn" type="reset" value="reset">Nulstil</button>
    </fieldset>
</form>