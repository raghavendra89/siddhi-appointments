<?php

namespace SiddhiAppointments;

class DB
{
    /**
     * Path for the directory containing schema files.
     *
     * @var string $schema_files_path Schema files directory path.
     */
    private $schema_files_path = SA_PLUGIN_PATH . 'src/schema/';

    /**
     * Reads the schema from the given directory
     * and returns the array.
     *
     * @param string $schema_files_path Path of the directory which contains the schema files.
     * 
     * @return array Array of schema with table names as keys.
     */
    public function get_schema( $schema_files_path ) {
        global $wpdb;

        $schema_files = array_filter( glob( $schema_files_path . 'table-*.php' ), 'is_file' );

        $schema = [];
        foreach ( $schema_files as $file ) {
            preg_match( '/table-(.+).php/', $file, $matches );
            $table_name = $wpdb->prefix . strtolower( $matches[1] );
            $sql = include $schema_files_path . $matches[0];

            $charset_collate = $wpdb->get_charset_collate();

            $sql = 'CREATE TABLE ' . $table_name . ' ' . $sql;
            $sql = $sql . ' ' . $charset_collate . ';';

            $schema[ $table_name ] = $sql;
        }

        return $schema;
    }

    /**
     * Runs SQL queries by calling WP dbDelta.
     *
     * @param string $sql Single SQL statement
     * 
     * @return array
     */
    private function db_delta( $sql ) {
        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );

        // For PHP 8 and above dbDelta throws error while creating the tables
        // Refer: https://php.watch/versions/8.1/mysqli-error-mode
        if ( defined( 'PHP_VERSION' ) && PHP_VERSION > 8 ) {
            mysqli_report( MYSQLI_REPORT_OFF );
        }

        return dbDelta( $sql, true );
    }

    /**
     * Runs the DB schema required for the plugin.
     *
     * @return void
     */
    public function run_schema() {
        $schema = $this->get_schema( $this->schema_files_path );

        foreach ( $schema as $table_name => $sql ) {
            $this->db_delta( $sql );
        }
    }
}
