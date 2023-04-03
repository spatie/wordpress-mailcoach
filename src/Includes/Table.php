<?php

namespace Spatie\WordPressMailcoach\Includes;

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

    public static function formsTableName(): string
    {
        global $wpdb;

        return "{$wpdb->prefix}_mailcoach_forms";
    }

    private static function createFormsTable(): void
    {
        global $wpdb;

        $tableName = self::formsTableName();

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$tableName} (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name tinytext NOT NULL,
            email_list_uuid varchar(36) NOT NULL,
            content text NOT NULL,
            PRIMARY KEY  (id)
        ) {$charset_collate};";

        $result = $wpdb->query($sql); // @todo verify is successfully created

        ray($result);
    }

    private static function dropFormsTable(): void
    {
        $tableName = self::formsTableName();

        self::dropTable($tableName);
    }

    private static function dropTable(string $name): void
    {
        global $wpdb;

        $result = $wpdb->query("DROP TABLE IF EXISTS {$name};"); // @todo verify is successfully dropped

        ray($result);
    }
}
