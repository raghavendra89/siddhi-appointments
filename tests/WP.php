<?php

namespace Tests;

/**
 * Test class for overriding the WP wrapper class.
 */
class WP
{
    public function do_action( ...$args ) {}
    public function add_action( ...$args ) {}
    public function add_menu_page( ...$args ) {}
    public function add_submenu_page( ...$args ) {}
    public function apply_filters( ...$args ) {}
}