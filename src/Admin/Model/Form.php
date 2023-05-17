<?php

namespace Spatie\WordPressMailcoach\Admin\Model;

use DateTimeImmutable;
use Spatie\MailcoachSdk\Resources\EmailList;
use Spatie\WordPressMailcoach\Admin\ValueObject\Messages;
use Spatie\WordPressMailcoach\Admin\ValueObject\Settings;
use Spatie\WordPressMailcoach\Support\Table;

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
        public Messages $messages,
        public DateTimeImmutable $createdAt,
        public ?EmailList $emailList = null,
    ) {
    }

    /**
     * @param object{id: string, name: string, shortcode: string, email_list_uuid: string, content: string, created_at: string, message_subscribed: string, message_pending: string, message_already_subscribed: string} $data
     */
    public static function fromObject(object $data): self
    {
        return new self(
            id: $data->id,
            name: $data->name,
            shortcode: $data->shortcode,
            emailListUuid: $data->email_list_uuid,
            content: $data->content,
            messages: Messages::fromObject($data),
            createdAt: DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $data->created_at),
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

    public function actionUrl(): string
    {
        return get_option(Settings::KEY_API_ENDPOINT) . "/subscribe/{$this->emailListUuid}";
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
            'content' => esc_html($this->content),
            'messages' => $this->messages->toArray(),
            'created_at' => $this->createdAt(),
        ];
    }
}
