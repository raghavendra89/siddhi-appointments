<?php

namespace Tests;

use Tests\TestCase;

class helpersTest extends TestCase
{
    /** @test */
    public function rendering_non_existing_view()
    {
        ob_start();
        sa_view( 'non-existing-page' );
        $data = ob_get_clean();

        $this->assertEmpty( $data );
    }

    /** @test */
    public function rendering_view()
    {
        ob_start();
        sa_view( 'appointments-page' );
        $data = ob_get_clean();

        $this->assertNotEmpty( $data );
    }

    /** @test */
    public function rendering_view_in_sub_folder()
    {
        ob_start();
        sa_view( 'appointment-type._basic-details' );
        $data = ob_get_clean();

        $this->assertNotEmpty( $data );
    }
}