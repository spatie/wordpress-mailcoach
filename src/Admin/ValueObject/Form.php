<?php

namespace Spatie\WordPressMailcoach\Admin\ValueObject;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class Form
{
    private function __construct(
        public string $id,
        public string $name,
        public string $shortcode,
        public string $emailListUuid,
        public string $content,
    ) {
    }

    public static function fromObject(object $data): self
    {
        return new self(
            $data->id,
            $data->name,
            $data->shortcode,
            $data->email_list_uuid,
            $data->content,
        );
    }

    public function toArray(): array
    {
        return [
            'id ' => $this->id,
            'name' => $this->name,
            'shortcode' => $this->shortcode,
            'email_list_uuid' => $this->emailListUuid,
            'content' => $this->content,
        ];
    }
}
