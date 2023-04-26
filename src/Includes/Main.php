<?php

namespace Spatie\WordPressMailcoach\Includes;

use Spatie\WordPressMailcoach\Admin\AdminMenu;
use Spatie\WordPressMailcoach\Admin\ValueObject\Settings;

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
            $admin = AdminMenu::make(Settings::make());
            $admin->initializeHooks();
        }

        include plugin_dir_path(__DIR__) . 'functions.php';
    }
}
