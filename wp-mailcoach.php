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
 * Requires PHP:      8.0
 */

namespace Spatie\WordpressMailcoach;

use Spatie\WordPressMailcoach\includes\Activator;
use Spatie\WordPressMailcoach\includes\Main;

// Prevent direct file access
defined( 'ABSPATH' ) or exit;

// Autoloader
require_once plugin_dir_path(__FILE__) . 'Autoloader.php';

define('MAILCOACH_VERSION', '1.0.0');
define('MAILCOACH_API_KEY', null);
define('MAILCOACH_DOMAIN', null);
define('MAILCOACH_PLUGIN_DIR', __DIR__);
define('MAILCOACH_PLUGIN_FILE', __FILE__);

function activate_mailcoach() {
    require_once plugin_dir_path( __FILE__ ) . 'Includes/activator.php';
    Activator::activate();
}

register_activation_hook( __FILE__, 'activate_mailcoach' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks
 * kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function runPlugin(): void
{
    require_once plugin_dir_path( __FILE__ ) . 'Includes/main.php';
    $plugin = new Main();
    $plugin->run();
}

runPlugin();
