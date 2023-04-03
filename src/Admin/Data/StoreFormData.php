<?php

namespace Spatie\WordPressMailcoach\Admin\Data;

use Spatie\WordPressMailcoach\Admin\Exception\InvalidData;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class StoreFormData
{
    private function __construct(
        public string $name,
        public string $shortcode,
        public string $emailListUuid,
        public string $content,
    ) {
    }

    public static function fromRequest(): self
    {
        if (! wp_verify_nonce($_POST['mailcoach_create_new_form_nonce'], 'create_new_form')) {
            throw InvalidData::fromRequest();
        }

        return new self(
            $sanitizedName = sanitize_text_field($_POST['name']),
            sanitize_title($sanitizedName),
            sanitize_text_field($_POST['email-list']),
            sanitize_text_field($_POST['mailcoach-form-content']),
        );
    }
}
