<?php

namespace Tests;

use Tests\TestCase;
use SiddhiAppointments\Plugin;

class PluginTest extends TestCase
{
    /** @test */
    public function it_calls_installer_when_activated()
    {
        // Mock calling DB class
        $installer = $this->getMockBuilder( Installer::class )
                          ->setMethods( ['install'] )
                          ->getMock();

        $plugin = new Plugin($installer);

        $installer->expects( $this->once() )
                  ->method( 'install' );

        $plugin->activate();
    }
}