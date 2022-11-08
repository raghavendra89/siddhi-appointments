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

    /** @test */
    public function it_returns_class_instance_when_table_method_is_called()
    {
        global $wpdb;

        $this->assertInstanceOf(DB::class, DB::table($wpdb->prefix . 'dummy'));
    }

    /** @test */
    public function it_create_record_returns_false_if_table_is_not_set()
    {
        $this->assertFalse(DB::table('')->create(['name' => 'Raj']));
    }
}