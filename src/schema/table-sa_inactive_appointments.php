<?php

return '(
        `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
        `appointment_type_id` MEDIUMINT UNSIGNED NOT NULL,
        `start_time` TIME NULL,
        `week_day` TINYINT(1) NULL,
        PRIMARY KEY (`id`),
        KEY appointment_type_id (appointment_type_id)
    )';