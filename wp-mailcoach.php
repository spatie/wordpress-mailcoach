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
 * Description:       Show a summary of your Mailcoach campaigns, lists and templates.
 * Version:           1.0.0
 * Author:            Spatie
 * Author URI:        https://spatie.be
 * License:           MIT
 * Text Domain:       mailcoach
 * Domain Path:       /Languages
 * Requires PHP:      7.4
 */

use Spatie\WordpressMailcoach\includes\Activator;
use Spatie\WordpressMailcoach\Includes\Deactivator;
use Spatie\WordpressMailcoach\includes\Main;

// Prevent direct file access
defined('ABSPATH') or exit;

// Autoloader
//require_once plugin_dir_path(__FILE__) . 'Autoloader.php';

define('MAILCOACH_VERSION', '1.0.0');
define('MAILCOACH_API_KEY', null);
define('MAILCOACH_DOMAIN', null);
define('MAILCOACH_PLUGIN_DIR', __DIR__);
define('MAILCOACH_PLUGIN_FILE', __FILE__);

function activate_mailcoach()
{
    require_once plugin_dir_path(__FILE__) . 'src/Includes/Activator.php';
    Activator::activate();
}

function deactivate_mailcoach()
{
    require_once plugin_dir_path(__FILE__) . 'src/Includes/Deactivator.php';
    Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_mailcoach');
register_deactivation_hook(__FILE__, 'deactivate_mailcoach');

function runPlugin(): void
{
    require_once plugin_dir_path(__FILE__) . 'src/Includes/Main.php';
    $plugin = new Main();
    $plugin->run();
}

runPlugin();
