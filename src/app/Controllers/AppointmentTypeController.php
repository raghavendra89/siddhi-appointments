<?php

namespace SiddhiAppointments\App\Controllers;

use SiddhiAppointments\App\AppointmentType;

class AppointmentTypeController
{
    public function authorize_create_item()
    {
        if ( current_user_can( 'administrator' ) ) {
            return true;
        }

        return false;
    }

    public function create_item($request)
    {
        $data = $request->get_json_params();

        $appointmentType = (new AppointmentType);
        $appointment_type_id = $appointmentType->create( $data );

        $appointment_type_data = [];
        if ( is_int( $appointment_type_id ) ) {
            $appointment_type_data = $appointmentType->get( $appointment_type_id );
        }

        $response = new \WP_REST_Response( $appointment_type_data, 201 );

        return rest_ensure_response( $response );
    }

    public function get_items()
    {
        // code...
    }
    public function get_item($request){die('Parameter: ' . $request->get_param( 'appointment_type_id' ));}
    public function update_item(){}
    public function delete_item(){}
    public function authorize_get_items(){return true;}
    public function authorize_get_item(){return true;}
    public function authorize_update_item(){return true;}
    public function authorize_delete_item(){return true;}
}