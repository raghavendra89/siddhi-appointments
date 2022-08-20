<?php

namespace SiddhiAppointments;

class AdminMenu
{
    public function create_menu() {
        global $sa_appointments_wp;

        $callback = [ new View(), 'render_appointments_page' ];

        $sa_appointments_wp->add_menu_page(
            __( 'Siddhi Appointments', 'sa_appointments' ),
            __( 'Siddhi Appointments', 'sa_appointments' ),
            'administrator',
            'sa-appointments',
            $callback,
            'dashicons-calendar-alt',
            $sa_appointments_wp->apply_filters( 'sa_appointments_menu_position', 21 )
        );
    }

    public function test()
    {
        echo '<h3>Siddhi Appointments</h3>';
    }
}