<?php

    use SiddhiAppointments\AppointmentsListTable;

    $appointments = [
        
    ];

    $appointmentsListTable = new AppointmentsListTable();
    $appointmentsListTable->prepare_items();
?>

<div class="sa-appointments-wrapper">

    <div class="sa-page-title">
        <h3>Appointments</h3>
    </div>

    <div class="sa-container">

        <div class="sa-row">
            <div class="sa-col-lg-12">

                <div class="sa-appointments-list-table-wrapper">
                    <?php sa_view( 'appointments-list-filter' ); ?>

                    <?php $appointmentsListTable->display(); ?>
                </div>

            </div>
        </div>

    </div>

</div>