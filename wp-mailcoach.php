<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://mailcoach.app
 * @since             1.0.0
 * @package           Mailcoach
 *
 * @wordpress-plugin
 * Plugin Name:       Mailcoach
 * Plugin URI:        https://github.com/spatie/wordpress-mailcoach
 * Description:       Create forms for Mailcoach.
 * Version:           1.0.0
 * Author:            Spatie
 * Author URI:        https://spatie.be
 * License:           MIT
 * Text Domain:       mailcoach-forms
 * Requires PHP:      8.1
 */

use Spatie\WordpressMailcoach\Includes\Activator;
use Spatie\WordpressMailcoach\Includes\Deactivator;
use Spatie\WordpressMailcoach\Includes\Main;

// Prevent direct file access
defined('ABSPATH') or exit;

// Autoloader
require_once plugin_dir_path(__FILE__) . '/vendor/autoload_packages.php';
require_once plugin_dir_path(__FILE__) . 'autoloader.php';

function mailcoach_activate_plugin(): void
{
    require_once plugin_dir_path(__FILE__) . 'src/Includes/Activator.php';
    Activator::activate();
}

function mailcoach_deactivate_plugin(): void
{
    require_once plugin_dir_path(__FILE__) . 'src/Includes/Deactivator.php';
    Deactivator::deactivate();
}

register_activation_hook(__FILE__, static fn () => mailcoach_activate_plugin());
register_deactivation_hook(__FILE__, static fn () => mailcoach_deactivate_plugin());

function mailcoach_run_plugin(): void
{
    require_once plugin_dir_path(__FILE__) . 'src/Includes/Main.php';

    $plugin = new Main();
    $plugin->run();
}

mailcoach_run_plugin();
