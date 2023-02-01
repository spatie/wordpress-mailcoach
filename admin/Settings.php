<?php

namespace Spatie\WordpressMailcoach\Admin;

class Settings
{
    private string $apiToken = '';
    private string $apiDomain = '';

    public function initializeHooks()
    {
        add_action('admin_init', fn() => $this->initializeSettings());
        add_action('admin_menu', fn() => $this->createMenu());

        add_action('admin_post_nopriv_process_form', fn() => $this->submitSettings());
        add_action('admin_post_process_form', fn() => $this->submitSettings());
    }

    public function createMenu()
    {
        add_menu_page(
            __('Mailcoach'),
            __('Mailcoach'),
            'manage_options',
            'mailcoach-settings',
            fn () => $this->showSettingsMenu(),
            'dashicons-smiley',
        );
    }

    public function initializeSettings()
    {
        $this->apiToken = get_option('MAILCOACH_API_TOKEN');
        $this->apiDomain = get_option('MAILCOACH_API_DOMAIN');
    }

    function showSettingsMenu()
    {
        ?>
        <div class="wrap"><div id="icon-tools" class="icon32"></div>
            <h2>Mailcoach API Key</h2>
            <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="POST">
                <input type="text" name="mailcoach_api_key" placeholder="Enter API Key"  size="45" value="<?php echo get_option('mailcoach_api_key'); ?>">
                <br /><br />
                <input type="url" name="mailcoach_domain" placeholder="Enter Domain"  size="45" value="<?php echo get_option('mailcoach_domain'); ?>">
                <input type="hidden" name="action" value="process_form">
                <br /><br />
                <input type="submit" name="submit" id="submit" class="update-button button button-primary" value="Update API Key"  />
            </form>
        </div>
        <?php
    }

    function submitSettings()
    {
        if (isset($_POST['mailcoach_api_key'])) {
            $api_key = sanitize_text_field( $_POST['mailcoach_api_key'] );
            $api_exists = get_option('mailcoach_api_key');

            if (!empty($api_key) && !empty($api_exists)) {
                update_option('mailcoach_api_key', $api_key);
            } else {
                add_option('mailcoach_api_key', $api_key);
            }
        }

        if (isset($_POST['mailcoach_domain'])) {
            $api_key = sanitize_text_field( $_POST['mailcoach_domain'] );
            $api_exists = get_option('mailcoach_domain');

            if (!empty($api_key) && !empty($api_exists)) {
                update_option('mailcoach_domain', $api_key);
            } else {
                add_option('mailcoach_domain', $api_key);
            }
        }

        wp_redirect($_SERVER['HTTP_REFERER']);
    }

    public function apiToken()
    {
        return $this->apiToken;
    }

    public function apiDomain()
    {
        return $this->apiDomain;
    }
}
