<?php

namespace Tests;

trait MakeRequest
{
    public function ajaxPost( string $path, array $data, array $headers = [] )
    {
        $request = new \WP_REST_Request( 'POST', $path );
        $request->set_body( json_encode( $data ) );

        $request->set_header( 'content-type', 'application/json' );
        foreach ( $headers as $key => $value ) {
            $request->set_header( $key, $value );
        }

        return rest_do_request( $request );
    }
}