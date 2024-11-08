<?php

namespace Tests;

trait DbAssertions
{
    public function assertDatabaseHas( string $table_name, array $data )
    {
        if ( empty($data) ) {
            return false;
        }

        global $wpdb;
        $table_name = $wpdb->prefix . $table_name;

        $query = "SELECT * FROM {$table_name} WHERE ";
        foreach ( $data as $field => $value ) {
            $query .= $field . " = '" . $value . "'";
            $query .= ' AND ';
        }

        $query = preg_replace('/( AND $)|( WHERE $)/', '', $query);

        $result = $wpdb->get_results($query);

        $this->assertNotEmpty($result, "Failed asserting that the database table {$table_name} has given value.");
    }
}