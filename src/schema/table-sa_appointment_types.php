<?php

return '(
        `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(255) NOT NULL,
        `description` VARCHAR(255) NULL,
        `slot_duration` SMALLINT NOT NULL,
        `start_time` TIME NULL,
        `end_time` TIME NULL,
        `weekends` VARCHAR(20) NULL,
        `buffer_time_before` SMALLINT NOT NULL DEFAULT 0,
        `buffer_time_after` SMALLINT NOT NULL DEFAULT 0,
        `customer_info_fields` VARCHAR(1000) NULL,
        PRIMARY KEY (`id`)
    )';