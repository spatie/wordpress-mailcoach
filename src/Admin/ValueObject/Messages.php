<?php

namespace Spatie\WordPressMailcoach\Admin\ValueObject;

use Spatie\WordPressMailcoach\Admin\Enum\SubscribeStatus;
use Spatie\WordPressMailcoach\Admin\Exception\NotFound;

class Messages
{
    private function __construct(
        public string $subscribed,
        public string $pending,
        public string $alreadySubscribed,
    ) {
    }

    /**
     * @param object{message_subscribed: string, message_pending: string, message_already_subscribed: string} $data
     */
    public static function fromObject(object $data): self
    {
        return new self(
            $data->message_subscribed,
            $data->message_pending,
            $data->message_already_subscribed,
        );
    }

    public static function fromRequest(): self
    {
        return new self(
            sanitize_text_field($_POST['message-subscribed']),
            sanitize_text_field($_POST['message-pending']),
            sanitize_text_field($_POST['message-already-subscribed']),
        );
    }

    public static function default(): self
    {
        return new self(
            'You have been subscribed.',
            'You have been subscribed. Please check your email to confirm your subscription.',
            'You are already subscribed.',
        );
    }

    /** @return array{subscribed: string, pending: string, already_subscribed: string} */
    public function toArray(): array
    {
        return [
            'subscribed' => $this->subscribed,
            'pending' => $this->pending,
            'already_subscribed' => $this->alreadySubscribed,
        ];
    }

    public function fromStatus(SubscribeStatus $status): string
    {
        if ($status === SubscribeStatus::Subscribed) {
            return $this->subscribed;
        }

        if ($status === SubscribeStatus::Pending) {
            return $this->pending;
        }

        if ($status === SubscribeStatus::AlreadySubscribed) {
            return $this->alreadySubscribed;
        }

        throw NotFound::messages($status);
    }
}
