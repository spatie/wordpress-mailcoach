<?php

namespace Spatie\WordPressMailcoach\Includes;

// If this file is called directly, abort.
use Spatie\WordPressMailcoach\Admin\ValueObject\Settings;
use Spatie\WordPressMailcoach\Support\Table;

if (! defined('ABSPATH')) {
    exit;
}

class Deactivator
{
    public static function uninstall(): void
    {
        self::deleteOptions();

        Table::dropTables();
    }

    private static function deleteOptions(): void
    {
        foreach (Settings::keys() as $key) {
            delete_option($key);
        }
    }
}
