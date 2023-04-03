<?php

namespace Spatie\WordPressMailcoach\Admin\Repository;

use Spatie\WordPressMailcoach\Admin\Data\StoreFormData;
use Spatie\WordPressMailcoach\Admin\Exception\DatabaseException;
use Spatie\WordPressMailcoach\Admin\ValueObject\Form;
use Spatie\WordPressMailcoach\Includes\Table;

class FormRepository
{
    public static function make(): self
    {
        return new self();
    }

    public function store(StoreFormData $data): void
    {
        $shortcode = sanitize_title($data->name);

        $exists = $this->firstByShortcodeAndEmailList($shortcode, $data->emailListUuid);

        if ($exists) {
            return; // No duplicates allowed
        }

        global $wpdb;

        $result = $wpdb->insert(
            Table::formsTableName(),
            [
                'name' => $data->name,
                'shortcode' => $shortcode,
                'email_list_uuid' => $data->emailListUuid,
                'content' => $data->content,
            ]
        );

        if ($result === false) {
            throw DatabaseException::failedToInsert();
        }
    }

    /**
     * @return array<array{id: string, name: string, email_list_uuid: string, content: string}>
     */
    public function all(): array
    {
        global $wpdb;

        $tableName = Table::formsTableName();

        $query = "SELECT * FROM {$tableName}";

        $result = $wpdb->get_results($query);

        return array_map(static function ($item) {
            return Form::fromObject($item);
        }, $result);
    }

    public function firstByShortcodeAndEmailList(string $shortcode, string $emailListUuid): ?Form
    {
        global $wpdb;

        $tableName = Table::formsTableName();

        $query = "SELECT * FROM {$tableName} WHERE shortcode = {$shortcode} AND email_list_uuid = {$emailListUuid} LIMIT 1";

        $result = $wpdb->get_results($query);

        if ($result) {
            return Form::fromObject($result[0]);
        }

        return null;
    }
}
