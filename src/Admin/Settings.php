<?php

namespace Spatie\WordPressMailcoach\Admin;

use Spatie\WordPressMailcoach\Admin\Action\StoreSettings;
use Spatie\WordPressMailcoach\Admin\Data\StoreSettingsData;
use Spatie\WordPressMailcoach\Support\HasHooks;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class Settings implements HasHooks
{
    private string $apiToken = '';
    private string $apiEndpoint = '';

    public const API_TOKEN = 'mailcoach_api_token';
    public const API_ENDPOINT = 'mailcoach_api_endpoint';

    public const KEYS = [
        self::API_TOKEN,
        self::API_ENDPOINT,
    ];

    private function __construct()
    {
        $this->initializeSettings();
    }

    public static function make(): self
    {
        return new self();
    }

    public function initializeHooks(): void
    {
        add_action('admin_init', fn () => $this->initializeSettings());

        add_action('admin_post_nopriv_store_settings_form', fn () => $this->storeSettings());
        add_action('admin_post_store_settings_form', fn () => $this->storeSettings());
    }

    public function initializeSettings(): void
    {
        $this->apiToken = get_option(self::API_TOKEN);
        $this->apiEndpoint = get_option(self::API_ENDPOINT);
    }

    public function storeSettings(): void
    {
        $data = StoreSettingsData::fromRequest();

        (new StoreSettings())->execute($data);

        wp_redirect($_SERVER['HTTP_REFERER']);
    }

    public function apiToken(): string
    {
        return $this->apiToken;
    }

    public function apiEndpoint(): string
    {
        return $this->apiEndpoint;
    }
}
