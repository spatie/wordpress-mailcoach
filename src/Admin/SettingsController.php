<?php

namespace Spatie\WordPressMailcoach\Admin;

use Spatie\WordPressMailcoach\Admin\Data\StoreSettingsData;
use Spatie\WordPressMailcoach\Admin\ValueObject\Settings;
use Spatie\WordPressMailcoach\Support\HasHooks;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class SettingsController implements HasHooks
{
    private function __construct(
        private readonly Settings $settings
    ) {
    }

    public static function make(Settings $settings): self
    {
        return new self($settings);
    }

    public function initializeHooks(): void
    {
        add_action('admin_init', fn () => $this->settings::initialise());

        add_action('admin_post_nopriv_store_settings_form', fn () => $this->storeSettings());
        add_action('admin_post_store_settings_form', fn () => $this->storeSettings());
    }

    public function storeSettings(): void
    {
        $this->settings->store(StoreSettingsData::fromRequest());

        wp_redirect($_SERVER['HTTP_REFERER']);
    }
}
