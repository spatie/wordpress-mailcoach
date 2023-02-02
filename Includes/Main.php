<?php

namespace Spatie\WordpressMailcoach\Includes;

use Spatie\WordPressMailcoach\admin\Admin;
use Spatie\WordPressMailcoach\admin\Settings;

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
            require_once plugin_dir_path(__FILE__) . '../Admin/settings.php';
            $settings = Settings::make();

            require_once plugin_dir_path(__FILE__) . '../Admin/Admin.php';
            $admin = Admin::fromSettings($settings);
            $admin->initializeHooks();
        }
    }
}
