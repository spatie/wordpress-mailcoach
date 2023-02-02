<?php

namespace Spatie\WordPressMailcoach\Includes;

// If this file is called directly, abort.
use Spatie\WordpressMailcoach\Admin\Settings;

if (! defined('ABSPATH')) {
    exit;
}

class Deactivator
{
    public static function deactivate(): void
    {
        $settings = Settings::make();

        foreach ($settings->keys() as $setting) {
            //delete_option($setting); // @todo for testing purposes disabled
        }
    }
}
