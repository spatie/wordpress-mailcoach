<?php

namespace Spatie\WordPressMailcoach\Admin;

use Spatie\MailcoachSdk\Mailcoach;

class Admin
{
    private Mailcoach $mailcoach;

    public function __construct()
    {
        $apiToken = get_option('mailcoach_api_key');
        $endpoint = get_option('mailcoach_domain');

        if (! $apiToken || ! $endpoint) {
            // @todo
        }

        $this->mailcoach = new Mailcoach($apiToken, $endpoint);
    }

    public function add_hooks()
    {
        add_action( 'admin_init', fn() => $this->load_scripts());
        add_action( 'wp_enqueue_scripts', fn() => $this->load_scripts());

        add_action('admin_menu', fn() => $this->create_menu());

        add_action( 'admin_post_nopriv_process_form', fn() => $this->submit_api_key());
        add_action( 'admin_post_process_form', fn() => $this->submit_api_key());
    }

    public function create_menu()
    {
        add_menu_page(
            __('Mailcoach'),
            __('Mailcoach'),
            'manage_options',
            'wp-mailcoach',
            function () { $this->add_api_keys_callback(); }
        );
    }

    public function load_content()
    {
        // @todo tried to move html to separate file; not working
        // @todo investigate for boilerplate on OOP approach attempt?

        echo file_get_contents( plugins_url( 'views/settings.php', __FILE__ ) );
    }

    public function load_scripts()
    {
        // @todo move to functions.php
        static $base = null;
        if ( $base === null ) {
            $base = plugins_url( '/', MAILCOACH_PLUGIN_FILE );
        }

        wp_register_style( 'mailcoach_admin_css', $base . 'assets/admin/css/mailcoach.css' );
        wp_enqueue_style( 'mailcoach_admin_css' );
    }

    // The admin page containing the form
    function add_api_keys_callback()
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

            <?php $this->show_email_lists()?>
        </div>
        <?php
    }

    function show_email_lists()
    {
        ?><h2>Email Lists</h2><?php
        foreach ($this->email_lists() as $emailList) {
            ?>
            <p>
                Name:<span class="background-blue"><?php echo $emailList->name ?></span><br />
                <span>Active subscribers: <?php echo $emailList->activeSubscribersCount ?></span>
            </p>
            <?php
        }
    }

    function submit_api_key()
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

    function email_lists()
    {
        return $this->mailcoach->emailLists();
    }
}
