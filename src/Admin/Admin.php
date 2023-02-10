<?php

namespace Spatie\WordPressMailcoach\Admin;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class Admin
{
    private Settings $settings;

    private MailcoachApi $mailcoach;

    private function __construct(Settings $settings)
    {
        $this->settings = $settings;
        $this->mailcoach = MailcoachApi::fromSettings($settings);
    }

    public static function fromSettings(Settings $settings): Admin
    {
        return new self($settings);
    }

    public function initializeHooks(): void
    {
        $this->settings->initializeHooks();

        add_action('admin_init', fn () => $this->loadScripts());
        add_action('wp_enqueue_scripts', fn () => $this->loadScripts(), 999);
        add_action('enqueue_block_editor_assets', fn () => $this->loadScripts());

        add_action('admin_menu', fn () => $this->createMenu());
        add_action('admin_menu', fn () => $this->createFormsSubMenu());

        add_action('template_redirect', 'createSubscriberFromShortCode');
    }

    public function createSubscriberFromShortCode(): void
    {
        var_dump("ok");
        die;
        if (! isset($_POST['mailcoach_subscribe_submit']) || ! isset($_POST['mailcoach_subscribe_nonce'])) {
            return;
        }

        if (! wp_verify_nonce($_POST['mailcoach_subscribe_nonce'], 'faire-don')) {
            return;
        }

        if (isset($_POST['email_list_uuid'])) {
            return;
        }

        $emailListUuid = sanitize_text_field($_POST['email_list_uuid']);

        $attributes = [];
        foreach ($_POST as $key => $value) {
            if (in_array($key, ['_wp_http_referer', 'mailcoach_subscribe_nonce', 'mailcoach_subscribe_submit', 'email_list_uuid'])) {
                continue;
            }

            $attributes[$key] = sanitize_text_field($value);
        }

        $this->mailcoach->createSubscriber($emailListUuid, $attributes);
    }

    public function loadScripts(): void
    {
        wp_register_style('mailcoach_admin_css', plugin_dir_url(__DIR__) . '../resources/dist/css/tailwind.min.css');
        wp_enqueue_style('mailcoach_admin_css');
    }

    public function createMenu(): void
    {
        add_menu_page(
            __('Mailcoach'),
            __('Mailcoach'),
            'manage_options',
            'mailcoach',
            fn () => $this->createHomepage(),
            'dashicons-email',
        );
    }

    public function createFormsSubMenu(): void
    {
        add_submenu_page(
            'mailcoach',
            __('Forms', 'mailcoach'),
            __('Forms', 'mailcoach'),
            'manage_options',
            'mailcoach-forms',
            fn () => $this->createFormsSubPage(),
        );
    }

    public function createHomepage(): void
    {
        include __DIR__ . '/views/show-settings.php';

        if ($this->mailcoach->hasCredentials()) {
            $lists = $this->mailcoach->emailLists();
            include __DIR__ . '/views/show-email-lists.php';
        }
    }

    public function createFormsSubPage(): void
    {
        $forms = Forms::make();
        $forms->initializeHooks();
        $forms->showForm();
    }
}
