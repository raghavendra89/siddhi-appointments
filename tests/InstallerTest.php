<?php

namespace Tests;

use SiddhiAppointments\Installer;
use SiddhiAppointments\DB;
use Tests\TestCase;

class InstallerTest extends TestCase
{
    /** @test */
    public function it_returns_false_if_the_plugin_is_already_installed()
    {
        $installer = new Installer;

        update_option( 'sa_appointments_version', '1.0.0', false );

        $this->assertFalse( $installer->install() );
    }

    /** @test */
    public function when_installed_it_runs_db_scripts()
    {
        delete_option( 'sa_appointments_version' );

        // Mock calling DB class
        $db = $this->getMockBuilder( DB::class )
                   ->setMethods( ['run_schema'] )
                   ->getMock();

        $db->expects( $this->once() )
           ->method( 'run_schema' );

        $installer = new Installer($db);

        $installer->install();

        $this->assertSame( SA_VERSION, get_option( 'sa_appointments_version', false ) );
    }
}