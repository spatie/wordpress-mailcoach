<?php

namespace Spatie\WordPressMailcoach\Admin\ValueObject;

class Form
{
    private function __construct(
        public string $id,
        public string $name,
        public string $emailListUuid,
        public string $content
    ) {
    }

    public static function fromObject($data): self
    {
        return new self(
            $data->id,
            $data->name,
            $data->email_list_uuid,
            $data->content,
        );
    }

    public function toArray(): array
    {
        return [
            'id ' => $this->id,
            'name' => $this->name,
            'email_list_uuid' => $this->emailListUuid,
            'content' => $this->content,
        ];
    }
}
