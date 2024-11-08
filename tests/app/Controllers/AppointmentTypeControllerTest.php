<?php

namespace Tests\App\Controllers;

use Tests\TestCase;

class AppointmentTypeControllerTest extends TestCase
{
    private $appointmentTypeData = [
        'basic_details' => [
            'name' => 'Online Consultation'
        ],
        'time_slots' => [
            'slot_duration' => 30,
            'start_time' => '08:00',
            'end_time' => '17:30',
            'weekends' => [6, 7],
            'buffer_time_after' => 10,
            'inactive_appointments' => [
                'monday' => ['12:00', '12:30'],
                'tuesday' => ['12:00', '12:30'],
                'wednesday' => ['12:00', '12:30'],
                'thursday' => ['12:00', '12:30'],
                'friday' => ['12:00', '12:30', '15:00', '15:30', '16:00', '16:30', '17:00']
            ]
        ],
        'customer_info' => [
            'fields' => [
                'name' => [
                    'show' => true,
                    'required' => true
                ],
                'email_address' => [
                    'show' => true,
                    'required' => true
                ]
            ]
        ]
    ];

    /** @test */
    public function only_admins_can_create_appointment_types()
    {
        // When you make a post request
        $request = new \WP_REST_Request( 'POST', '/siddhi-appointments/v1/appointment-types', ['POST' => $this->appointmentTypeData] );
        $request->set_param( 'POST', $this->appointmentTypeData );
        $responseData = rest_do_request( $request )->get_data();

        $this->assertSame(401, $responseData['data']['status']);
        $this->assertSame('rest_forbidden', $responseData['code']);
    }

    /** @test */
    public function admins_can_create_appointment_types()
    {
        wp_set_current_user(1);
        // When you make a post request
        $response = $this->ajaxPost(
            '/siddhi-appointments/v1/appointment-types',
            $this->appointmentTypeData,
            [
                'X-WP-Nonce' => wp_create_nonce('wp_rest')
            ]
        );

        $this->assertSame(201, $response->get_status());
        $this->assertDatabaseHas( 'sa_appointment_types', [
            'name' => $this->appointmentTypeData['basic_details']['name'],
            'slot_duration' => $this->appointmentTypeData['time_slots']['slot_duration'],
            'customer_info_fields' => json_encode($this->appointmentTypeData['customer_info']['fields'])
        ] );
        // $this->assertSame('rest_forbidden', $responseData['code']);
    }
}