<?php

?>

<div class="sa-row">
    <div class="sa-col-sm-6 sa-mb-3">
        <label class="sa-form-label">Name</label>
        <input type="text" class="sa-form-control" name="appointment-type-name">
    </div>

    <div class="sa-col-sm-6 sa-mb-3">
        <label class="sa-form-label">Description</label>
        <input type="text" class="sa-form-control" name="appointment-type-description">
    </div>

    <div class="sa-col-sm-6 sa-mb-3">
        <label class="sa-form-label">No. of Concurrent Appointments</label>
        <input type="text" class="sa-form-control" name="concurrent-appointments" value="1">
    </div>

    <div class="sa-col-sm-6 sa-mb-3">
        <label class="sa-form-label">Available only for logged in users?</label><br>
        <div class="sa-form-check sa-form-check-inline">
            <input class="sa-form-check-input" type="radio" name="availability" id="available-logged-in-users" value="yes">
            <label class="sa-form-check-label" for="available-logged-in-users">Yes</label>
        </div>
        <div class="sa-form-check sa-form-check-inline">
            <input class="sa-form-check-input" type="radio" name="availability" id="available-for-all" value="no" checked>
            <label class="sa-form-check-label" for="available-for-all">No</label>
        </div>
    </div>
</div>