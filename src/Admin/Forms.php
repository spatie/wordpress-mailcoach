<?php

namespace Spatie\WordPressMailcoach\Admin;

use Spatie\WordPressMailcoach\Support\HasHooks;

use function Sodium\add;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class Forms implements HasHooks
{
    private function __construct(private MailcoachApi $mailcoach)
    {
    }

    public static function make(MailcoachApi $mailcoach): self
    {
        return new self($mailcoach);
    }

    public function initializeActionHooks(): void
    {
        add_action('admin_post_create_new_form', fn () => $this->storeForm());
    }

    public function initializeHooks(): void
    {
        add_action('init', fn () => $this->showForm());
        add_action('init', fn () => $this->createForm());
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
        /** @var array{uuid: string, name: string} $emailLists */
        $emailLists = [];
        foreach ($this->mailcoach->emailLists()->results() as $list) {
            $emailLists[] = ['uuid' => $list->uuid, 'name' => $list->name];
        }

        include __DIR__ . '/views/create-form.php';
    }

    public function storeForm(): void
    {
        echo 'hello world';
//        wp_redirect($_SERVER['HTTP_REFERER']);
    }
}
