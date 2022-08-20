<?php

namespace Tests;

use Tests\TestCase;
use SiddhiAppointments\View;

class ViewTest extends TestCase
{
    /** @test */
    public function it_renders_the_appointments_page()
    {
        $view = new View();

        $view->render_appointments_page();

        $this->expectOutputRegex( '/' . __( 'Siddhi Appointments', 'sa_appointments' ) . '/' );
    }
}