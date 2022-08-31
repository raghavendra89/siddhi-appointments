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
        // 'appointments_page' => 'appointments-page.php',
        'appointments_page' => 'add-edit-appointment-type.php'
    ];

    /**
     * Magic method to implement common view rendering functions.
     */
    public function __call( $name, $args ) {
        $page = str_replace( 'render_', '', $name);
        if ( ! in_array( $page, array_keys( $this->defined_views ) ) ) {
            return '';
        }

        return $this->render( $this->defined_views[ $page ] );
    }

    /**
     * Common view rendering function.
     *
     * @param string $page Page key, specified which template to render.
     * @return string
     */
    public function render( $page ) {
        // TODO: Should we provide the option to override the templates?
        $page_template = SA_PLUGIN_PATH . 'src/templates/' . $page;

        if ( ! file_exists( $page_template ) ) {
            return '';
        }

        ob_start();
        require $page_template;
        echo ob_get_clean();
    }
}