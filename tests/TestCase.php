<?php

namespace Tests;

use \PHPUnit\Framework\TestCase as BaseTestCase;

require_once __DIR__ . '/../src/constants.php';

class TestCase extends BaseTestCase
{
    use DbAssertions, MakeRequest;

    function __construct()
    {
        parent::__construct();

        global $sa_appointments_wp;

        $wp = $this->getMockBuilder( WP::class )
                   ->setMethodsExcept([])
                   ->getMock();

        // Overriding the global WP wrapper class, so it can be tested.s
        $sa_appointments_wp = $wp;
    }

    /**
     * Sets the current_screen as admin screen,
     * so is_admin() function returns TRUE.
     */
    public function setAsAdminScreen()
    {
        global $current_screen;

        $current_screen = $this->getMockBuilder('CurrentScreen')
                               ->setMethods(['in_admin'])
                               ->getMock();

        $current_screen->method('in_admin')
                       ->willReturn(true);
    }
}