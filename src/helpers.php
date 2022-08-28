<?php

use SiddhiAppointments\View;

/**
 * Helper function to render a view template.
 *
 * @param  string $page Template path except .php extension 
 * @return string
 */
function sa_view( $page ) {
    $page = str_replace( '.', DIRECTORY_SEPARATOR, $page) . '.php';

    $view = new View();

    return $view->render( $page );
}