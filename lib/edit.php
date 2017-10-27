<div class="page-header">
    <h1>Redigér</h1>
</div>
<?php
require("inc/db/db.inc");

$type = $_GET['type'];

$id = $_GET['id'];

$data = $pdo->prepare("SELECT * FROM $type WHERE id = $id");
$data->execute();
$dataQ = $data->fetchAll(PDO::FETCH_ASSOC);
foreach ($dataQ as $row) {
    if ($type == 'events') {
        ?>

        <form method="post" action="/inc/db/edit.php?type=events&id=<?php echo $id; ?>" autocomplete="off">
            <fieldset>
                <div class="row">
                    <div class='col-lg-12'>
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" name="title" placeholder="Titel" value="<?php echo $row[title] ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" class="date form-control" name="date" placeholder="<?php echo date("d-m-Y"); ?>" value="<?php echo strftime('%d-%m-%Y', strtotime($row['date'])); ?>" readonly required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="bootstrap-timepicker form-group">
                            <?php
                            if ($row['time'] != NULL) {
                                $time = date('H:i', strtotime($row['time']));
                            } else {
                                $time = NULL;
                            }
                            echo "<input type='time' class='time form-control' name='time' value='$time'>";
                            ?>
                        </div>
                    </div>

                    <div class="col-lg-6">

                        <div class="form-group">
                            <select class="form-control" name="category" required>
                                <option selected><?php echo $row[category]; ?></option>
                                <option value='' disabled style='display:none;'>Kategori</option>
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
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="location" placeholder="Hvor" value="<?php echo $row[location] ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="description" rows="3" placeholder="Beskrivelse"><?php echo $row[description] ?></textarea>
                </div>
                <button class="btn btn-primary" type="submit">Gem</button>
                <button class="btn" type="reset" value="reset">Nulstil</button>
            </fieldset>
        </form>
        <?php
    }
    if ($type == 'homework') {
        ?>

        <form method="post" action="/inc/db/edit.php?type=homework&id=<?php echo $id; ?>" autocomplete="off">
            <fieldset>
                <div class="row">
                    <div class='col-lg-12'>
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" name="title" placeholder="Titel" value="<?php echo $row[title] ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" class="date form-control" name="duedate" placeholder="<?php echo date("d-m-Y"); ?>" value="<?php echo strftime('%d-%m-%Y', strtotime($row['duedate'])); ?>" readonly required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <select class="form-control" name="subject" required>
                                <option selected><?php echo $row[subject]; ?></option>
                                <?php
                                include('inc/datalists/subjects.php');
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="description" rows="3" placeholder="Beskrivelse"><?php echo $row[description] ?></textarea>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="done" <?php
                                if ($row['done'] == 1) {
                                    echo 'checked';
                                }
                                ?>> Udført
                            </label>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Gem</button>
                <button class="btn" type="reset" value="reset">Nulstil</button>
            </fieldset>
        </form>

        <?php
    }
    if ($type === "to_do") {
        ?>

        <form id="newToDoForm" method="post" action="/inc/db/edit.php?type=to_do&amp;id=<?php echo $id; ?>" autocomplete="off">
            <fieldset>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" name="title" placeholder="Titel" value="<?php echo $row[title] ?>" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" class="date form-control" name="duedate" placeholder="<?php echo date("d-m-Y"); ?>" readonly value="<?php
                            if ($row['duedate'] !== null) {
                                echo strftime('%d-%m-%Y', strtotime($row['duedate']));
                            }
                            ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <select class="form-control" name="list">
                                <option selected><?php echo $row['list']; ?></option>
                                <?php include("inc/datalists/to_do.php") ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Beskrivelse" name="description" rows="3"><?php echo $row[description] ?></textarea>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Gem</button>
                <button class="btn" type="reset" value="reset">Nulstil</button>
            </fieldset>
        </form>

        <?php
    }
}
?>