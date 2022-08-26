<?php
    $appointment_types = [
        [
            'name' => 'Online Consultation',
            'description' => 'Online health consultation - Interviewing the patients and prescribing the medicines based on the described conditions.'
        ],
        [
            'name' => 'Online Consultation',
            'description' => 'Online health consultation - Interviewing the patients and prescribing the medicines based on the described conditions.'
        ]
    ];
?>

<div class="sa-appointments-wrapper">

    <div class="sa-page-title">
        <h3>Siddhi Appointments</h3>
    </div>

    <div class="sa-container">

        <div class="sa-row">
            <div class="sa-col-lg-8">
                <div class="sa-row">
                    <div class="sa-col-12">
                        <button class="sa-btn sa-mb-3">
                            Add Appointment
                        </button>
                    </div>
                </div>

                <?php foreach ( $appointment_types as $appointment_type ) { ?>
                    <div class="sa-card sa-mb-2">
                        <div class="sa-row">
                            <div class="sa-col-md-4">
                                <h2 class="sa-card-title"><?php echo esc_html( $appointment_type['name'] ); ?></h2>
                                <p><?php echo esc_html( $appointment_type['description'] ); ?></p>
                            </div>

                            <div class="sa-col-md-8">
                                <div class="sa-row sa-text-center">

                                    <div class="sa-col-md-4">
                                        <span class="sa-highlight sa-d-block">156</span>
                                        <span class="sa-fs-4">Total Appointments</span>
                                    </div>

                                    <div class="sa-col-md-4">
                                        <span class="sa-highlight sa-d-block">32</span>
                                        <span class="sa-fs-4">Upcoming Appointments</span>
                                    </div>

                                    <div class="sa-col-md-4 sa-pt-2">
                                        <span class="sa-shortcode">[sa_appointments_1]</span>
                                        <span class="dashicons dashicons-admin-page sa-text-primary sa-shortcode-copy sa-pointer" data-sa-toggle="tooltip" data-sa-title="Copy Shortcode"></span><br>
                                        <button class="sa-btn sa-mt-3">
                                            Edit Appointment
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>

    </div>

</div>