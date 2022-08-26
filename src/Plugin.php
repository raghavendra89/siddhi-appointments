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

        $this->register_admin_styles();

        if ( is_admin() ) {
            global $sa_appointments_wp;

            $sa_appointments_wp->add_action( 'admin_enqueue_scripts', [$this, 'enqueue_admin_scripts'] );
        }
    }

    private function register_admin_styles() {
        $version = SA_VERSION;
        $min = '';

        if ( is_admin() ) {
            wp_register_style( 'sa_appointments_layout', SA_PLUGIN_ASSETS_PATH . "css/layout{$min}.css", array(), $version );
            wp_register_style( 'sa_appointments_admin', SA_PLUGIN_ASSETS_PATH . "css/admin{$min}.css", array(), $version );

            wp_register_script( 'sa_appointments_base', SA_PLUGIN_ASSETS_PATH . "js/base{$min}.js", array(), $version );
        }
    }

    public function enqueue_admin_scripts() {
        wp_enqueue_style( 'sa_appointments_layout' );
        wp_enqueue_style( 'sa_appointments_admin' );

        wp_enqueue_script( 'sa_appointments_base' );
    }
}