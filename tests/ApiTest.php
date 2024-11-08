<?php

namespace Tests;

use Tests\TestCase;
use SiddhiAppointments\Api;

class ApiTest extends TestCase
{
    /** @test */
    public function it_registers_rest_routes()
    {
        // The register_rest_routes is called as soon as the the plugin is
        // initiated, so no need to call the function. Just assert.
        // Api::register_rest_routes();
        $this->assertTrue(in_array('siddhi-appointments/v1', rest_get_server()->get_namespaces()));
    }
}