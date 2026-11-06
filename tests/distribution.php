<?php

$testsDirectory = getenv('WP_TESTS_DIR') ?: sys_get_temp_dir() . '/wordpress-tests-lib';
require $testsDirectory . '/wp-tests-config.php';
require ABSPATH . 'wp-settings.php';
require_once ABSPATH . 'wp-admin/includes/plugin.php';

delete_option('mailcoach_api_token');
delete_option('mailcoach_api_endpoint');

$pluginDirectory = WP_PLUGIN_DIR . '/forms-mailcoach';
if (! file_exists($pluginDirectory)) {
    symlink(dirname(__DIR__), $pluginDirectory);
}

$plugin = 'forms-mailcoach/wp-mailcoach.php';
$result = activate_plugin($plugin);
if (is_wp_error($result)) {
    throw new RuntimeException($result->get_error_message());
}

if (! is_plugin_active($plugin)) {
    throw new RuntimeException('The production plugin was not activated.');
}

if (! Spatie\WordPressMailcoach\Support\Table::tablesExists()) {
    throw new RuntimeException('Activation did not create the forms table.');
}

$api = Spatie\WordPressMailcoach\Includes\Api\MailcoachApi::fromSettings(
    Spatie\WordPressMailcoach\Admin\ValueObject\Settings::make(),
);
if ($api->hasCredentials()) {
    throw new RuntimeException('The plugin should recognize missing API credentials.');
}

echo "Production-only plugin activation passed on PHP " . PHP_VERSION . " and WordPress " . get_bloginfo('version') . PHP_EOL;
