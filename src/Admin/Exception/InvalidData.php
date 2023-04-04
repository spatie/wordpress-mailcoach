<?php

namespace Spatie\WordPressMailcoach\Admin\Exception;

use RuntimeException;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class InvalidData extends RuntimeException
{
    public static function fromRequest(): self
    {
        return new self('Invalid data.');
    }

    public static function fromNonce(): self
    {
        return new self('Invalid data.');
    }
}
