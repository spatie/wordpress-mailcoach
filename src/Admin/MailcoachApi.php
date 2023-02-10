<?php

namespace Spatie\WordPressMailcoach\Admin;

use Spatie\MailcoachSdk\Mailcoach;
use Spatie\MailcoachSdk\Support\PaginatedResults;
use Spatie\WordPressMailcoach\Support\HasHooks;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class MailcoachApi implements HasHooks
{
    private Mailcoach $mailcoach;

    private string $apiToken;
    private string $apiEndpoint;

    private function __construct(string $apiToken, string $apiEndpoint)
    {
        $this->apiToken = $apiToken;
        $this->apiEndpoint = $apiEndpoint;
        $this->mailcoach = new Mailcoach($apiToken, $apiEndpoint);
    }

    public static function fromSettings(Settings $settings): MailcoachApi
    {
        return new self($settings->apiToken(), $settings->apiEndpoint());
    }

    public function initializeHooks(): void
    {
        add_action('admin_post_nopriv_process_subscribe_form', fn () => $this->createSubscriberFromShortCode());
        add_action('admin_post_process_subscribe_form', fn () => $this->createSubscriberFromShortCode());
    }

    public function hasCredentials(): bool
    {
        return $this->apiToken !== ''
            && filter_var($this->apiEndpoint, FILTER_VALIDATE_URL)
            && str_ends_with($this->apiEndpoint, 'mailcoach.app/api');
    }

    public function emailLists(): PaginatedResults
    {
        return $this->mailcoach->emailLists();
    }

    public function showEmailLists(): void
    {
        include __DIR__ . '/views/show-email-lists.php';
    }

    public function createSubscriberFromShortCode(): void
    {
        if (! isset($_POST['mailcoach_subscribe_submit']) || ! isset($_POST['mailcoach_subscribe_nonce'])) {
            return;
        }

        if (! wp_verify_nonce($_POST['mailcoach_subscribe_nonce'], 'faire-don')) {
            return;
        }

        if (! isset($_POST['email_list_uuid'])) {
            return;
        }

        $emailListUuid = sanitize_text_field($_POST['email_list_uuid']);

        $attributes = [];
        foreach ($_POST as $key => $value) {
            if (in_array($key, ['_wp_http_referer', 'mailcoach_subscribe_nonce', 'mailcoach_subscribe_submit', 'email_list_uuid', 'action'])) {
                continue;
            }

            $attributes[$key] = sanitize_text_field($value);
        }

        $this->mailcoach->createSubscriber($emailListUuid, $attributes);

        wp_redirect($_SERVER['HTTP_REFERER']);
    }
}
