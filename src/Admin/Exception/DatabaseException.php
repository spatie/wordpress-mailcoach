<?php

namespace Spatie\WordPressMailcoach\Admin\Exception;

use RuntimeException;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

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

    public static function failedToInsert(string $tableName): self
    {
        return new self("Failed to insert record in table `{$tableName}`");
    }

    public static function failedToUpdate(string $tableName, string|int $id): self
    {
        return new self("Failed to insert record in table `{$tableName}` with id `{$id}`");
    }

    public static function failedToDelete(string $tableName, string $recordName): self
    {
        return new self("Failed to delete record `{$recordName}` in table `{$tableName}`");
    }

    public static function shortcodeIsUnique(string $shortcode): self
    {
        return new self("Shortcode `{$shortcode}` is already in use");
    }
}
