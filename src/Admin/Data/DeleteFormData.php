<?php

namespace Spatie\WordPressMailcoach\Admin\Data;

use Spatie\WordPressMailcoach\Admin\Exception\InvalidData;

class DeleteFormData
{
    public function __construct(
        public string $shortcode,
    ) {
    }

    public static function fromRequest(): self
    {
        if (! wp_verify_nonce($_POST['mailcoach_delete_form_nonce'], 'delete_form')) {
            throw InvalidData::fromRequest();
        }

        return new self(
            sanitize_text_field($_POST['shortcode']),
        );
    }
}
