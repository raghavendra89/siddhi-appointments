<?php
    // General settings: Timezone, Date & Time format, Business Name
    // Global holiday calendar
    // SMTP settings?
    // Google calendar
    // Payment
    // SMS - Twilio?
    
    $settings = [
        'General Settings' => 'Date, time and timezone settings',
        'Holiday Calender' => 'Setup business holidays',
        'Notifications' => 'Notification related settings',
        'Google Calender' => 'Google calendar integration'
    ];
?>

<div class="sa-appointments-wrapper">

    <div class="sa-page-title">
        <h3>Settings</h3>
    </div>

    <div class="sa-container">

        <div class="sa-row">
            <div class="sa-col-lg-8">
                <div class="sa-row">
                    <div class="sa-col-md-3 sa-col-sm-4">
                        <div class="sa-row sa-setting-sidebar">
                            <?php foreach ($settings as $setting => $description) { ?>
                                <div class="sa-col-12 sa-setting-menu <?php $setting == 'General Settings' ? _e( 'active' ) : ''; ?>"
                                    data-target="#sa-<?php _e( str_replace( ' ', '-', strtolower($setting) ) ) ?>">
                                    <h5><?php _e( $setting ) ?></h5>
                                    <p class="sa-pt-0"><?php _e( $description ) ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="sa-col-md-9 sa-col-sm-8">
                        <div class="sa-row sa-ps-3 sa-setting-sections">
                            <?php foreach ($settings as $setting => $description) { ?>
                                <div id="sa-<?php _e( str_replace( ' ', '-', strtolower($setting) ) ) ?>" class="sa-col-12 sa-setting-section <?php $setting == 'General Settings' ? _e( 'active' ) : ''; ?>">
                                    <h4 class="sa-pb-3"><?php _e( $setting ) ?></h4>

                                    <div class="sa-my-5 sa-py-5 sa-text-center">
                                        <?php _e( $setting ) ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="sa-row sa-mt-3">
                            <div class="sa-col-12 sa-text-end">
                                <button class="sa-btn sa-btn-secondary">cancel</button>
                                <button class="sa-btn">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>