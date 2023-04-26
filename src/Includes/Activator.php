<?php

namespace Spatie\WordPressMailcoach\Includes;

// If this file is called directly, abort.
use Spatie\WordPressMailcoach\Support\Table;

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
