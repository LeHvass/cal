<form id="newWorkoutForm" method="post" action="/inc/db/insert.php?type=workouts" autocomplete="off">
    <fieldset>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <input type="text" class="date form-control" data-mask="99-99-9999" name="date" value="<?php echo date("d-m-Y"); ?>" readonly>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <select class="form-control" name="exercise">
                        <?php include("inc/datalists/exercises.php"); ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <input type="text" name="weight" placeholder="Vægt" class="form-control">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <input type="text" name="setreps" placeholder="Sæt &amp; gentagelser" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <textarea class="form-control" name="notes" rows="3" placeholder="Noter"></textarea>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit" form="newWorkoutForm">Gem</button>
        <button class="btn" type="reset" value="reset">Nulstil</button>
    </fieldset>
</form>