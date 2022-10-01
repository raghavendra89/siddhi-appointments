<?php

use SiddhiAppointments\View;

/**
 * Helper function to render a view template.
 *
 * @param  string $page Template path except .php extension 
 * @param boolean $echo Whether to echo the content or return as string
 * @return string
 */
function sa_view( $page, $echo = true ) {
    $page = str_replace( '.', DIRECTORY_SEPARATOR, $page) . '.php';

    $view = new View();

    return $view->render( $page, $echo );
}