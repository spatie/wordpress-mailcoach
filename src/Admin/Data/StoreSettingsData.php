<?php

namespace Spatie\WordPressMailcoach\Admin\Data;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class StoreSettingsData
{
    private function __construct(
        public ?string $apiToken,
        public ?string $apiEndpoint,
    ) {
    }

    public static function fromRequest(): self
    {
        return new self(
            isset($_POST['mailcoach_api_token']) ? sanitize_text_field($_POST['mailcoach_api_token']) : null,
            isset($_POST['mailcoach_api_endpoint']) ? self::getDomain(sanitize_text_field($_POST['mailcoach_api_endpoint'])) : null,
        );
    }

    private static function getDomain(string $url): string
    {
        $url = parse_url($url);

        return $url['scheme'] . '://' . $url['host'];
    }
}
