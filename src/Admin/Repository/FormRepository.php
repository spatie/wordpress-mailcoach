<?php

namespace Spatie\WordPressMailcoach\Admin\Repository;

use Spatie\WordPressMailcoach\Admin\Data\StoreFormData;
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
        );
    }
}
