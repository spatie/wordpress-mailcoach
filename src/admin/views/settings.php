<div class="wrap"><div id="icon-tools" class="icon32"></div>
    <h2>My API Keys Page</h2>
    <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="POST">
        <h3>Your API Key</h3>
        <input type="text" name="api_key" placeholder="Enter API Key">
        <input type="hidden" name="action" value="process_form">
        <input type="submit" name="submit" id="submit" class="update-button button button-primary" value="Update API Key"  />
    </form>
</div>











<div class="mailcoach-admin">

    <!-- Main Content -->
    <div class="main-content">

        <h1>
            Mailcoach for WordPress
        </h1>

        <form action="<?php echo admin_url( 'options.php' ); ?>" method="post">
            <?php settings_fields( 'mc4wp_settings' ); ?>

            <table class="form-table">

                <tr valign="top">
                    <th scope="row">
                        <?php echo esc_html__( 'Status', 'mailchimp-for-wp' ); ?>
                    </th>
                    <td>
                        <?php
                        if ( $connected ) {
                            ?>
                            <span class="mc4wp-status positive"><?php echo esc_html__( 'CONNECTED', 'mailchimp-for-wp' ); ?></span>
                            <?php
                        } else {
                            ?>
                            <span class="mc4wp-status neutral"><?php echo esc_html__( 'NOT CONNECTED', 'mailchimp-for-wp' ); ?></span>
                            <?php
                        }
                        ?>
                    </td>
                </tr>


                <tr valign="top">
                    <th scope="row"><label for="mailchimp_api_key"><?php echo esc_html__( 'API Key', 'mailchimp-for-wp' ); ?></label></th>
                    <td>
                        <input type="text" class="widefat" placeholder="<?php echo esc_html__( 'Your Mailchimp API key', 'mailchimp-for-wp' ); ?>" id="mailchimp_api_key" name="mc4wp[api_key]" value="<?php echo esc_attr( $obfuscated_api_key ); ?>" <?php echo defined( 'MC4WP_API_KEY' ) ? 'readonly="readonly"' : ''; ?> />
                        <p class="description">
                            <?php echo esc_html__( 'The API key for connecting with your Mailchimp account.', 'mailchimp-for-wp' ); ?>
                            <a target="_blank" href="https://admin.mailchimp.com/account/api"><?php echo esc_html__( 'Get your API key here.', 'mailchimp-for-wp' ); ?></a>
                        </p>

                        <?php
                        if ( defined( 'MC4WP_API_KEY' ) ) {
                            echo '<p class="description">', wp_kses( __( 'You defined your Mailchimp API key using the <code>MC4WP_API_KEY</code> constant.', 'mailchimp-for-wp' ), array( 'code' => array() ) ), '</p>';
                        }
                        ?>
                    </td>

                </tr>

            </table>

            <?php submit_button(); ?>

        </form>

    </div>

    <!-- Sidebar -->
    <div class="mailcoach-admin-sidebar">
    </div>

</div>
