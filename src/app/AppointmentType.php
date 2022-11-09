<?php

namespace SiddhiAppointments\App;

use SiddhiAppointments\App\Exceptions\ValidationException;
use SiddhiAppointments\App\Helpers\Validator;
use SiddhiAppointments\DB;

class AppointmentType
{
    private $tableName;
    private $validator;

    function __construct()
    {
        $this->tableName = 'sa_appointment_types';

        $this->validator = new Validator();
    }

    private $rules = [
        'basic_details.name' => 'required|string|max:255',
        'time_slots.slot_duration' => 'required|int',
        'time_slots.start_time' => 'required|regex:([0-1]\d|2[0-3]):[0-5]\d$',
        'time_slots.end_time' => 'regex:([0-1]\d|2[0-3]):[0-5]\d$',
        'time_slots.buffer_time_before' => 'int|regex:^[1-5]?[05]$',
        'time_slots.buffer_time_after' => 'int|regex:^[1-5]?[05]$',
        'customer_info.fields' => 'required|array',
    ];

    private function validate( array $appointmentTypeData )
    {
        $this->validator->validate( $appointmentTypeData, $this->rules );
    }

    private function getAppointmentTypeData( array $appointmentTypeData )
    {
        return [
            'name' => $appointmentTypeData['basic_details']['name'],
            'description' => $appointmentTypeData['basic_details']['description'] ?? '',
            'slot_duration' => $appointmentTypeData['time_slots']['slot_duration'],
            'start_time' => $appointmentTypeData['time_slots']['start_time'],
            'end_time' => $appointmentTypeData['time_slots']['end_time'] ?? NULL,
            'weekends' => $appointmentTypeData['time_slots']['weekends'] ?? '',
            'buffer_time_before' => $appointmentTypeData['time_slots']['buffer_time_before'] ?? 0,
            'buffer_time_after' => $appointmentTypeData['time_slots']['buffer_time_after'] ?? 0,
            'customer_info_fields' => json_encode( $appointmentTypeData['customer_info']['fields'] )
        ];
    }

    /**
     * Create new appointment type.
     *
     * @param  array $appointmentTypeData
     * @return int Newly created appointment type id.
     */
    public function create( array $appointmentTypeData )
    {
        $this->validate( $appointmentTypeData );

        $data = $this->getAppointmentTypeData( $appointmentTypeData );

        $appointmentTypeId = DB::table($this->tableName)->create( $data, ['%s', '%s', '%d', '%s', '%s', '%s', '%d', '%d', '%s'] );

        if ( is_int( $appointmentTypeId ) ) {
            $inactiveAppointments = $appointmentTypeData['time_slots']['inactive_appointments'] ?? [];
            // Inactive Appointments
            $this->add_inactive_appointments( $appointmentTypeId, $inactiveAppointments );
        }

        return $appointmentTypeId;
    }

    /**
     * Update the appointment type.
     *
     * @param  int $appointmentTypeId
     * @param  array $appointmentTypeData
     * @throws \Exception
     * @throws \ValidationException
     * @return void
     */
    public function update( int $appointmentTypeId, array $appointmentTypeData )
    {
        $appointmentType = DB::table($this->tableName)->find( $appointmentTypeId );
        if ( empty( $appointmentType ) ) {
            throw new \Exception( 'The appointment type does not exist.' );
        }

        $this->validate( $appointmentTypeData );

        $data = $this->getAppointmentTypeData( $appointmentTypeData );

        $where = [ 'id' => $appointmentTypeId ];
        $dataFormat = ['%s', '%s', '%d', '%s', '%s', '%s', '%d', '%d', '%s'];
        $whereFormat = ['%d'];

        $appointmentTypeId = DB::table($this->tableName)->update( $data, $where, $dataFormat, $whereFormat );

        DB::table('sa_inactive_appointments')->deleteWhere( ['appointment_type_id' => $appointmentTypeId] );

        $inactiveAppointments = $appointmentTypeData['time_slots']['inactive_appointments'] ?? [];
        // Inactive Appointments
        $this->add_inactive_appointments( $appointmentTypeId, $inactiveAppointments );

        foreach ( $appointmentTypeData['notifications'] as $notificationData ) {
            $this->_addOrUpdateNotification( $appointmentTypeId, $notificationData );
        }
    }

    /**
     * Adds inactive appointments for the given appointment type.
     *
     * @param int $appointmentTypeId
     * @param array $inactiveAppointments
     */
    private function add_inactive_appointments( int $appointmentTypeId, array $inactiveAppointments )
    {
        $weekdays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        global $wpdb;
        $tableName = $wpdb->prefix . 'sa_inactive_appointments';

        $weekdayCount = 1;
        $query = "INSERT INTO $tableName (appointment_type_id, start_time, week_day) VALUES ";
        $values = [];
        $placeHolders = [];
        $hasInactiveAppointments = false;
        foreach ( $weekdays as $weekday ) {
            if ( in_array( $weekday, array_keys( $inactiveAppointments ) ) ) {
                foreach ( $inactiveAppointments[$weekday] as $startTime ) {
                    $placeHolders[] .= "('%d', '%s', '%d')";
                    $values[] = $appointmentTypeId;
                    $values[] = $startTime;
                    $values[] = $weekdayCount;
                    $hasInactiveAppointments = true;
                }
            }
            $weekdayCount++;
        }

        if ( $hasInactiveAppointments ) {
            $query .= implode( ', ', $placeHolders );
            (new DB)->query( $query, $values );
        }
    }

    private function _addOrUpdateNotification( int $appointmentTypeId, array $notificationData )
    {
        $to = is_array( $notificationData['to'] ) ? $notificationData['to'] : [$notificationData['to']];
        $cc = is_array( $notificationData['cc'] ) ? $notificationData['cc'] : [$notificationData['cc']];
        $bcc = is_array( $notificationData['bcc'] ) ? $notificationData['bcc'] : [$notificationData['bcc']];

        $type = $notificationData['type'];

        $data = [
            'subject' => $notificationData['subject'],
            'body' => $notificationData['body'],
            'to' => json_encode($to),
            'cc' => json_encode($cc),
            'bcc' => json_encode($bcc),
            'active' => $notificationData['active'] ? 1 : 0
        ];

        $tableName = 'sa_appointment_notifications';
        $where = ['appointment_type_id' => $appointmentTypeId, 'type' => $type];
        $dataFormat = ['%s', '%s', '%s', '%s', '%s', '%d'];
        $whereFormat = ['%d', '%s'];
        $updateCount = DB::table($tableName)->update( $data, $where, $dataFormat, $whereFormat );

        if ( $updateCount === 0 ) {
            $data['appointment_type_id'] = $appointmentTypeId;
            $data['type'] = $type;
            $dataFormat[] = '%d';
            $dataFormat[] = '%s';
            // The notification doesn't exist, create it
            $notificationId = DB::table($tableName)->create( $data, $dataFormat );
        }
    }

    /**
     * Add or update individual notifications.
     *
     * @param int $appointmentTypeId
     * @param array $notificationData
     * @throws \Exception
     * @return void
     */
    public function addOrUpdateNotification( int $appointmentTypeId, array $notificationData )
    {
        $appointmentType = DB::table($this->tableName)->find( $appointmentTypeId );
        if ( empty( $appointmentType ) ) {
            throw new \Exception( 'The appointment type does not exist.' );
        }

        $this->_addOrUpdateNotification( $appointmentTypeId, $notificationData );
    }
}