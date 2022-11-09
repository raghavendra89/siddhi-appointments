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
     * Table name on which the queries will be run.
     *
     * @var string $table_name
     */
    private $table_name;

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

    public static function table( string $table_name )
    {
        global $wpdb;

        $db = new DB;
        if ( ! empty( $table_name ) ) {
            $db->table_name = $wpdb->prefix . $table_name;
        }

        return $db;
    }

    /**
     * Insert a record in the DB.
     *
     * @param  array $data Data to be inserted.
     * @param  array $placeholders Data format.
     * @return int|bool Primary key of the inserted record or false.
     */
    public function create( array $data, array $placeholders = [] )
    {
        if ( empty( $this->table_name ) ) {
            return false;
        }

        global $wpdb;

        $wpdb->insert( $this->table_name, $data, $placeholders );

        return $wpdb->insert_id;
    }

    /**
     * Update a record in DB.
     *
     * @param  array $data Update data.
     * @param  array $where Where condition.
     * @param  array $format Data format.
     * @param  array $whereFormat Where condition data format.
     * @return int|bool
     */
    public function update( array $data, array $where, array $format = [], array $whereFormat = [] )
    {
        if ( empty( $this->table_name ) ) {
            return false;
        }

        global $wpdb;

        return $wpdb->update( $this->table_name, $data, $where, $format, $whereFormat );
    }

    /**
     * Get an entry from DB by ID.
     *
     * @param  int $id Primary key of the entry.
     * @param  string $type Output type.
     * @return object|array|null
     */
    public function find( int $id , $type = 'ARRAY_A' )
    {
        if ( empty( $this->table_name ) ) {
            return false;
        }

        if ( ! in_array( $type, ['OBJECT', 'ARRAY_A', 'ARRAY_N'] ) ) {
            $type = 'ARRAY_A';
        }

        global $wpdb;

        return $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$this->table_name} WHERE id = %d", $id ), $type );
    }

    /**
     * Run general query.
     *
     * @param  string $query Query.
     * @param  array $values Values to substiture into the query.
     * @return
     */
    public function query( string $query, array $values )
    {
        global $wpdb;

        return $wpdb->query( $wpdb->prepare( $query, $values ) );
    }

    /**
     * Delete from table by id.
     *
     * @param  int $id primary key
     * @return int|bool Number of rows affected. In this case 1 or false.
     */
    public function delete( int $id )
    {
        if ( empty( $this->table_name ) ) {
            return false;
        }

        global $wpdb;

        return $wpdb->delete( $this->table_name, ['id' => $id], ['%d'] );
    }

    /**
     * Delete from table by id.
     *
     * @param  int $id primary key
     * @return int|bool Number of rows affected. In this case 1 or false.
     */
    public function deleteWhere( array $where, array $whereFormat = [] )
    {
        if ( empty( $this->table_name ) ) {
            return false;
        }

        if ( empty( $where ) ) {
            return false;
        }

        global $wpdb;

        return $wpdb->delete( $this->table_name, $where, $whereFormat );
    }
}
