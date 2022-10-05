<?php

    $activities = [
        [
            'type' => 'booked_at',
            'icon' => '_calendar',
            'description' => 'Appointment booked',
            'date' => '23-10-2022 10:20AM',
            'action_by' => 'John Doe'
        ],
        [
            'type' => 'auto_confirmed',
            'icon' => '_calendar',
            'description' => 'Appointment auto confirmed',
            'date' => '23-10-2022 10:20AM',
            'action_by' => 'John Doe'
        ],
        [
            'type' => 'booked_at',
            'icon' => '_calendar',
            'description' => 'John Doe added the Note.',
            'date' => '23-10-2022 01:20PM',
            'action_by' => 'John Doe'
        ],
        [
            'type' => 'booked_at',
            'icon' => '_calendar',
            'description' => 'John Doe updated the Appointment.',
            'date' => '24-10-2022 10:04AM',
            'action_by' => 'John Doe'
        ],
        [
            'type' => 'booked_at',
            'icon' => '_calendar',
            'description' => 'John Doe send the Reminder notification.',
            'date' => '27-10-2022 09:47AM',
            'action_by' => 'John Doe'
        ],
        [
            'type' => 'booked_at',
            'icon' => '_calendar',
            'description' => 'John Doe marked Appointment as completed.',
            'date' => '27-10-2022 01:35PM',
            'action_by' => 'John Doe'
        ]
    ];
?>

