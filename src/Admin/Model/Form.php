<?php

namespace Spatie\WordPressMailcoach\Admin\Model;

use DateTimeImmutable;
use Spatie\MailcoachSdk\Resources\EmailList;
use Spatie\WordPressMailcoach\Includes\Table;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class Form implements Model
{
    private function __construct(
        public string $id,
        public string $name,
        public string $shortcode,
        public string $emailListUuid,
        public string $content,
        public DateTimeImmutable $createdAt,
        public ?EmailList $emailList = null,
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
            DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $data->created_at),
        );
    }

    public static function tableName(): string
    {
        return Table::forms();
    }

    public function createdAt(): string
    {
        return $this->createdAt->format(get_option('date_format'));
    }

    public function editUrl(): string
    {
        // @todo use something more global like adminUrls(): array<edit:string,..>
        return add_query_arg([
            'form' => $this->id,
            'page' => 'mailcoach-edit-form',
        ], admin_url('admin.php'));
    }

    public function setEmailList(EmailList $emailList): self
    {
        $this->emailList = $emailList;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'id ' => $this->id,
            'name' => $this->name,
            'shortcode' => $this->shortcode,
            'email_list_uuid' => $this->emailListUuid,
            'content' => $this->content,
            'created_at' => $this->createdAt(),
        ];
    }
}
