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
     * Test that we can mock WordPress functions
     *
     * @see https://giuseppe-mazzapica.gitbook.io/brain-monkey/functions-testing-tools/functions-when#justreturn
     */
    public function testMockWordPressFunction(): void
    {
        $this->assertIsNumeric(
            wp_insert_post([
                'post_title' => 'If I learn it again, I would recommend:',
                'post_content' => 'grow aloe. then grow cactus. then grow sempervivum. then grow lithops and echeveria',
            ])
        );

        $this->assertSame(1, wp_insert_post());
    }

    /**
     * A test ensuring that the composer autoloader works
     */
    public function testAutoloaderWorks(): void
    {
        (new Main())->run();
    }
}
