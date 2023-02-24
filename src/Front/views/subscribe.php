<form class="card-grid" method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
    <?php wp_nonce_field('faire-don', 'mailcoach_subscribe_nonce'); ?>

    <label class="label label-required" for="email">Email</label>
    <input autocomplete="email" type="email" name="email" id="email" required label="Email" />

    <input type="hidden" id="email_list_uuid" name="email_list_uuid" value="<?php echo $attributes['list'] ?>" />
    <input type="hidden" name="action" value="process_subscribe_form" />

    <button type="submit" name="mailcoach_subscribe_submit" id="submit">
        Subscribe
    </button>

    // Tags & honeypot field
</form>
