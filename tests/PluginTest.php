<?php

namespace Tests;

use Tests\TestCase;
use SiddhiAppointments\Plugin;

class PluginTest extends TestCase
{
    private $installer;
    private $admin_menu;

    protected function setUp(): void
    {
        parent::setUp();

        // Mock calling Installer class
        $this->installer = $this->getMockBuilder( Installer::class )
                          ->setMethods( ['install'] )
                          ->getMock();

        // Mock calling AdminMenu class
        $this->admin_menu = $this->getMockBuilder( AdminMenu::class )
                          ->setMethods( ['create_menu'] )
                          ->getMock();
    }

    /** @test */
    public function it_calls_installer_when_activated()
    {
        $plugin = new Plugin( $this->installer, $this->admin_menu );

        $this->installer->expects( $this->once() )
                        ->method( 'install' );

        $plugin->activate();
    }

    /** @test */
    public function it_creates_menu_when_plugin_is_initiated()
    {
        $plugin = new Plugin( $this->installer, $this->admin_menu );

        $this->admin_menu->expects( $this->once() )
                         ->method( 'create_menu' );

        $plugin->init();
    }
}