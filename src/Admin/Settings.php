<?php

namespace Spatie\WordPressMailcoach\Admin;

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
            $apiToken = sanitize_text_field($_POST['mailcoach_api_token']);
            $storedApiToken = get_option('mailcoach_api_token');

            if (! empty($apiToken) && ! empty($storedApiToken)) {
                if (
                    ! $this->lastCharsAreEqual($apiToken, $storedApiToken)
                    && ! $this->containsAsterixSymbols($apiToken)
                ) {
                    update_option('mailcoach_api_token', $apiToken);
                }
            } else {
                add_option('mailcoach_api_token', $apiToken);
            }
        }

        if (isset($_POST['mailcoach_api_endpoint'])) {
            $apiEndpoint = sanitize_text_field($_POST['mailcoach_api_endpoint']);
            $storedApiEndpoint = get_option('mailcoach_api_endpoint');

            if (! empty($apiEndpoint) && ! empty($storedApiEndpoint)) {
                update_option('mailcoach_api_endpoint', $apiEndpoint);
            } else {
                add_option('mailcoach_api_endpoint', $apiEndpoint);
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

    private function lastCharsAreEqual(string $original, string $given): bool
    {
        $given = substr($given, -4);
        $original = substr($original, -4);

        return substr($given, -4) === substr($original, -4);
    }

    private function containsAsterixSymbols(string $input): bool
    {
        return str_contains($input, '*');
    }
}
