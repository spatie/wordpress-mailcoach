<?php

namespace Spatie\WordPressMailcoach\Includes\Api;

use Spatie\MailcoachSdk\Mailcoach;
use Spatie\MailcoachSdk\Resources\EmailList;
use Spatie\MailcoachSdk\Support\PaginatedResults;
use Spatie\WordPressMailcoach\Admin\ValueObject\Settings;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class MailcoachApi
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

    public function hasCredentials(): bool
    {
        return $this->apiToken !== ''
            && filter_var($this->apiEndpoint, FILTER_VALIDATE_URL);
    }

    public function emailLists(): PaginatedResults
    {
        return $this->mailcoach->emailLists();
    }

    /** @return EmailList[] */
    public function emailListOptions(): array
    {
        return $this->mailcoach->emailLists()->results();
    }

    public function emailList(string $uuid): EmailList
    {
        return $this->mailcoach->emailList($uuid);
    }
}
