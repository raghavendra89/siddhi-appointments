<?php

namespace SiddhiAppointments;

/**
 * Wrapper class for important wordpress functions.
 */
class WP
{
    public function do_action( $action, ...$args ) {
        do_action( $action, ...$args );
    }

    public function add_action( ...$args ) {
        add_action( ...$args );
    }

    public function apply_filters( ...$args ) {
        return apply_filters( ...$args );
    }

    public function add_menu_page( ...$args ) {
        add_menu_page( ...$args );
    }
}