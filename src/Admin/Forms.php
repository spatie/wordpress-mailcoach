<?php

namespace Spatie\WordPressMailcoach\Admin;

use Spatie\WordPressMailcoach\Support\HasHooks;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class Forms implements HasHooks
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
        // @todo make dynamic instead of hardcoded
        $forms = [
            [
                'name' => 'Subscribe to Newsletter',
                'shortcode' => '[subscribe-form-mailcoach list=4bee592b-a9bc-465a-94ed-7ad61cf0f54b]',
                'author' => 'Niels',
                'created_at' => '2023-01-01',
            ],
        ];

        include __DIR__ . '/views/show-forms.php';
    }

    public function createForm(): void
    {
        include __DIR__ . '/views/create-form.php';
    }
}
