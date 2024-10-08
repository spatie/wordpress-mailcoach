<?php

namespace Spatie\WordPressMailcoach\Support;

use Spatie\WordPressMailcoach\Admin\Exception\DatabaseException;

class Table
{
    public static function createTables(): void
    {
        self::createFormsTable();
    }

    public static function dropTables(): void
    {
        self::dropFormsTable();
    }

    public static function forms(): string
    {
        global $wpdb;

        return "{$wpdb->prefix}mailcoach_forms";
    }

    public static function tablesExists(): bool
    {
        global $wpdb;

        $formsTable = self::forms();

        return $wpdb->get_var("SHOW TABLES LIKE '{$formsTable}'") === $formsTable;
    }

    private static function createFormsTable(): void
    {
        global $wpdb;

        if (self::tablesExists()) {
            return;
        }

        $tableName = self::forms();

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$tableName} (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(55) NOT NULL,
            shortcode varchar(55) NOT NULL UNIQUE,
            email_list_uuid varchar(36) NOT NULL,
            content text NOT NULL,
            message_subscribed text NOT NULL,
            message_pending text NOT NULL,
            message_already_subscribed text NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
            PRIMARY KEY (id)
        ) {$charset_collate};";

        $result = $wpdb->query($sql);

        if ($result === false) {
            throw DatabaseException::couldNotCreateTable($tableName);
        }
    }

    private static function dropFormsTable(): void
    {
        $tableName = self::forms();

        self::dropTable($tableName);
    }

    private static function dropTable(string $name): void
    {
        global $wpdb;

        $result = $wpdb->query("DROP TABLE IF EXISTS {$name};");

        if ($result === false) {
            throw DatabaseException::couldNotDropTable($name);
        }
    }
}