<div class="sa-appointments-wrapper">

    <div class="sa-page-title">
        <h3>Appointment - Online Consultation</h3>
    </div>

    <div class="sa-container">

        <div class="sa-row">
            <div class="sa-col-lg-8">

                <div class="sa-row">
                    <div class="sa-col-md-8">
                        <div class="sa-card sa-single-appointment sa-mb-3 sa-p-3">
                            <h3 class="sa-d-flex sa-align-items-baseline sa-mt-2 sa-mb-4 sa-pb-2 sa-bb-1">
                                <span class="sa-flex-1">Online Consultation</span>
                                <button class="sa-icon-btn sa-edit-appointment sa-p-0" data-sa-toggle="tooltip" data-sa-title="Edit Appointment">
                                    <?php sa_view( 'icons._edit' ); ?>
                                </button>
                            </h3>

                            <div class="sa-row">
                                <div class="sa-col-md-8 sa-col-sm-7 sa-col-6">
                                    <div class="sa-single-appointment-contact">
                                        <div class="sa-mb-3">
                                            <span class="sa-text-muted sa-form-label">Name: </span> Sarah Graham
                                        </div>
                                        <div class="sa-mb-3">
                                            <span class="sa-text-muted sa-form-label">Email Address: </span> sarah@gmail.com
                                        </div>
                                        <div class="sa-mb-3">
                                            <span class="sa-text-muted sa-form-label">Phone Number: </span> 999-999-9999
                                        </div>
                                        <div class="sa-mb-3">
                                            <span class="sa-text-muted sa-form-label">Address: </span> 46 smith street, Perth Amboy, Florida - 999999
                                        </div>
                                        <div class="sa-mb-3">
                                            <span class="sa-text-muted sa-form-label">Customer Notes: </span> I would like to get an overview about this product. 
                                        </div>
                                    </div>
                                </div>

                                <div class="sa-col-md-4 sa-col-sm-5 sa-col-6">
                                    <div class="sa-single-appointment-highlight sa-d-flex sa-mb-3">
                                        <div class="">
                                            <?php sa_view( 'icons._calendar' ); ?>
                                        </div>
                                        <div class="">
                                            <span class="sa-text-muted">Appointment Date</span>
                                            <div>23-10-2022</div>
                                        </div>
                                    </div>

                                    <div class="sa-single-appointment-highlight sa-d-flex sa-mb-3">
                                        <div class="">
                                            <?php sa_view( 'icons._clock' ); ?>
                                        </div>
                                        <div class="">
                                            <span class="sa-text-muted">Appointment Slot</span>
                                            <div>09:00AM - 09:30AM</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sa-card sa-mb-3 sa-p-3">
                            <h4 class="sa-d-flex sa-align-items-baseline sa-mt-2 sa-mb-2 sa-pb-2 sa-bb-1">
                                <span class="sa-flex-1">Notes:</span>
                                <div class="sa-float-end">
                                    <button class="sa-icon-btn sa-appointment-edit-note sa-p-0" data-sa-toggle="tooltip" data-sa-title="Edit Note">
                                        <?php sa_view( 'icons._edit' ); ?>
                                    </button>
                                    <button class="sa-icon-btn sa-appointment-delete-note sa-p-0" data-sa-toggle="tooltip" data-sa-title="Delete Note">
                                        <?php sa_view( 'icons._trash' ); ?>
                                    </button>
                                </div>
                            </h4>

                            <div class="sa-mt-2 sa-bb-1">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                            </div>
                            <div class="sa-mt-2">
                                <span class="sa-text-muted sa-float-end">John Doe, 10-02-2022 09:47AM</span>
                            </div>
                        </div>

                        <div class="sa-card sa-mb-3 sa-p-3">
                            <h4 class="sa-d-flex sa-align-items-baseline sa-mt-2 sa-mb-2 sa-pb-2 sa-bb-1">
                                <span class="sa-flex-1">Notes:</span>
                                <div class="sa-float-end">
                                    <button class="sa-icon-btn sa-appointment-edit-note sa-p-0" data-sa-toggle="tooltip" data-sa-title="Edit Note">
                                        <?php sa_view( 'icons._edit' ); ?>
                                    </button>
                                    <button class="sa-icon-btn sa-appointment-delete-note sa-p-0" data-sa-toggle="tooltip" data-sa-title="Delete Note">
                                        <?php sa_view( 'icons._trash' ); ?>
                                    </button>
                                </div>
                            </h4>

                            <div class="sa-mt-2 sa-bb-1">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                            </div>
                            <div class="sa-mt-2">
                                <span class="sa-text-muted sa-float-end">John Doe, 10-02-2022 09:47AM</span>
                            </div>
                        </div>

                        <div class="sa-card sa-mb-3 sa-p-3">
                            <h4 class="sa-mt-2 sa-mb-2 sa-pb-2 sa-bb-1">
                                <span class="sa-flex-1">Add Notes:</span>
                            </h4>

                            <div class="sa-mt-2">
                                <textarea class="sa-form-control sa-my-1"></textarea>
                                <button class="sa-btn sa-float-end">Add Notes</button>
                            </div>
                        </div>
                    </div>

                    <div class="sa-col-md-4 sa-single-appointment-sidebar">
                        <div class="sa-card sa-mb-3">
                            <h4 class="sa-mt-2 sa-mb-3 sa-pb-2 sa-bb-1">Actions</h4>
                            <button class="sa-btn sa-mb-2">Confirm</button>
                            <button class="sa-btn sa-btn-danger sa-mb-2">Cancel</button>
                            <button class="sa-btn sa-btn-danger sa-mb-2">Delete</button>
                            <button class="sa-btn sa-mb-2">Complete</button>
                            <button class="sa-btn sa-mb-2">Book Another</button>
                        </div>

                        <div class="sa-card">
                            <h4 class="sa-mt-2 sa-mb-3 sa-pb-2 sa-bb-1">Activity</h4>

                            <div class="sa-position-relative">
                                <div class="sa-appointment-activities">
                                    <?php foreach ($activities as $activity) { ?>
                                    <div class="sa-appointment-activity sa-d-flex sa-mb-4">
                                        <div class="sa-appointment-activity-icon sa-d-inline-flex">
                                            <?php sa_view( 'icons.' . $activity['icon'] ); ?>
                                        </div>
                                        <div class="sa-appointment-activity-text sa-ms-3 sa-flex-1">
                                            <div class="sa-appointment-activity-date sa-badge"><?php _e($activity['date']); ?></div>
                                            <div>
                                                <?php _e($activity['description']); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>