<?php

namespace Spatie\WordpressMailcoach\Admin;

// If this file is called directly, abort.
use Spatie\MailcoachSdk\Mailcoach;

if (! defined('ABSPATH')) {
    exit;
}

class Admin
{
    private Settings $settings;

    private Mailcoach $mailcoach;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
        $this->mailcoach = new Mailcoach($settings->apiToken(), $settings->apiDomain());
    }

    public function initializeHooks(): void
    {
        $this->settings->initializeHooks();

        add_action('admin_init', fn () => $this->loadScripts());
        add_action('wp_enqueue_scripts', fn () => $this->loadScripts());
    }

    public function loadScripts(): void
    {
        // @todo move to functions.php
        static $base = null;
        if ($base === null) {
            $base = plugins_url('/', MAILCOACH_PLUGIN_FILE);
        }

        wp_register_style('mailcoach_admin_css', $base . 'assets/admin/css/mailcoach.css');
        wp_enqueue_style('mailcoach_admin_css');
    }

    public function email_lists()
    {
        return $this->mailcoach->emailLists();
    }
}
