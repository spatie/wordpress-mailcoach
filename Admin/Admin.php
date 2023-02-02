<?php

namespace Spatie\WordpressMailcoach\Admin;

// If this file is called directly, abort.
use Spatie\WordPressMailcoach\MailcoachApi;

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

        require_once plugin_dir_path(__FILE__) . '../Admin/MailcoachApi.php';
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
    }

    public function loadScripts(): void
    {
        wp_register_style('mailcoach_admin_css', plugin_dir_url(__DIR__) . 'assets/admin/css/mailcoach.css');
        wp_enqueue_style('mailcoach_admin_css');
    }
}
