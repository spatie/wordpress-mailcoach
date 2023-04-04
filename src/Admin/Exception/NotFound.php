<?php

namespace Spatie\WordPressMailcoach\Admin\Exception;

use RuntimeException;

class NotFound extends RuntimeException
{
    public static function form(string $shortcode): self
    {
        return new self("Form with shortcode `{$shortcode}` not found");
    }
}
