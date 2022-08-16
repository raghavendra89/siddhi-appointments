<?php

namespace SiddhiAppointments;

class DB
{
    private function get_schema() {
        global $wpdb;

        $schema_files = array_filter( glob(SA_PLUGIN_PATH . 'src/schema/table-*.php'), 'is_file' );

        $schema = [];
        foreach ( $schema_files as $file ) {
            preg_match( '/table-(.+).php/', $file, $matches );
            $table_name = $wpdb->prefix . strtolower( $matches[1] );
            $sql = include __DIR__ . '/schema/' . $matches[0];

            $charset_collate = $wpdb->get_charset_collate();

            $sql = 'CREATE TABLE ' . $table_name . ' ' . $sql;
            $sql = $sql . ' ' . $charset_collate . ';';

            $schema[ $table_name ] = $sql;
        }

        return $schema;
    }

    private function db_delta( $sql )
    {
        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );

        return dbDelta( $sql, true );
    }

    public function run_schema() {
        $schema = $this->get_schema();

        foreach ( $schema as $table_name => $sql ) {
            $this->db_delta( $sql );
        }
    }
}
