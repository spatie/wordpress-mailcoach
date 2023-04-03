<?php

namespace Spatie\WordPressMailcoach\Admin\Exception;

use RuntimeException;

class InvalidData extends RuntimeException
{
    public static function fromRequest(): self
    {
        return new self('Invalid data.');
    }
}
