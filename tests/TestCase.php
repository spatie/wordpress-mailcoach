<?php

namespace Spatie\WordPressMailcoach\Tests;

use Spatie\WordPressMailcoach\Support\Table;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        if (! Table::tablesExists()) {
            Table::createTables();
        }
    }
}
