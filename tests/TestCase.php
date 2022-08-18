<?php

namespace Tests;

use \PHPUnit\Framework\TestCase as BaseTestCase;

require_once __DIR__ . '/../src/constants.php';

class TestCase extends BaseTestCase
{
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
}