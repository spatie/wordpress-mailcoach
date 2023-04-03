<?php

namespace Spatie\WordPressMailcoach\Admin\Repository;

use Spatie\WordPressMailcoach\Admin\Data\StoreFormData;
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
        global $wpdb;

        $result = $wpdb->insert(
            Table::formsTableName(),
            [
                'name' => $data->title,
                'email_list_uuid' => $data->emailListUuid,
                'content' => $data->content,
            ]
        ); // @todo verify if successful
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
}
