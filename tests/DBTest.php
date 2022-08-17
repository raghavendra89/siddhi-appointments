<?php

namespace Tests;

use Tests\TestCase;
use SiddhiAppointments\DB;

class DBTest extends TestCase
{
    /** @test */
    public function it_fetches_the_schema_from_a_given_directory()
    {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        $db = new DB;
        $schema = $db->get_schema( SA_PLUGIN_PATH . 'tests/TestData/' );

        $table_name = $wpdb->prefix . 'dummy';

        // Indentation is important here
        $expected_schema = [
            $table_name => 'CREATE TABLE '. $table_name .' (
        id mediumint(8) unsigned not null auto_increment,
        PRIMARY KEY  (id)
    )' . ' ' . $charset_collate . ';'
        ];

        $this->assertEquals( $expected_schema, $schema);
    }
}