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

    public static function fromSettings(Settings $settings): MailcoachApi
    {
        return new self($settings->apiToken(), $settings->apiDomain());
    }
}
