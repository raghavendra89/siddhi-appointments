<?php

?>

<div class="sa-notification collapsed">
    <div class="sa-notification-header">
        <h4 class="sa-d-flex-center">
            Reminder Notification

            <?php sa_view( 'components._notification-active-indicator' ); ?>
        </h4>

        <span><?php sa_view( 'icons._expand_more' ); ?></span>
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