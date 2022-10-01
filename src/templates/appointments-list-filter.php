<?php

?>

<div class="sa-row sa-mb-3">
    <div class="sa-col-12">
        <button class="sa-btn sa-btn-icon sa-btn-outline sa-float-end sa-list-filter-btn"><?php sa_view( 'icons._filter' ); ?></button>
    </div>
</div>

<div class="sa-appointments-list-filter sa-mb-3" style="display: none;">
    <div class="sa-row">
        <div class="sa-col-md-3 sa-mb-2">
            <label class="sa-form-label"><?php _e( 'Appointment Type', 'sa_appointments' ); ?></label>
            <select class="sa-form-control">
                <option></option>
                <option>30 mins health consultation</option>
            </select>
        </div>

        <div class="sa-col-md-3 sa-mb-2">
            <label class="sa-form-label"><?php _e( 'Customer Name', 'sa_appointments' ); ?></label>
            <input type="text" class="sa-form-control" name="">
        </div>

        <div class="sa-col-md-3 sa-mb-2">
            <label class="sa-form-label"><?php _e( 'Email Address', 'sa_appointments' ); ?></label>
            <input type="text" class="sa-form-control" name="">
        </div>

        <div class="sa-col-md-3 sa-mb-2">
            <label class="sa-form-label"><?php _e( 'Phone Number', 'sa_appointments' ); ?></label>
            <input type="text" class="sa-form-control" name="">
        </div>

        <div class="sa-col-md-3 sa-mb-2">
            <label class="sa-form-label"><?php _e( 'Appointment Date', 'sa_appointments' ); ?></label>
            <div class="sa-input-group">
                <input type="text" class="sa-form-control" placeholder="From Date">
                <span class="sa-input-group-text">To</span>
                <input type="text" class="sa-form-control" placeholder="To Date">
            </div>
        </div>

        <div class="sa-col-md-3 sa-mb-2">
            <label class="sa-form-label"><?php _e( 'Appointment Timeslot', 'sa_appointments' ); ?></label>
            <select class="sa-form-control">
                <option></option>
                <option>08:00AM - 08:30AM</option>
                <option>08:30AM - 09:00AM</option>
                <option>09:00AM - 09:30AM</option>
            </select>
        </div>

        <div class="sa-col-md-3 sa-mb-2">
            <label class="sa-form-label"><?php _e( 'Status', 'sa_appointments' ); ?></label>
            <select class="sa-form-control">
                <option></option>
                <option>Pending</option>
                <option>Confirmed</option>
                <option>Cancelled</option>
            </select>
        </div>

        <div class="sa-col-md-3 sa-mb-2">
            <label class="sa-form-label">&nbsp;</label>
            <div>
                <button class="sa-btn">Search</button>
                <button class="sa-btn sa-btn-secondary">Reset</button>
            </div>
        </div>
    </div>
</div>