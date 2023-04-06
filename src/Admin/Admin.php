<?php

namespace Spatie\WordPressMailcoach\Admin;

use Spatie\WordPressMailcoach\Support\HasHooks;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class Admin implements HasHooks
{
    private Settings $settings;

    private MailcoachApi $mailcoach;

    private Forms $forms;

    private function __construct(Settings $settings)
    {
        $this->settings = $settings;
        $this->mailcoach = MailcoachApi::fromSettings($settings);
        $this->forms = Forms::make($this->mailcoach);
    }

    public static function fromSettings(Settings $settings): Admin
    {
        return new self($settings);
    }

    public function initializeHooks(): void
    {
        $this->settings->initializeHooks();
        $this->mailcoach->initializeHooks();
        $this->forms->initializeActionHooks();

        add_action('admin_init', fn () => $this->loadScripts());
        add_action('wp_enqueue_scripts', fn () => $this->loadScripts(), 999);
        add_action('enqueue_block_editor_assets', fn () => $this->loadScripts());

        add_action('admin_menu', fn () => $this->createMenu());
        add_action('admin_menu', fn () => $this->createFormsSubMenu());
    }

    public function loadScripts(): void
    {
        //wp_register_style('mailcoach_admin_css', plugin_dir_url(__DIR__) . '../resources/dist/css/tailwind.min.css');
        //wp_enqueue_style('mailcoach_admin_css');
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

        add_submenu_page(
            'mailcoach',
            __('Add Form', 'mailcoach'),
            __('Add Form', 'mailcoach'),
            'manage_options',
            'mailcoach-add-form',
            fn () => $this->createAddFormSubPage(),
        );

        // Hidden pages

        add_submenu_page(
            null,
            __('Edit Form', 'mailcoach'),
            __('Edit Form', 'mailcoach'),
            'manage_options',
            'mailcoach-edit-form',
            fn () => $this->createEditFormSubPage(),
        );
    }

    public function createHomepage(): void
    {
        include __DIR__ . '/views/show-settings.php';

        if ($this->mailcoach->hasCredentials()) {
            $lists = $this->mailcoach->emailLists();

            // @todo handle failed API calls properly

            $basePathUI = substr($this->settings->apiEndpoint(), 0, strpos($this->settings->apiEndpoint(), '.app') + 4);

            // @todo replace with ViewModel

            include __DIR__ . '/views/show-email-lists.php';
        }
    }

    public function createFormsSubPage(): void
    {
        $this->forms->initializeHooks();
        $this->forms->indexForms();
    }

    public function createAddFormSubPage(): void
    {
        $this->forms->initializeHooks();
        $this->forms->createForm();
    }

    public function createEditFormSubPage(): void
    {
        $this->forms->initializeHooks();
        $this->forms->editForm();
    }
}
