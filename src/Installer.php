<?php

namespace SiddhiAppointments;

class Installer
{
    private $db;

    function __construct( $db = null ) {
        if ( empty( $db ) ) {
            $db = new DB;
        }

        $this->db = $db;
    }

    /**
     * Installs the plugin.
     *
     * @return bool
     */
    public function install() {
        if ( $this->already_installed() ) {
            return false;
        }

        $this->db->run_schema();

        update_option( 'sa_appointments_version', SA_VERSION, false );

        /**
         * Fires after SA Appointments is fully installed.
         *
         * @param int $version The new $version.
         */
        do_action( 'sa_appointments_post_install', SA_VERSION );

        return true;
    }

    /**
     * Check if the plugin is already installed.
     *
     * @return bool
     */
    private function already_installed() {
        return ! empty( get_option( 'sa_appointments_version', false ) );
    }
}