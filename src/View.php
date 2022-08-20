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
        'appointments_page' => 'appointments-page.php'
    ];

    /**
     * Magic method to implement common view rendering functions.
     */
    public function __call( $name, $args ) {
        return $this->render( $name );
    }

    /**
     * Common view rendering function.
     *
     * @param string $page Page key, specified which template to render.
     * @return string
     */
    private function render( $page ) {
        $page = str_replace( 'render_', '', $page);
        if ( ! in_array( $page, array_keys( $this->defined_views ) ) ) {
            return '';
        }

        // TODO: Should we provide the option to override the templates?
        $page_template = SA_PLUGIN_PATH . 'src/templates/' . $this->defined_views[ $page ];

        ob_start();
        require $page_template;
        echo ob_get_clean();
    }
}