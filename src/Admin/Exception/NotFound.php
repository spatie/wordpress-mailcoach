<?php

namespace Spatie\WordPressMailcoach\Admin\Exception;

use RuntimeException;
use Spatie\WordPressMailcoach\Admin\Enum\SubscribeStatus;

class NotFound extends RuntimeException
{
    public static function form(string $shortcode): self
    {
        return new self("Form with shortcode `{$shortcode}` not found");
    }

    public static function messages(SubscribeStatus $status): self
    {
        return new self("Could not find message for status `{$status->value}`");
    }
}
