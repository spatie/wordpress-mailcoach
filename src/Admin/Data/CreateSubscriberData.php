<?php

namespace Spatie\WordPressMailcoach\Admin\Data;

use Spatie\WordPressMailcoach\Admin\Exception\InvalidData;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class CreateSubscriberData
{
    /** @var string[] */
    private static array $toIgnore = [
        '_wp_http_referer', 'mailcoach_subscribe_nonce', 'mailcoach_subscribe_submit', 'email_list_uuid', 'action',
    ];

    /**
     * @param array<string|int, string> $attributes
     */
    private function __construct(
        public string $emailListUuid,
        public array $attributes,
    ) {
    }

    public static function fromShortcode(): self
    {
        if (! isset(
            $_POST['mailcoach_subscribe_submit'],
            $_POST['mailcoach_subscribe_nonce'],
            $_POST['email_list_uuid'])
        ) {
            throw InvalidData::fromRequest();
        }

        if (! wp_verify_nonce($_POST['mailcoach_subscribe_nonce'], 'mailcoach_subscribe_nonce')) {
            throw InvalidData::fromNonce();
        }

        $attributes = [];
        foreach ($_POST as $key => $value) {
            $key = sanitize_key($key);
            if (in_array($key, self::$toIgnore, true)) {
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
