<?php

namespace Spatie\WordPressMailcoach\Includes;

use Spatie\WordPressMailcoach\Admin\Admin;
use Spatie\WordPressMailcoach\Admin\Settings;

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
            $settings = Settings::make();

            $admin = Admin::fromSettings($settings);
            $admin->initializeHooks();
        }

        include plugin_dir_path(__DIR__) . 'functions.php';
    }
}
