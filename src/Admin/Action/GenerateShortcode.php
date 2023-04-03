<?php

namespace Spatie\WordPressMailcoach\Admin\Action;

class GenerateShortcode
{
    public function execute(string $input): string
    {
        $name = sanitize_title($input);
        $prefix = 'mailcoach-';

        return "{$prefix}{$name}";
    }
}
