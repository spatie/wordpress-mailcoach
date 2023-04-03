<?php

namespace Spatie\WordPressMailcoach\Includes;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class Activator
{
    public static function activate(): void
    {
        Table::createTables();
    }
}
