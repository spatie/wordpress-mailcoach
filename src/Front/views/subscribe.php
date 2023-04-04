<form class="card-grid" method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
    <input type="hidden" name="action" value="process_subscribe_form" />
    <?php wp_nonce_field('faire-don', 'mailcoach_subscribe_nonce'); ?>

    <?php echo $form->content; ?>

</form>
