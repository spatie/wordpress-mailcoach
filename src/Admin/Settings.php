<?php

namespace Spatie\WordpressMailcoach\Admin;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class Settings
{
    private string $apiToken = '';
    private string $apiEndpoint = '';

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

        add_action('admin_post_nopriv_process_form', fn () => $this->submitSettings());
        add_action('admin_post_process_form', fn () => $this->submitSettings());
    }

    public function initializeSettings(): void
    {
        // Keep in sync with allKeys()
        $this->apiToken = get_option('mailcoach_api_token');
        $this->apiEndpoint = get_option('mailcoach_api_endpoint');
    }

    public function submitSettings(): void
    {
        if (isset($_POST['mailcoach_api_token'])) {
            $api_key = sanitize_text_field($_POST['mailcoach_api_token']);
            $api_exists = get_option('mailcoach_api_token');

            if (! empty($api_key) && ! empty($api_exists)) {
                update_option('mailcoach_api_token', $api_key);
            } else {
                add_option('mailcoach_api_token', $api_key);
            }
        }

        if (isset($_POST['mailcoach_api_endpoint'])) {
            $api_key = sanitize_text_field($_POST['mailcoach_api_endpoint']);
            $api_exists = get_option('mailcoach_api_endpoint');

            if (! empty($api_key) && ! empty($api_exists)) {
                update_option('mailcoach_api_endpoint', $api_key);
            } else {
                add_option('mailcoach_api_endpoint', $api_key);
            }
        }

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

    public function keys(): array
    {
        return [
            'mailcoach_api_token',
            'mailcoach_api_endpoint',
        ];
    }
}
