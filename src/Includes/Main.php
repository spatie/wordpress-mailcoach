<?php

namespace Spatie\WordpressMailcoach\Includes;

use Spatie\WordpressMailcoach\Admin\Admin;
use Spatie\WordpressMailcoach\Admin\Settings;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class Main
{
    public function run(): void
    {
        $this->defineAdminHooks();
    }

    private function defineAdminHooks(): void
    {
        if (is_admin()) {
            //require_once plugin_dir_path(__DIR__) . 'Admin/Settings.php';
            $settings = Settings::make();

            //require_once plugin_dir_path(__DIR__) . 'Admin/Admin.php';
            $admin = Admin::fromSettings($settings);
            $admin->initializeHooks();
        }
    }
}
