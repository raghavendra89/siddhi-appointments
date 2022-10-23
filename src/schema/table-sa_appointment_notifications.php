<?php

return '(
        `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
        `appointment_type_id` MEDIUMINT UNSIGNED NOT NULL,
        `notification_name` VARCHAR(255) NULL,
        `subject` VARCHAR(500) NULL,
        `body` TEXT(5000) NULL,
        `to` VARCHAR(500) NULL,
        `cc` VARCHAR(500) NULL,
        `bcc` VARCHAR(500) NULL,
        `active` TINYINT(1) NOT NULL DEFAULT 1,
        PRIMARY KEY (`id`),
        KEY appointment_type_id (appointment_type_id)
    )';