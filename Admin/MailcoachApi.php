<?php

namespace Spatie\WordPressMailcoach;

use Spatie\MailcoachSdk\Mailcoach;
use Spatie\WordpressMailcoach\Admin\Settings;

class MailcoachApi
{
    private Mailcoach $mailcoach;

    private function __construct(string $apiToken, string $apiDomain)
    {
        $this->mailcoach = new Mailcoach($apiToken, $apiDomain);
    }

    public static function fromSettings(Settings $settings)
    {
        return new self($settings->apiToken(), $settings->apiDomain());
    }

    public function emailLists()
    {
        return $this->mailcoach->emailLists();
    }
}
