<?php /** @var \Spatie\WordPressMailcoach\Front\ViewModel\ShowSubscribeViewModel $view */ ?>
<form
    method="POST"
    action="<?php echo $view->form->actionUrl(); ?>">

    <input type="hidden" name="redirect_after_subscribed" value=<?php echo"{$view->currentUrl()}?status=subscribed"; ?>>
    <input type="hidden" name="redirect_after_subscription_pending" value=<?php echo"{$view->currentUrl()}?status=pending"; ?>>
    <input type="hidden" name="redirect_after_already_subscribed" value=<?php echo"{$view->currentUrl()}?status=already_subscribed"; ?>>

    <input type="hidden" name="action" value="process_subscribe_form" />

    <?php echo $view->form->content; ?>

    <!-- TODO: Messages (+customizable) -->
    <?php if (isset($_GET['status']) && $_GET['status'] === 'subscribed') { ?>
        <p class="mailcoach-subscribe-success">You have been subscribed!</p>
    <?php } ?>

</form>
