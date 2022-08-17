<?php

namespace SiddhiAppointments;

class Plugin
{
    private $installer;

    function __construct( $installer = null ) {
        if ( empty( $installer ) ) {
            $installer = new Installer;
        }

        $this->installer = $installer;
    }

    /**
     * Handle plugin activation.
     *
     * @return void
     */
    public function activate() {
        $this->installer->install();
    }
}