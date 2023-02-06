<?php

namespace Spatie\WordPressMailcoach\Admin;

use Spatie\MailcoachSdk\Mailcoach;
use Spatie\WordPressMailcoach\Admin\Settings;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class Forms
{
    private function __construct()
    {
    }

    public static function make(): self
    {
        return new self();
    }

    public function initializeHooks(): void
    {
        add_action('init', fn () => $this->showForm());
    }

    public function showForm()
    {
        include __DIR__ . '/views/preview-subscribe-form.php';
    }

    public function submit()
    {
        if (isset($_POST['form_email'])) {
            $email = sanitize_text_field($_POST['form_email']);
        }
    }
}
