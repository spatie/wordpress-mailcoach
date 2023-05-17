<?php

namespace Spatie\WordPressMailcoach\Tests;

use Spatie\WordPressMailcoach\Includes\Main;

/**
 * These tests prove integration test setup works.
 */
class EnvironmentTest extends TestCase
{
    /**
     * This tests makes sure:
     *
     * - WordPress functions are defined
     * - WordPress database can be written to.
     */
    public function test_WordPress(): void
    {
        global  $wpdb;

        $this->assertIsObject($wpdb);

        $id = wp_insert_post([
            'post_type' => 'post',
            'post_title' => 'roy',
            'post_content' => 'sivan',
        ]);

        $this->assertIsNumeric($id);
    }

    /**
     * A test ensuring that the composer autoloader works
     */
    public function testAutoloaderWorks(): void
    {
        $this->assertNull((new Main())->run());
    }
}
