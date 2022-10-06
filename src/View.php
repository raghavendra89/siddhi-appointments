<?php

namespace SiddhiAppointments;

class View
{
    /**
     * Defines the teplate pages used by the plugin
     *
     * @var array $defined_views Template files list.
     */
    private $defined_views = [
        'appointment_types_page' => 'appointments-page.php',
        'add_edit_appointment_type_page' => 'add-edit-appointment-type.php',
        'single_appointment_page' => 'single-appointment.php',
        'appointments_page' => 'appointments-list.php',
        'settings_page' => 'appointments-list.php'
    ];

    /**
     * Magic method to implement common view rendering functions.
     */
    public function __call( $name, $args ) {
        $page = str_replace( 'render_', '', $name);
        if ( $page == 'appointments_page' && ! empty( $_GET['id'] ) ) {
            $page = 'single_appointment_page';
        }
        if ( $page == 'appointment_types_page' && ! empty( $_GET['id'] ) ) {
            $page = 'add_edit_appointment_type_page';
        }

        if ( ! in_array( $page, array_keys( $this->defined_views ) ) ) {
            return '';
        }

        return $this->render( $this->defined_views[ $page ] );
    }

    /**
     * Common view rendering function.
     *
     * @param string $page Page key, specified which template to render.
     * @param boolean $echo Whether to echo the content or return as string
     * @return string
     */
    public function render( $page, $echo = true ) {
        // TODO: Should we provide the option to override the templates?
        $page_template = SA_PLUGIN_PATH . 'src/templates/' . $page;

        if ( ! file_exists( $page_template ) ) {
            return '';
        }

        ob_start();
        require $page_template;

        if ( ! $echo ) {
            return ob_get_clean();
        }

        echo ob_get_clean();
    }
}