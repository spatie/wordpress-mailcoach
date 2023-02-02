<?php

namespace Spatie\WordpressMailcoach\Admin;

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

        require_once plugin_dir_path(__DIR__) . 'Admin/MailcoachApi.php';
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
        add_action('wp_enqueue_scripts', fn () => $this->loadScripts());

        add_action('admin_menu', fn () => $this->createMenu());
        add_action('admin_menu', fn () => $this->createFormsSubMenu());
    }

    public function loadScripts(): void
    {
        wp_register_style('mailcoach_admin_css', plugin_dir_url(__FILE__) . 'css/mailcoach.css');
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
            //var_dump($lists->results()[0]->attributes['name']);die;

            include __DIR__ . '/views/show-email-lists.php';
        }
    }

    public function createFormsSubPage(): void
    {
        echo '<h2>Forms</h2>';
        echo '<p>Hola</p>';
    }
}
