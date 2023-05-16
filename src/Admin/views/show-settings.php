<?php
/** @var string $apiToken */
/** @var string $apiEndpoint */
?>

<div class="wrap">
    <h1>Mailcoach Settings</h1>
    <p class="text-xs">
        <?php echo esc_html('You can create an API key on the Profile page of your account.'); ?>
    </p>
    <form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <input type="hidden" name="action" value="store_settings_form">
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row"><label for="mailcoach_api_token">API Token</label></th>
                    <td>
                        <input name="mailcoach_api_token" type="text" id="mailcoach_api_token" value="<?php echo esc_html($apiToken) ?>" placeholder="Enter API Token" class="regular-text" required>
                        <p class="description">You can find this in the settings of your Mailcoach profile.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="mailcoach_api_endpoint">Mailcoach URL</label></th>
                    <td>
                        <input name="mailcoach_api_endpoint" type="url" id="mailcoach_api_endpoint" value="<?php echo esc_html($apiEndpoint) ?>" placeholder="Enter URL" class="regular-text" required>
                        <p class="description">The base URL of your Mailcoach instance,<br/>when using Mailcoach Cloud this is <code>https://&lt;your-team-url&gt;.mailcoach.app</code>.</p>
                    </td>
                </tr>
            </tbody>
        </table>

        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
    </form>
</div>
