<?php

namespace Spatie\WordPressMailcoach\Admin;

use Spatie\MailcoachSdk\Mailcoach;
use Spatie\WordpressMailcoach\Admin\Settings;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

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
