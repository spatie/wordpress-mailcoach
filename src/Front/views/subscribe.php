<?php /** @var \Spatie\WordPressMailcoach\Admin\Model\Form $form */ ?>
<form
    method="POST"
    action="https://spatie.mailcoach.app/subscribe/<list-uuid>">
    <!-- TODO: Mailcoach URL + List uuid ^ -->

    <!-- TODO: Current url -->
    <input type="hidden" name="redirect_after_subscribed" value="<current_url>?status=subscribed">
    <input type="hidden" name="redirect_after_subscription_pending" value="<current_url>?status=pending">
    <input type="hidden" name="redirect_after_already_subscribed" value="<current_url>?status=already_subscribed">

    <input type="hidden" name="action" value="process_subscribe_form" />
    <?php wp_nonce_field('mailcoach_subscribe_nonce', 'mailcoach_subscribe_nonce'); ?>

    <?php echo $form->content; ?>

    <!-- TODO: Messages (+customizable) -->
    <?php if ($_GET['status'] === 'subscribed'): ?>
        <p class="mailcoach-subscribe-success">You have been subscribed!</p>
    <?php endif; ?>

</form>
