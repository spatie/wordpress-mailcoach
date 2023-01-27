<?php

// Prevent direct file access
defined( 'ABSPATH' ) or exit;

/**
 * Plugin Name: Spatie Mailcoach
 * Plugin URI: https://github.com/spatie/wordpress-mailcoach
 * Description: Show a summary of your Mailcoach campaigns, lists and templates.
 * Version: 0.0.0
 * Author: Spatie
 * Author URI: https://spatie.be
 * License: MIT
 * Requires PHP: 8.0
 * Tested up to: 6.1
 */

use Spatie\WordPressMailcoach\Admin\Admin;

if (! class_exists(Admin::class)) {
    if (is_file(__DIR__ . '/vendor/autoload_packages.php')) {
        require_once __DIR__ . '/vendor/autoload_packages.php';
    }
}

// bootstrap the core plugin
// @todo can this be changed to constants?
define('MAILCOACH_VERSION', '0.0.0');
define('MAILCOACH_PLUGIN_DIR', __DIR__);
define('MAILCOACH_PLUGIN_FILE', __FILE__);
define('MAILCOACH_API_KEY', null);
define('MAILCOACH_DOMAIN', null);

if ( is_admin() ) {
    $admin = new Admin();
    $admin->add_hooks();
}
