<?php
    
?>

<div class="sa-appointments-wrapper">

    <div class="sa-page-title">
        <h3>Add Appointment Type</h3>
    </div>

    <div class="sa-container">

        <div class="sa-row">
            <div class="sa-col-lg-8">

                <div class="sa-section collapsed">
                    <div class="sa-section-header sa-pointer">
                        <div class="sa-section-title">
                            Basic Details
                            <div class="sa-section-sub-title">Name, description and other basic details.</div>
                        </div>
                        <span><img src="<?php echo SA_PLUGIN_ASSETS_PATH . 'img/expand_more.svg' ?>"></span>
                    </div>

                    <div class="sa-section-body">
                        <?php sa_view( 'appointment-type._basic-details' ); ?>
                    </div>
                </div>

                <div class="sa-section">
                    <div class="sa-section-header sa-pointer">
                        <div class="sa-section-title">
                            Time Slots
                            <div class="sa-section-sub-title">Configure slots available for this appointment type.</div>
                        </div>
                        <span><img src="<?php echo SA_PLUGIN_ASSETS_PATH . 'img/expand_more.svg' ?>"></span>
                    </div>

                    <div class="sa-section-body">
                        <?php sa_view( 'appointment-type._timeslot-details' ); ?>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>