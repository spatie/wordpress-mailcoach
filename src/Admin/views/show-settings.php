<section>
    <div>
        <form class="card-grid" method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
            <fieldset class="card form-grid max-w-[50%]">
                <div class="flex-none flex">
                    <h1 class="mt-1 markup-h1 truncate text-3xl font-bold">Mailcoach API Settings</h1>
                </div>

                <p class="text-xs">
                    <?php echo esc_html__('You can create an API key on the Profile page of your account.', 'WordPress-mailcoach'); ?>
                </p>

                <div class="form-legend mt-8">
                </div>

                <div class="form-field">
                    <label class="label label-required" for="mailcoach_api_token">
                        API Token
                    </label>

                    <input autocomplete="off" type="text" name="mailcoach_api_token" id="mailcoach_api_token" placeholder="Enter API Key" class="input " required value="<?php echo anonymizeSensitiveDate(get_option('mailcoach_api_token')); ?>" label="API Token">
                </div>

                <div class="form-field mt-4">
                    <label class="label label-required" for="mailcoach_api_endpoint">
                        API Endpoint
                    </label>

                    <input autocomplete="off" type="url" name="mailcoach_api_endpoint" id="mailcoach_api_endpoint" class="input " placeholder="Enter Endpoint" required value="<?php echo get_option('mailcoach_api_endpoint'); ?>" label="API Endpoint">
                </div>

                <input type="hidden" name="action" value="store_settings_form">

                <div class="form-field mt-4">
                    <button type="submit" name="submit" id="submit" class="primary-button">
                        Update API Key
                    </button>
                </div>

            </fieldset>
        </form>
    </div>

</section>
