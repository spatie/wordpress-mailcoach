<?php

namespace Spatie\WordPressMailcoach\Admin;

use Spatie\MailcoachSdk\Mailcoach;
use Spatie\MailcoachSdk\Resources\EmailList;
use Spatie\MailcoachSdk\Support\PaginatedResults;
use Spatie\WordPressMailcoach\Admin\Data\CreateSubscriberData;
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

    public function emailList(string $uuid): EmailList
    {
        return $this->mailcoach->emailList($uuid);
    }

    public function showEmailLists(): void
    {
        include __DIR__ . '/views/show-email-lists.php';
    }

    public function createSubscriberFromShortCode(): void
    {
        $data = CreateSubscriberData::fromShortcode();

        $this->mailcoach->createSubscriber($data->emailListUuid, $data->attributes);

        wp_redirect($_SERVER['HTTP_REFERER']);
    }
}
