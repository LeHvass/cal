<form id="newHomeworkForm" method="post" action="/inc/db/insert.php?type=homework" autocomplete="off">
    <fieldset>
        <div class="col-lg-12">
            <div class="row">
                <div class="form-group">
                    <input type="text" class="form-control input-lg" name="title" placeholder="Titel" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <input type="text" class="date form-control" data-mask="99-99-9999" name="duedate" placeholder="<?php echo date("d-m-Y"); ?>" readonly required>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <select class="form-control select2-single" style="width:100%" name="subject" required data-placeholder="Vælg fag">
                        <option></option>
                        <?php
                        $subject = $pdo->prepare("
                    SELECT * FROM homeworkSubjects");
                        $subject->execute();
                        $subjects = $subject->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($subjects as $row) {
                            echo "<option>$row[subject]</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-12">
                <textarea class="form-control" placeholder="Beskrivelse" name="description" rows="3"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="done"> Udført
                    </label>
                </div>
            </div>
        </div>

        <button class="btn btn-primary" type="submit">Gem</button>
        <button class="btn" type="reset" value="reset">Nulstil</button>
    </fieldset>
</form>