<?php

namespace Spatie\WordPressMailcoach\Admin;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class Forms
{
    public static function make(): self
    {
        return new self();
    }

    public function initializeHooks(): void
    {
        add_action('init', fn () => $this->showForm());
    }

    public function showForm(): void
    {
        include __DIR__ . '/views/preview-subscribe-form.php';
    }
}
