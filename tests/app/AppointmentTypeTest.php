<?php

namespace Tests;

use SiddhiAppointments\App\AppointmentType;
use SiddhiAppointments\App\Exceptions\ValidationException;
use Tests\TestCase;

class AppointmentTypeTest extends TestCase
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

    private $notificationData = [
        'type' => 'admin_notification',
        'subject' => 'New appointment booked for Online Consultation',
        'body' => 'This is the email body. It can be very long text.',
        'to' => ['someone@example.com'],
        'cc' => ['admin@example.com'],
        'bcc' => [''],
        'active' => true
    ];

    protected function tearDown(): void
    {
        parent::tearDown();

        global $wpdb;
        $tableName = $wpdb->prefix . 'sa_inactive_appointments';
        $wpdb->query( "TRUNCATE TABLE $tableName" );
        $tableName = $wpdb->prefix . 'sa_appointment_types';
        $wpdb->query( "TRUNCATE TABLE $tableName" );
        $tableName = $wpdb->prefix . 'sa_appointment_notifications';
        $wpdb->query( "TRUNCATE TABLE $tableName" );
    }

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

        $appointmentTypeData = $this->appointmentTypeData;

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

    /** @test */
    public function update_throws_exception_if_appointment_type_does_not_exist()
    {
        $this->expectException(\Exception::class);

        // Perform update
        $appointmentType = new AppointmentType();
        $appointmentType->update( 81632, $this->appointmentTypeData );
    }

    /** @test */
    public function it_validates_before_updating()
    {
        $this->expectException(ValidationException::class);

        // Given an appointment type
        global $wpdb;
        $appointmentTypeData = $this->appointmentTypeData;
        $appointmentType = new AppointmentType();
        $appointmentTypeId = $appointmentType->create( $appointmentTypeData );

        $appointmentTypeData['basic_details']['name'] = '';

        // Perform update
        $appointmentType->update( $appointmentTypeId, $appointmentTypeData );
    }

    /** @test */
    public function it_updates_appointment_type()
    {
        // Given an appointment type
        global $wpdb;
        $appointmentTypeData = $this->appointmentTypeData;
        $appointmentType = new AppointmentType();
        $appointmentTypeId = $appointmentType->create( $appointmentTypeData );

        $appointmentTypeData['basic_details']['name'] = 'Online Consultation Updated';
        $appointmentTypeData['time_slots']['inactive_appointments'] = [
            'monday' => ['12:30'],
            'tuesday' => ['12:30'],
            'wednesday' => ['12:30'],
            'thursday' => ['12:30'],
            'friday' => ['12:30', '15:00', '15:30'],
            'saturday' => [],
            'sunday' => []
        ];
        $appointmentTypeData['customer_info']['fields']['name']['required'] = false;
        $appointmentTypeData['notifications']['admin_notification'] = $this->notificationData;

        // Perform update
        $appointmentType->update( $appointmentTypeId, $appointmentTypeData );

        $tableName = $wpdb->prefix . 'sa_appointment_types';
        $appointmentType = $wpdb->get_row(
            $wpdb->prepare( "SELECT * FROM $tableName WHERE id=%d", $appointmentTypeId ),
            'ARRAY_A'
        );
        $this->assertSame( 'Online Consultation Updated', $appointmentType['name'] );
        $this->assertSame( json_encode( $appointmentTypeData['customer_info']['fields'] ), $appointmentType['customer_info_fields'] );

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
        $this->assertEquals( 3, count( $fridayInactiveAppointments ) );

        $allInactiveAppointments = $wpdb->get_results(
            $wpdb->prepare( "SELECT * FROM $tableName WHERE appointment_type_id=%d", $appointmentTypeId ),
            'ARRAY_A'
        );
        $this->assertEquals( 7, count( $allInactiveAppointments ) );
        // Assert that the notifications are updated
        $tableName = $wpdb->prefix . 'sa_appointment_notifications';
        $adminNotification = $wpdb->get_row(
            $wpdb->prepare( "SELECT * FROM $tableName WHERE appointment_type_id=%d AND type=%s", $appointmentTypeId, 'admin_notification' ),
            'ARRAY_A'
        );

        $this->assertNotEmpty( $adminNotification );
        $this->assertSame( $this->notificationData['type'], $adminNotification['type'] );
        $this->assertSame( $this->notificationData['subject'], $adminNotification['subject'] );
        $this->assertSame( json_encode($this->notificationData['to']), $adminNotification['to'] );
    }

    /** @test */
    public function adding_notification_throws_exception_if_appointment_type_does_not_exist()
    {
        $this->expectException(\Exception::class);

        // Perform update
        $appointmentType = new AppointmentType();
        $appointmentType->add_or_update_notification( 81632, $this->notificationData );
    }

    /** @test */
    public function it_adds_or_updates_single_notification()
    {
        // Given an appointment type
        global $wpdb;
        $appointmentTypeData = $this->appointmentTypeData;
        $appointmentType = new AppointmentType();
        $appointmentTypeId = $appointmentType->create( $appointmentTypeData );

        // Perform update
        $appointmentType->add_or_update_notification( $appointmentTypeId, $this->notificationData );

        $tableName = $wpdb->prefix . 'sa_appointment_notifications';
        $adminNotification = $wpdb->get_row(
            $wpdb->prepare( "SELECT * FROM $tableName WHERE appointment_type_id=%d AND type=%s", $appointmentTypeId, 'admin_notification' ),
            'ARRAY_A'
        );

        $this->assertNotEmpty( $adminNotification );
        $this->assertSame( $this->notificationData['type'], $adminNotification['type'] );
        $this->assertSame( $this->notificationData['subject'], $adminNotification['subject'] );
        $this->assertSame( json_encode($this->notificationData['to']), $adminNotification['to'] );
    }

    /** @test */
    public function deleting_appointment_type_throws_exception_if_it_does_not_exist()
    {
        $this->expectException(\Exception::class);

        // Perform update
        $appointmentType = new AppointmentType();
        $appointmentType->delete( 81632 );
    }

    /** @test */
    public function it_deletes_the_appointment_type_and_all_its_data()
    {
        // Given an appointment type
        global $wpdb;
        $appointmentTypeData = $this->appointmentTypeData;
        $appointmentType = new AppointmentType();
        $appointmentTypeId = $appointmentType->create( $appointmentTypeData );

        $appointmentTypeData['basic_details']['name'] = 'Online Consultation Updated';
        $appointmentTypeData['notifications']['admin_notification'] = $this->notificationData;

        // Update to add the notifications
        $appointmentType->update( $appointmentTypeId, $appointmentTypeData );

        $appointmentType->delete( $appointmentTypeId );

        $tables = [
            $wpdb->prefix . 'sa_appointment_types',
            $wpdb->prefix . 'sa_inactive_appointments',
            $wpdb->prefix . 'sa_appointment_notifications'
        ];

        foreach ($tables as $table) {
            $column = ($table == $wpdb->prefix . 'sa_appointment_types') ? 'id' : 'appointment_type_id';
            $results = $wpdb->get_results(
                $wpdb->prepare( "SELECT * FROM $table WHERE $column=%d", $appointmentTypeId ),
                'ARRAY_A'
            );

            $this->assertEmpty( $results );
        }
    }

    /** @test */
    public function get_appointment_type_returns_null_if_it_does_not_exist()
    {
        $appointmentType = new AppointmentType();
        $appointmentType = $appointmentType->get( 87297391 );

        $this->assertNull( $appointmentType );
    }

    /** @test */
    public function it_retrieves_appointment_type_by_id()
    {
        // Given an appointment type
        global $wpdb;
        $appointmentTypeData = $this->appointmentTypeData;
        $appointmentType = new AppointmentType();
        $appointmentTypeId = $appointmentType->create( $appointmentTypeData );

        $appointmentTypeData['notifications']['admin_notification'] = $this->notificationData;
        // Update to add the notifications
        $appointmentType->update( $appointmentTypeId, $appointmentTypeData );

        $appointmentType = $appointmentType->get( $appointmentTypeId );

        $dataKeys = array_keys($appointmentType);
        $this->assertTrue( in_array('basic_details', $dataKeys) );
        $this->assertTrue( in_array('time_slots', $dataKeys) );
        $this->assertTrue( in_array('customer_info', $dataKeys) );
        $this->assertTrue( in_array('notifications', $dataKeys) );

        $weekDays = array_keys($appointmentType['time_slots']['inactive_appointments']);
        $this->assertSame(7, count($weekDays));

        $this->assertSame(
            $appointmentTypeData['time_slots']['inactive_appointments']['friday'],
            $appointmentType['time_slots']['inactive_appointments']['friday']
        );

        $this->assertSame( $appointmentTypeData['customer_info'], $appointmentType['customer_info']);
        $this->assertSame( '', $appointmentType['basic_details']['description'] );
    }

    /** @test */
    public function it_retrieves_appointment_types_list()
    {
        // Given an appointment type
        global $wpdb;
        $appointmentTypeData = $this->appointmentTypeData;
        $appointmentType = new AppointmentType();
        $appointmentTypeId = $appointmentType->create( $appointmentTypeData );
        $appointmentTypeData['basic_details']['name'] = 'In-Person Consultation';
        $appointmentTypeId = $appointmentType->create( $appointmentTypeData );

        $appointmentTypes = $appointmentType->get_all();

        $this->assertEquals( 2, count($appointmentTypes) );
        $this->assertSame( 'In-Person Consultation', $appointmentTypes[1]['name'] );
    }
}