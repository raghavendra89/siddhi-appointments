<?php

namespace Tests;

use Tests\TestCase;
use SiddhiAppointments\AdminMenu;

class AdminMenuTest extends TestCase
{
    /** @test */
    public function it_creates_admin_menu()
    {
        // Assert that add_menu_page is called
        global $sa_appointments_wp;
        $sa_appointments_wp->expects( $this->once() )
                           ->method( 'add_menu_page' )
                           ->with( __( 'Siddhi Appointments', 'sa_appointments' ) );

        $sa_appointments_wp->expects( $this->once() )
                           ->method( 'apply_filters' )
                           ->with( 'sa_appointments_menu_position' );

        $sa_appointments_wp->expects( $this->exactly(2) )
                           ->method( 'add_submenu_page' )
                           ->withConsecutive(
                                ['sa-appointments', __( 'Appointment Types', 'sa_appointments' ), __( 'Appointment Types', 'sa_appointments' )],
                                ['sa-appointments', __( 'Settings', 'sa_appointments' ), __( 'Settings', 'sa_appointments' )]
                            );

        $admin_menu = new AdminMenu();

        $admin_menu->create_menu();
    }
}