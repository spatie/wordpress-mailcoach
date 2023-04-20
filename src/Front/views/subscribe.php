<?php /** @var \Spatie\WordPressMailcoach\Admin\Model\Form $form */ ?>
<form
    method="POST"
    action="<?php echo esc_url(admin_url('admin-post.php')); ?>">

    <input type="hidden" name="action" value="process_subscribe_form" />
    <?php wp_nonce_field('mailcoach_subscribe_nonce', 'mailcoach_subscribe_nonce'); ?>

    <?php echo $form->content; ?>

</form>
