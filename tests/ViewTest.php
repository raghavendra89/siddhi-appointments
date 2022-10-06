<?php

namespace Tests;

use Tests\TestCase;
use SiddhiAppointments\View;

class ViewTest extends TestCase
{
    /** @test */
    public function it_renders_the_appointments_page()
    {
        global $hook_suffix;
        $hook_suffix = 'toplevel_page_sa-appointments';
        $_SERVER['HTTP_HOST'] = $_SERVER['REQUEST_URI'] = '';

        $view = new View();

        $view->render_appointments_page();

        $this->expectOutputRegex( '/' . __( 'Appointments', 'sa_appointments' ) . '/' );
    }
}