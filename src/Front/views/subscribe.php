<?php /** @var \Spatie\WordPressMailcoach\Admin\Model\Form $form */ ?>
<form
    method="POST"
    action="<?php echo $form->actionUrl(); ?>">

    <?php
        global $wp;

$currentUrl = home_url(add_query_arg([], $wp->request));
?>

    <input type="hidden" name="redirect_after_subscribed" value=<?php echo"{$currentUrl}?status=subscribed"; ?>>
    <input type="hidden" name="redirect_after_subscription_pending" value=<?php echo"{$currentUrl}?status=pending"; ?>>
    <input type="hidden" name="redirect_after_already_subscribed" value=<?php echo"{$currentUrl}?status=already_subscribed"; ?>>

    <input type="hidden" name="action" value="process_subscribe_form" />
    <?php wp_nonce_field('mailcoach_subscribe_nonce', 'mailcoach_subscribe_nonce'); ?>

    <?php echo $form->content; ?>

    <!-- TODO: Messages (+customizable) -->
    <?php if (isset($_GET['status']) && $_GET['status'] === 'subscribed') { ?>
        <p class="mailcoach-subscribe-success">You have been subscribed!</p>
    <?php } ?>

</form>
