<?php

namespace SiddhiAppointments;

if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class AppointmentsListTable extends \WP_List_Table
{
    function __construct()
    {
        parent::__construct();

        $this->set_columns();
    }

    public function set_columns() {
        $columns               = $this->get_columns();
        $this->_column_headers = array( $columns, [], [], '' );
    }

    public function get_columns()
    {
        return [
            'cb' => '<input class="sa-form-check-input" type="checkbox" />',
            'appointment_type' => __( 'Appointment Type', 'sa_appointments' ),
            'customer_name' => __( 'Customer Name', 'sa_appointments' ),
            'email_address' => __( 'Email Address', 'sa_appointments' ),
            'phone_number' => __( 'Phone Number', 'sa_appointments' ),
            'appointment_date' => __( 'Appointment Date', 'sa_appointments' ),
            'appointment_timeslot' => __( 'Appointment Timeslot', 'sa_appointments' ),
            'status' => __( 'Status', 'sa_appointments' ),
            'actions' => __( 'Actions', 'sa_appointments' )
        ];
    }

    public function no_items()
    {
        _e( 'No Appointments', 'sa_appointments' );
    }

    public function prepare_items()
    {
        $this->items = [
            [
                'cb' => '<input type="checkbox" />',
                'appointment_type' => '30 mins health consultation',
                'customer_name' => 'Sara Graham',
                'email_address' => 'sara@gmail.com',
                'phone_number' => '999-999-9999',
                'appointment_date' => '12-03-2022',
                'appointment_timeslot' => '08:00AM - 08:30AM',
                'status' => 'Pending',
                'actions' => __( 'Actions', 'sa_appointments' )
            ],
            [
                'cb' => '<input type="checkbox" />',
                'appointment_type' => '30 mins health consultation',
                'customer_name' => 'Sara Graham',
                'email_address' => 'sara@gmail.com',
                'phone_number' => '999-999-9999',
                'appointment_date' => '12-03-2022',
                'appointment_timeslot' => '08:00AM - 08:30AM',
                'status' => 'Confirmed',
                'actions' => __( 'Actions', 'sa_appointments' )
            ],
            [
                'cb' => '<input type="checkbox" />',
                'appointment_type' => '30 mins health consultation',
                'customer_name' => 'Sara Graham',
                'email_address' => 'sara@gmail.com',
                'phone_number' => '999-999-9999',
                'appointment_date' => '12-03-2022',
                'appointment_timeslot' => '08:00AM - 08:30AM',
                'status' => 'Cancelled',
                'actions' => __( 'Actions', 'sa_appointments' )
            ]
        ];

        for ($i=0; $i < 2; $i++) { 
            foreach ($this->items as $item) {
                $this->items[] = $item;
            }
        }

        $this->set_pagination_args([
            'total_items' => 100,
            'per_page' => 20,
            'total_pages' => 5
        ]);
    }

    public function column_default( $item, $column_name )
    {
        return $item[$column_name];
    }

    public function column_cb( $item )
    {
        return '<input class="sa-form-check-input" type="checkbox" />';
    }

    /**
     * Appointment actions dropdown.
     *
     * @return array
     */
    public function column_actions()
    {
        return '<div class="sa-dropdown">
                    <button class="sa-dropdown-toggle" type="button" data-toggle="sa-dropdown" aria-expanded="false">
                        <img src="'. SA_PLUGIN_ASSETS_PATH . 'img/more_vert.svg' .'" alt="Actions">
                    </button>
                    <ul class="sa-dropdown-menu">
                        <li><a class="sa-dropdown-item" href="?page=sa-appointments&id=1"><span class="sa-me-1">'. sa_view( 'icons._eye', false ) .'</span>View</a></li>
                        <li><a class="sa-dropdown-item" href="#"><span class="sa-me-1">'. sa_view( 'icons._confirm_appointment', false ) .'</span>Confirm</a></li>
                        <li><a class="sa-dropdown-item" href="#"><span class="sa-me-1">'. sa_view( 'icons._cancel_appointment', false ) .'</span>Cancel</a></li>
                        <li><a class="sa-dropdown-item" href="#"><span class="sa-me-1">'. sa_view( 'icons._trash', false ) .'</span>Delete</a></li>
                    </ul>
                </div>';
    }

    /**
     * Get the status column html.
     *
     * @param  array $item
     * @return string
     */
    public function column_status( $item )
    {
        $class = 'sa-status-' . strtolower( $item['status'] );

        return '<span class="sa-status '. $class .'">'. $item['status'] .'</span>';
    }

    /**
     * Bulk Actions.
     *
     * @return array
     */
    public function get_bulk_actions()
    {
        return [
            'confirm-appointments' => 'Confirm Appointments',
            'cancel-appointments' => 'Cancel Appointments',
            'delete-appointments' => 'Delete Appointments'
        ];
    }
}