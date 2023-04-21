<?php

namespace Spatie\WordPressMailcoach\Admin;

use Spatie\MailcoachSdk\Mailcoach;
use Spatie\MailcoachSdk\Resources\EmailList;
use Spatie\MailcoachSdk\Support\PaginatedResults;

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
            && filter_var($this->apiEndpoint, FILTER_VALIDATE_URL)
            && str_ends_with($this->apiEndpoint, 'mailcoach.app/api');
    }

    public function emailLists(): PaginatedResults
    {
        return $this->mailcoach->emailLists();
    }

    /** @return array{uuid: string, name: string} */
    public function emailListOptions(): array
    {
        $emailLists = [];
        foreach ($this->mailcoach->emailLists()->results() as $list) {
            $emailLists[] = ['uuid' => $list->uuid, 'name' => $list->name];
        }

        return $emailLists;
    }

    public function emailList(string $uuid): EmailList
    {
        return $this->mailcoach->emailList($uuid);
    }
}
