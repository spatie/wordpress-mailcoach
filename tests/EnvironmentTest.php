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

    public function testPluginRequirementsMatchTheBundledSdk(): void
    {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';

        $plugin = get_plugin_data(dirname(__DIR__) . '/wp-mailcoach.php');
        $readme = get_file_data(dirname(__DIR__) . '/readme.txt', [
            'php' => 'Requires PHP',
            'wordpress' => 'Requires at least',
            'version' => 'Stable tag',
        ]);
        $composer = json_decode(file_get_contents(dirname(__DIR__) . '/composer.json'), true);

        $this->assertSame('8.3', $plugin['RequiresPHP']);
        $this->assertSame($plugin['RequiresPHP'], $readme['php']);
        $this->assertSame('^8.3', $composer['require']['php']);
        $this->assertSame('6.2', $plugin['RequiresWP']);
        $this->assertSame($plugin['RequiresWP'], $readme['wordpress']);
        $this->assertSame($plugin['Version'], $readme['version']);
        $this->assertTrue(is_php_version_compatible($plugin['RequiresPHP']));
        $this->assertTrue(version_compare('8.2.99', $plugin['RequiresPHP'], '<'));
    }
}
