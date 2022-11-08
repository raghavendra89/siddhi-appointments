<?php

namespace Tests;

use SiddhiAppointments\App\AppointmentType;
use SiddhiAppointments\App\Exceptions\ValidationException;
use Tests\TestCase;

class AppointmentTypeTest extends TestCase
{
    /** @test */
    public function it_throws_validation_exception()
    {
        $this->expectException( ValidationException::class );

        $appointmentTypeData = [];

        $appointmentType = new AppointmentType();
        $appointmentType->create( $appointmentTypeData );
    }

    /** @test */
    public function it_validates_appointment_type_data()
    {
        $appointmentTypeData = [
            'time_slots' => [
                'start_time' => 20
            ]
        ];

        $appointmentType = new AppointmentType();

        try {
            $appointmentType->create( $appointmentTypeData );
        } catch ( ValidationException $e ) {
            $errors = [
                'basic_details' => [
                    'name' => 'This field is required.'
                ],
                'time_slots' => [
                    'start_time' => 'The value does not match the regex pattern.'
                ]
            ];

            $this->assertSame( $errors['basic_details'], $e->errors()['basic_details'] );
            $this->assertSame( $errors['time_slots']['start_time'], $e->errors()['time_slots']['start_time'] );
        }
    }

    /** @test */
    public function it_adds_new_appointment_type()
    {
        global $wpdb;

        $appointmentTypeData = [
            'basic_details' => [
                'name' => 'Online Consultation'
            ],
            'time_slots' => [
                'slot_duration' => 30,
                'start_time' => '08:00',
                'end_time' => '17:30',
                'buffer_time_after' => 10
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

        $appointmentType = new AppointmentType();
        $appointmentTypeId = $appointmentType->create( $appointmentTypeData );

        $this->assertTrue( is_int( $appointmentTypeId ) );

        // Assert that the DB has new Appointment Type
        $tableName = $wpdb->prefix . 'sa_appointment_types';
        $appointmentType = $wpdb->get_results(
            $wpdb->prepare( "SELECT * FROM $tableName WHERE id=%d", $appointmentTypeId )
        )[0];

        $this->assertSame( $appointmentTypeData['basic_details']['name'], $appointmentType->name );
        $this->assertSame( $appointmentTypeData['time_slots']['slot_duration'], (int) $appointmentType->slot_duration );
        $this->assertSame( $appointmentTypeData['customer_info']['fields'], json_decode( $appointmentType->customer_info_fields, true ) );

        // Clear data
        $wpdb->delete( $tableName, ['id' => $appointmentTypeId] );
    }

    /** @test */
    public function inactive_appointments_are_saved_while_adding_appointment()
    {
        global $wpdb;

        $appointmentTypeData = [
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

        $appointmentType = new AppointmentType();
        $appointmentTypeId = $appointmentType->create( $appointmentTypeData );

        $this->assertTrue( is_int( $appointmentTypeId ) );

        // Assert that the DB has inactive appointments
        $tableName = $wpdb->prefix . 'sa_inactive_appointments';
        $inactiveAppointments = $wpdb->get_results(
            $wpdb->prepare( "SELECT * FROM $tableName WHERE appointment_type_id=%d AND week_day=%d", $appointmentTypeId, 5 ),
            'ARRAY_A'
        );

        $fridayInactiveAppointments = array_column( $inactiveAppointments, 'start_time' );
        // Remove seconds in the time string. i.e. convert 12:00:00 to 12:00
        $fridayInactiveAppointments = array_map(function ($time) { return substr($time, 0, -3); }, $fridayInactiveAppointments);

        $this->assertEmpty( array_diff( $appointmentTypeData['time_slots']['inactive_appointments']['friday'], $fridayInactiveAppointments ) );
        $this->assertEquals( 7, count( $fridayInactiveAppointments ) );

        // Clear data
        $tableName = $wpdb->prefix . 'sa_inactive_appointments';
        $wpdb->delete( $tableName, ['appointment_type_id' => $appointmentTypeId] );
        $tableName = $wpdb->prefix . 'sa_appointment_types';
        $wpdb->delete( $tableName, ['id' => $appointmentTypeId] );
    }
}