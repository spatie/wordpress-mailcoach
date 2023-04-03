<?php

namespace Spatie\WordPressMailcoach\Admin\Exception;

use RuntimeException;

class DatabaseException extends RuntimeException
{
    public static function couldNotDropTable(string $name): self
    {
        return new self("Failed to drop table `{$name}`");
    }

    public static function couldNotCreateTable(string $name): self
    {
        return new self("Failed to create table `{$name}`");
    }

    public static function failedToInsert(): self
    {
        return new self();
    }
}
