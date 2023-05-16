<?php /** @var \Spatie\WordPressMailcoach\Front\ViewModel\ShowSubscribeViewModel $view */ ?>

<form
    method="POST"
    action="<?php echo $view->form->actionUrl(); ?>">

    <input type="hidden" name="redirect_after_subscribed" value=<?php echo esc_url($view->endpoints()['subscribed']); ?>>
    <input type="hidden" name="redirect_after_subscription_pending" value=<?php echo esc_url($view->endpoints()['pending']); ?>>
    <input type="hidden" name="redirect_after_already_subscribed" value=<?php echo esc_url($view->endpoints()['already_subscribed']); ?>>

    <input type="hidden" name="action" value="process_subscribe_form" />

    <input type="text" name="mailcoach-unique-name-827" style="display: none; tab-index: -1;" />

    <?php if (! $view->isProcessed()) {
        echo $view->form->content;
    } ?>

    <?php if ($view->isProcessed()) { ?>
        <p class="mailcoach-subscribe-status"><?php echo esc_html($view->submitMessage()) ?></p>
    <?php } ?>
</form>
