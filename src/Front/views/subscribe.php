<?php /** @var \Spatie\WordPressMailcoach\Front\ViewModel\ShowSubscribeViewModel $view */ ?>

<form
    method="POST"
    action="<?php echo $view->form->actionUrl(); ?>">

    <input type="hidden" name="redirect_after_subscribed" value=<?php echo $view->endpoints()['subscribed']; ?>>
    <input type="hidden" name="redirect_after_subscription_pending" value=<?php echo $view->endpoints()['pending']; ?>>
    <input type="hidden" name="redirect_after_already_subscribed" value=<?php echo $view->endpoints()['already_subscribed']; ?>>

    <input type="hidden" name="action" value="process_subscribe_form" />

    <input type="text" name="mailcoach-unique-name-827" style="display: none; tab-index: -1;" />

    <?php if (! $view->isProcessed()) {
        echo $view->form->content;
    } ?>

    <!-- TODO: Customizable messages -->
    <?php if ($view->isSubscribed()) { ?>
        <p class="mailcoach-subscribe-status">You have been subscribed!</p>
    <?php } ?>

    <?php if ($view->isPending()) { ?>
        <p class="mailcoach-subscribe-status">You have been subscribed. Check your email to verify!</p>
    <?php } ?>

    <?php if ($view->isAlreadySubscribed()) { ?>
        <p class="mailcoach-subscribe-status">You have already been subscribed!</p>
    <?php } ?>

</form>
