<?php

namespace Tests;

use Tests\TestCase;
use SiddhiAppointments\AdminMenu;

class AdminMenuTest extends TestCase
{
    /** @test */
    public function it_creates_admin_menu()
    {
        // Assert that do_action is fired
        global $sa_appointments_wp;
        $sa_appointments_wp->expects( $this->once() )
                           ->method( 'add_menu_page' )
                           ->with( __( 'Siddhi Appointments', 'sa_appointments' ) );

        $sa_appointments_wp->expects( $this->once() )
                           ->method( 'apply_filters' )
                           ->with( 'sa_appointments_menu_position' );

        $admin_menu = new AdminMenu();

        $admin_menu->create_menu();
    }
}