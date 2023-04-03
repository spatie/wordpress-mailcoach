<?php

namespace Spatie\WordPressMailcoach\Admin\Data;

use Spatie\WordPressMailcoach\Admin\Exception\InvalidData;

class CreateSubscriberData
{
    private function __construct(
        public string $emailListUuid,
        public array $attributes,
    ) {
    }

    public static function fromShortcode(): self
    {
        if (! isset($_POST['mailcoach_subscribe_submit']) || ! isset($_POST['mailcoach_subscribe_nonce'])) {
            throw InvalidData::fromRequest();
        }

        if (! wp_verify_nonce($_POST['mailcoach_subscribe_nonce'], 'faire-don')) {
            throw InvalidData::fromRequest();
        }

        if (! isset($_POST['email_list_uuid'])) {
            throw InvalidData::fromRequest();
        }

        $attributes = [];
        foreach ($_POST as $key => $value) {
            if (in_array($key, ['_wp_http_referer', 'mailcoach_subscribe_nonce', 'mailcoach_subscribe_submit', 'email_list_uuid', 'action'])) {
                continue;
            }

            $attributes[$key] = sanitize_text_field($value);
        }

        return new self(
            sanitize_text_field($_POST['email_list_uuid']),
            $attributes,
        );
    }
}
