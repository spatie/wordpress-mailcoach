<?php

namespace Spatie\WordPressMailcoach\Admin\Data;

use Spatie\WordPressMailcoach\Admin\Action\GenerateShortcode;
use Spatie\WordPressMailcoach\Admin\Exception\InvalidData;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class CreateOrUpdateFormData
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
            $_POST['shortcode'] ?? (new GenerateShortcode())->execute($sanitizedName),
            sanitize_text_field($_POST['email-list']),
            stripslashes($_POST['content']),
        );
    }
}
