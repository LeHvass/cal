<form id="newWorkoutsForm" method="post" action="inc/db/insert.php?type=workouts">
    <table class="table table-center table-condensed">
        <thead>
            <tr>
                <th>
                    <input id="date" name="date" type="text" class="date input-small form-control" value="<?php echo date("d-m-Y"); ?>" required>
                </th>
                <th colspan="3">
                    Tilføj nyt træningspas
                </th>
            </tr>
            <tr>
                <th>
                    Øvelse
                </th>
                <th class="span2">
                    Sæt & gentagelser
                </th>
                <th class="span2">
                    Vægt [kg]
                </th>
                <th class="span8">
                    Noter
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><select id="workoutExercise" class="form-control" name="exercise[]"><?php include("inc/datalists/exercises.php"); ?></select></td>
                <td><input class="form-control" type="text" name="sets[]"></td>
                <td><input class="form-control" type="text" name="weight[]"></td>
                <td><input class="form-control" type="text" name="notes[]"></td>
            </tr>
            <tr>
                <td><select id="workoutExercise" class="form-control" name="exercise[]"><?php include("inc/datalists/exercises.php"); ?></select></td>
                <td><input class="form-control" type="text" name="sets[]"></td>
                <td><input class="form-control" type="text" name="weight[]"></td>
                <td><input class="form-control" type="text" name="notes[]"></td>
            </tr>
            <tr>
                <td><select id="workoutExercise" class="form-control" name="exercise[]"><?php include("inc/datalists/exercises.php"); ?></select></td>
                <td><input class="form-control" type="text" name="sets[]"></td>
                <td><input class="form-control" type="text" name="weight[]"></td>
                <td><input class="form-control" type="text" name="notes[]"></td>
            </tr>
            <tr>
                <td><select id="workoutExercise" class="form-control" name="exercise[]"><?php include("inc/datalists/exercises.php"); ?></select></td>
                <td><input class="form-control" type="text" name="sets[]"></td>
                <td><input class="form-control" type="text" name="weight[]"></td>
                <td><input class="form-control" type="text" name="notes[]"></td>
            </tr>
        </tbody>
    </table>
    <button class="btn btn-primary" type="submit" form="newWorkoutsForm">Save</button>
    <button class="btn" type="reset" value="reset">Reset</button>
</form>