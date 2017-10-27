<div class="page-header">
    <h1>Measures</h1>
</div>

<form id="newMeasuresForm" method="post" action="inc/db/insert.php?type=measures">
    <table class='table table-striped table-hover table-bordered'>
        <thead>
            <tr>
                <th>Date</th>
                <th>Weight</th>
                <th>Wrist</th>
                <th>Chest</th>
                <th>Waist</th>
                <th>Hip</th>
                <th>Upper arm</th>
                <th>Lower arm</th>
                <th>Thigh</th>
                <th>Calf</th>
                <th>Neck</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>16-03-2013</td>
                <td>59</td>
                <td>15</td>
                <td>90</td>
                <td>70</td>
                <td>80</td>
                <td>28</td>
                <td>24</td>
                <td>53</td>
                <td>35</td>
                <td>34</td>
            </tr>
            <tr>
                <td><input class="form-control date" type="text" name="date" value="<?php echo date("d-m-Y"); ?>"></td>
                <td><input class="form-control" type="text" name="weight"></td>
                <td><input class="form-control" type="text" name="wrist"></td>
                <td><input class="form-control" type="text" name="chest"></td>
                <td><input class="form-control" type="text" name="waist"></td>
                <td><input class="form-control" type="text" name="hip"></td>
                <td><input class="form-control" type="text" name="upperArm"></td>
                <td><input class="form-control" type="text" name="lowerArm"></td>
                <td><input class="form-control" type="text" name="thigh"></td>
                <td><input class="form-control" type="text" name="calf"></td>
                <td><input class="form-control" type="text" name="neck"></td>
            </tr>
        </tbody>
    </table>
    <button class="btn btn-primary" type="submit" form="newMeasuresForm">Save</button>
    <button class="btn" type="reset" value="reset">Reset</button>
</form>