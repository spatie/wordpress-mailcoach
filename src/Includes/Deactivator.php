<?php

namespace Spatie\WordPressMailcoach\Includes;

// If this file is called directly, abort.
use Spatie\WordPressMailcoach\Admin\Settings;

if (! defined('ABSPATH')) {
    exit;
}

class Deactivator
{
    public static function deactivate(): void
    {
        foreach (Settings::KEYS as $key) {
            //delete_option($setting); // @todo for testing purposes disabled
        }
    }
}
