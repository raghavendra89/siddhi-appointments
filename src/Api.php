<?php

namespace SiddhiAppointments;

use SiddhiAppointments\App\Controllers\AppointmentTypeController;

class Api
{
    const NAMESPACE = 'siddhi-appointments/v1';
    const GET_METHOD = \WP_REST_Server::READABLE;
    const POST_METHOD = \WP_REST_Server::CREATABLE;
    const DELETE_METHOD = \WP_REST_Server::DELETABLE;

    public static function register_rest_routes()
    {
        $namespace = self::NAMESPACE;

        $controller = new AppointmentTypeController();

        register_rest_route( $namespace, '/appointment-types', array(
            array(
                'methods'         => self::GET_METHOD,
                'callback'        => array( $controller, 'get_items' ),
                'permission_callback' => array( $controller, 'authorize_get_items' ),
                // 'args'            => $controller->get_collection_params(),
            ),
        ) );

        register_rest_route( $namespace, '/appointment-types', array(
            array(
                'methods'         => self::POST_METHOD,
                'callback'        => array( $controller, 'create_item' ),
                'permission_callback' => array( $controller, 'authorize_create_item' ),
                // 'args'            => $controller->get_collection_params(),
            ),
        ) );

        register_rest_route( $namespace, '/appointment-types/(?P<appointment_type_id>[\d]+)', array(
            array(
                'methods'             => self::GET_METHOD,
                'callback'            => array( $controller, 'get_item' ),
                'permission_callback' => array( $controller, 'authorize_get_item' ),
                'args'                => array(),
            ),
            array(
                'methods'             => self::POST_METHOD,
                'callback'            => array( $controller, 'update_item' ),
                'permission_callback' => array( $controller, 'authorize_update_item' ),
                // 'args'                => $controller->get_endpoint_args_for_item_schema( false ),
            ),
            array(
                'methods'             => self::DELETE_METHOD,
                'callback'            => array( $controller, 'delete_item' ),
                'permission_callback' => array( $controller, 'authorize_delete_item' ),
                'args'                => array(),
            ),
        ) );
    }
}