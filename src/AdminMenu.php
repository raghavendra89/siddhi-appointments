<?php

namespace SiddhiAppointments;

class AdminMenu
{
    public function create_menu() {
        global $sa_appointments_wp;

        $menu_slug = 'sa-appointments';

        $callback = [ new View(), 'render_appointments_page' ];
        $sa_appointments_wp->add_menu_page(
            __( 'Siddhi Appointments', 'sa_appointments' ),
            __( 'Siddhi Appointments', 'sa_appointments' ),
            'administrator',
            $menu_slug,
            $callback,
            'dashicons-calendar-alt',
            $sa_appointments_wp->apply_filters( 'sa_appointments_menu_position', 21 )
        );

        $callback = [ new View(), 'render_appointment_types_page' ];
        $sa_appointments_wp->add_submenu_page(
            $menu_slug,
            __( 'Appointment Types', 'sa_appointments' ),
            __( 'Appointment Types', 'sa_appointments' ),
            'administrator',
            'sa-appointment-types',
            $callback
        );

        $callback = [ new View(), 'render_settings_page' ];
        $sa_appointments_wp->add_submenu_page(
            $menu_slug,
            __( 'Settings', 'sa_appointments' ),
            __( 'Settings', 'sa_appointments' ),
            'administrator',
            'sa-settings',
            $callback
        );
    }

    public function test()
    {
        echo '<h3>Siddhi Appointments</h3>';
    }
}