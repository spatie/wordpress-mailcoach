<?php

namespace Spatie\WordPressMailcoach\Admin\Repository;

use Spatie\WordPressMailcoach\Admin\Data\CreateOrUpdateFormData;
use Spatie\WordPressMailcoach\Admin\Exception\DatabaseException;
use Spatie\WordPressMailcoach\Admin\ValueObject\Form;
use Spatie\WordPressMailcoach\Includes\Table;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class FormRepository
{
    public static function make(): self
    {
        return new self();
    }

    public function createOrUpdateByShortcode(CreateOrUpdateFormData $data): void
    {
        $exists = $this->firstByShortcode($data->shortcode);

        if ($exists) {
            $this->update($data, $exists);

            return;
        }

        global $wpdb;

        $result = $wpdb->insert(
            Table::forms(),
            [
                'name' => $data->name,
                'shortcode' => $data->shortcode,
                'email_list_uuid' => $data->emailListUuid,
                'content' => $data->content,
            ]
        );

        if ($result === false) {
            throw DatabaseException::failedToInsert();
        }
    }

    public function update(CreateOrUpdateFormData $data, Form $form): void
    {
        if ($form->shortcode !== $data->shortcode) {
            throw DatabaseException::shortcodeIsUnique();
        }

        global $wpdb;

        $result = $wpdb->update(
            Table::forms(),
            [
                'name' => $data->name,
                'email_list_uuid' => $data->emailListUuid,
                'content' => $data->content,
            ],
            ['id' => $form->id]
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

        $tableName = Table::forms();

        $query = "SELECT * FROM {$tableName}";

        $result = $wpdb->get_results($query);

        return array_map(static function ($item) {
            return Form::fromObject($item);
        }, $result);
    }

    public function firstByShortcode(string $shortcode): ?Form
    {
        global $wpdb;

        $tableName = Table::forms();

        $query = "SELECT * FROM {$tableName} WHERE shortcode = '{$shortcode}' LIMIT 1";

        $result = $wpdb->get_results($query);

        if ($result) {
            return Form::fromObject($result[0]);
        }

        return null;
    }

    public function firstById(int $id): ?Form
    {
        global $wpdb;

        $tableName = Table::forms();

        $query = "SELECT * FROM {$tableName} WHERE id = '{$id}' LIMIT 1";

        $result = $wpdb->get_results($query);

        if ($result) {
            return Form::fromObject($result[0]);
        }

        return null;
    }
}
