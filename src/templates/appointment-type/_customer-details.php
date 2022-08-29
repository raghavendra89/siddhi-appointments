<?php

    $customer_fields = [
        'Name',
        'Email Address',
        'Phone Number',
        'Address',
        'Country',
        'State',
        'City',
        'Zip Code',
        'Notes'
    ];

?>

<div class="sa-row">

    <div class="sa-col-sm-6">
        <h4 class="sa-text-underline">Choose Fields</h4>

        <table class="sa-table">
            <thead>
                <tr>
                    <th>Field</th>
                    <th class="sa-text-center">Show Field</th>
                    <th class="sa-text-center">Required Field</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $customer_fields as $field ) { ?>
                    <tr>
                        <td><?php echo $field; ?></td>
                        <td class="sa-text-center"><input class="sa-form-check-input" type="checkbox" checked></td>
                        <td class="sa-text-center"><input class="sa-form-check-input" type="checkbox"></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="sa-col-sm-6">

        <div class="sa-row">
            <div class="sa-col-12">
                <h4 class="sa-text-underline">Additional Settings</h4>
            </div>
        </div>

        <div class="sa-row">
            <div class="sa-col-md-7 sa-col-sm-10 sa-mb-3">
                <label class="sa-form-label">Phone number format</label>
                <input type="text" class="sa-form-control" name="customer-phone-number-format" value="999-999-9999">
            </div>

            <div class="sa-col-md-7 sa-col-sm-10 sa-mb-3">
                <label class="sa-form-label">States list dropdown</label>
                <select class="sa-form-control">
                    <option></option>
                    <option>US States List</option>
                    <option>Indian States List</option>
                </select>
            </div>

            <div class="sa-col-md-7 sa-col-sm-10 sa-mb-3">
                <label class="sa-form-label">Show countries list?</label><br>
                <div class="sa-form-check sa-form-check-inline">
                    <input class="sa-form-check-input" type="radio" name="countries-list" id="countries-list-show" value="yes" checked>
                    <label class="sa-form-check-label" for="countries-list-show">Yes</label>
                </div>
                <div class="sa-form-check sa-form-check-inline">
                    <input class="sa-form-check-input" type="radio" name="countries-list" id="countries-list-hide" value="no">
                    <label class="sa-form-check-label" for="countries-list-hide">No</label>
                </div>
            </div>
        </div>

    </div>
</div>