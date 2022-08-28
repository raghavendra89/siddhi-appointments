<?php
    $slots = [
        '08:00 - 08:30',
        '08:30 - 09:00',
        '09:00 - 09:30',
        '09:30 - 10:00',
        '10:00 - 10:30',
        '10:30 - 11:00',
        '11:00 - 11:30',
        '11:30 - 12:00',
        '12:00 - 12:30',
        '12:30 - 13:00',
        '13:30 - 14:00',
        '14:00 - 14:30'
    ];
?>

<div class="sa-row sa-mb-4">
    <div class="sa-col-md-4 sa-col-sm-6 sa-mb-3">
        <label class="sa-form-label">Time slot duration (mins)</label>
        <input type="number" class="sa-form-control" name="slot-duration" step="5" min="5" max="180" value="30">
    </div>

    <div class="sa-col-md-4 sa-col-sm-6 sa-mb-3">
        <label class="sa-form-label">Appointment start time</label>
        <select class="sa-form-control">
            <option>06:00</option>
            <option>07:00</option>
            <option selected>08:00</option>
        </select>
    </div>

    <div class="sa-col-md-4 sa-col-sm-6 sa-mb-3">
        <label class="sa-form-label">Appointment end time</label>
        <select class="sa-form-control">
            <option>15:00</option>
            <option>16:00</option>
            <option>17:00</option>
        </select>
    </div>

    <div class="sa-col-md-4 sa-col-sm-6 sa-mb-3">
        <label class="sa-form-label">Weekly off</label>
        <select class="sa-form-control">
            <option>Sunday</option>
            <option>Monday</option>
            <option>Tuesday</option>
            <option>Wednesday</option>
            <option>Thursday</option>
            <option>Friday</option>
            <option>Saturday</option>
        </select>
    </div>

    <div class="sa-col-md-4 sa-col-sm-6 sa-mb-3">
        <label class="sa-form-label">Buffer time before appointment (mins)</label>
        <input type="number" class="sa-form-control" name="slot-duration" step="5" min="0" max="60" value="0">
    </div>

    <div class="sa-col-md-4 sa-col-sm-6 sa-mb-3">
        <label class="sa-form-label">Buffer time after appointment (mins)</label>
        <input type="number" class="sa-form-control" name="slot-duration" step="5" min="0" max="60" value="0">
    </div>
</div>

<div class="sa-row">
    <div class="sa-col-12">
        <label class="sa-form-label sa-d-block">Time slots</label>

        <div id="sa-timeslots-table-wrapper">
            <table class="sa-table" id="sa-timeslots-table">
                <thead>
                    <tr>
                        <th>Time Slot</th>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th>Sat</th>
                        <th>Sun</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($slots as $slot) { ?>
                        <tr>
                            <td><?php echo $slot; ?></td>

                            <?php for ($i=0;$i < 7; $i++) { ?>
                            <?php
                                $checked = 'checked';
                                if ($i > 4) {
                                    $checked = '';
                                }
                                if ($slot == '12:00 - 12:30' || $slot == '12:30 - 13:00') {
                                    $checked = '';
                                }
                            ?>
                            <td>
                                <div class="sa-time-slot <?php echo $checked; ?>">
                                    <input class="sa-form-check-input" type="checkbox" name="time-slot" <?php echo $checked; ?>>
                                </div>
                            </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>

    </div>
</div>
