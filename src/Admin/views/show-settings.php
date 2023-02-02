<div class="wrap"><div id="icon-tools" class="icon32"></div>
    <h2>Mailcoach API Key</h2>
    <p class="description">
        <?php echo esc_html__( 'You can create an API key on the Profile page of your account.', 'wordpress-mailcoach' ); ?>
    </p>
    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
        <label for="mailcoach_api_token">API Key</label>
        <input type="text" name="mailcoach_api_token" placeholder="Enter API Key"  size="45" value="<?php echo get_option('mailcoach_api_token'); ?>">
        <br /><br />
        <label for="mailcoach_api_endpoint">API Endpoint</label>
        <input type="url" name="mailcoach_api_endpoint" placeholder="Enter Endpoint"  size="45" value="<?php echo get_option('mailcoach_api_endpoint'); ?>">
        <input type="hidden" name="action" value="process_form">
        <br /><br />
        <input type="submit" name="submit" id="submit" class="update-button button button-primary" value="Update API Key"  />
    </form>
</div>
