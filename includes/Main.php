<?php

namespace Spatie\WordpressMailcoach\Includes;

use Spatie\WordPressMailcoach\Admin\Admin;
use Spatie\WordpressMailcoach\Admin\Settings;

class Main
{
    public function run(): void
    {
        $this->defineAdminHooks();
    }

    private function defineAdminHooks(): void
    {
        if (is_admin()) {
            require_once plugin_dir_path(__FILE__) . '../admin/settings.php';
            $settings = new Settings();

            $admin = new Admin($settings);
            $admin->initializeHooks();
        }
    }
}
