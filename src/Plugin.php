<?php

namespace SiddhiAppointments;

class Plugin
{
    private $installer;
    private $admin_menu;

    function __construct( $installer = null, $admin_menu = null ) {
        if ( empty( $installer ) ) {
            $installer = new Installer;
        }
        if ( empty( $admin_menu ) ) {
            $admin_menu = new AdminMenu;
        }

        $this->installer = $installer;
        $this->admin_menu = $admin_menu;
    }

    /**
     * Handle plugin activation.
     *
     * @return void
     */
    public function activate() {
        $this->installer->install();
    }

    /**
     * Initiates the Siddhi Appointments plugin
     *
     * @return void
     */
    public function init() {
        $this->admin_menu->create_menu();
    }
}