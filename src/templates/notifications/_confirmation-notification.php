<?php

?>

<div class="sa-notification collapsed">
    <div class="sa-notification-header">
        <h4 class="sa-d-flex-center">
            Confirmation Notification

            <?php sa_view( 'components._notification-active-indicator' ); ?>
        </h4>

        <span><img src="<?php echo SA_PLUGIN_ASSETS_PATH . 'img/expand_more.svg' ?>"></span>
    </div>

    <div class="sa-notification-content">
        <div class="sa-notification-input-area">
            To: <input type="text" class="sa-notification-input" name="">
        </div>
        <div class="sa-notification-input-area">
            Cc: <input type="text" class="sa-notification-input" name="">
        </div>
        <div class="sa-notification-input-area">
            Bcc: <input type="text" class="sa-notification-input" name="">
        </div>
        <div class="sa-notification-input-area">
            Subject: <input type="text" class="sa-notification-input" name="">
        </div>

        <div class="sa-notification-body">
            <textarea class="sa-form-control" placeholder="Notification content"></textarea>
        </div>
    </div>

    <div class="sa-notification-footer">
        <?php sa_view( 'components._notification-switch' ); ?>

        <button class="sa-btn sa-float-end">Save</button>
    </div>
</div>