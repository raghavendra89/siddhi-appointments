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
    public function it_creates_menu()
    {
        $plugin = new Plugin( $this->installer, $this->admin_menu );

        $this->admin_menu->expects( $this->once() )
                         ->method( 'create_menu' );

        $plugin->create_menu();
    }

    /** @test */
    public function it_registers_required_scripts_and_styles()
    {
        $this->setAsAdminScreen();

        $plugin = new Plugin( $this->installer, $this->admin_menu );
        $plugin->init();

        $this->assertArrayHasKey( 'sa_appointments_admin', wp_styles()->registered );
        $this->assertArrayHasKey( 'sa_appointments_layout', wp_styles()->registered );
    }

    /** @test */
    public function it_inits_plugin_actions()
    {
        $this->setAsAdminScreen();

        // Assert that do_action is fired
        global $sa_appointments_wp;
        $sa_appointments_wp->expects( $this->exactly(2) )
                           ->method( 'add_action' )
                           ->withConsecutive(
                                ['rest_api_init'],
                                ['admin_enqueue_scripts'],
                           );

        $plugin = new Plugin( $this->installer, $this->admin_menu );
        $plugin->init();
    }
}