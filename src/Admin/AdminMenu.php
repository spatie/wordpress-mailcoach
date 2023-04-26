<?php

namespace Spatie\WordPressMailcoach\Admin;

use Spatie\WordPressMailcoach\Admin\ValueObject\Settings;
use Spatie\WordPressMailcoach\Includes\Api\MailcoachApi;
use Spatie\WordPressMailcoach\Support\HasHooks;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class AdminMenu implements HasHooks
{
    private SettingsController $settingsController;

    private FormsController $formsController;

    private MailcoachApi $mailcoach;

    private function __construct(private Settings $settings)
    {
        $this->settingsController = SettingsController::make($settings);
        $this->mailcoach = MailcoachApi::fromSettings($settings);
        $this->formsController = FormsController::make($this->mailcoach);
    }

    public static function make(Settings $settings): self
    {
        return new self($settings);
    }

    public function initializeHooks(): void
    {
        $this->settingsController->initializeHooks();
        $this->formsController->initializeActionHooks();

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

            $basePathUI = mailcoachTenantUrl($this->settings);

            include __DIR__ . '/views/show-email-lists.php';
        }
    }

    public function createFormsSubPage(): void
    {
        $this->formsController->initializeHooks();
        $this->formsController->indexForms();
    }

    public function createAddFormSubPage(): void
    {
        $this->formsController->initializeHooks();
        $this->formsController->createForm();
    }

    public function createEditFormSubPage(): void
    {
        $this->formsController->initializeHooks();
        $this->formsController->editForm();
    }
}
