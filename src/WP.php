<?php

namespace SiddhiAppointments;

/**
 * Wrapper class for important wordpress functions.
 */
class WP
{
    public function do_action( $action, ...$args ) {
        do_action( $action, $args );
    }
}