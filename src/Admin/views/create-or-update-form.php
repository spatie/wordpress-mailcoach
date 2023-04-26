<?php
/** @var \Spatie\WordPressMailcoach\Admin\ViewModel\CreateOrUpdateFormViewModel $view */
?>

<form class="card-grid" method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
    <input type="hidden" name="action" value="create_new_form">
    <?php wp_nonce_field('create_new_form', 'mailcoach_create_new_form_nonce'); ?>

    <section class="flex-grow min-w-0 flex flex-col">
        <div class="flex-none flex">
            <h1 class="mt-1 markup-h1 truncate text-xl font-bold"><?php echo $view->pageTitle(); ?></h1>
        </div>

        <div>
            <label for="name">Name</label>
            <input type="text" name="name" size="30" value="<?php echo $view->formName(); ?>" id="name" spellcheck="true" autocomplete="off">
        </div>

        <?php
        if ($view->showShortcode()) {
            ?>
            <div>
                <p>
                    <label for="shortcode">Copy this shortcode and paste it into your post, page, or text widget content</label>
                    <span>
                <input type="text" id="shortcode" readonly="readonly" class="large-text code" value="[<?php echo $view->form->shortcode; ?>]">
            </span>
                </p>
            </div>
            <?php
        }
?>

        <p id="mailcoach-external-form-subscriptions-warning"></p>

        <label for="email-list">Choose a list</label>
        <select name="email-list" id="email-list">

        <?php
/** @var \Spatie\MailcoachSdk\Resources\EmailList $list */
foreach ($view->emailLists() as $list) {
    echo "<option value='{$list->uuid}'";

    if ($list->uuid === $view->selectedEmailList()) {
        echo " selected";
    }
    echo ">{$list->name}</option>";
}
?>

            <script>
                if (verifyIfSelectedOptionsHasExternalFormSubscriptionsEnabled()) {
                    addWarning();
                } else {
                    removeWarning();
                }

                document.getElementById("email-list").addEventListener("change", function() {
                    if (verifyIfSelectedOptionsHasExternalFormSubscriptionsEnabled()) {
                        addWarning();
                    } else {
                        removeWarning();
                    }
                });

                function getSelectedOption() {
                    const emailList = document.getElementById("email-list");
                    const selectedOption = emailList.options[emailList.selectedIndex];

                    return selectedOption.text;
                }

                function verifyIfSelectedOptionsHasExternalFormSubscriptionsEnabled() {
                    let enabledLists = <?php echo json_encode($view->enabledEmailListNames(), 1); ?>;

                    const selectedOptionText = getSelectedOption();

                    return ! enabledLists.includes(selectedOptionText);
                }

                function addWarning() {
                    let warning = document.getElementById('mailcoach-external-form-subscriptions-warning');

                    warning.innerHTML = 'External form subscriptions are not enabled for this list. Please enable them in the Mailcoach dashboard.'
                }

                function removeWarning() {
                    let warning = document.getElementById('mailcoach-external-form-subscriptions-warning');

                    warning.innerHTML = '';
                }
            </script>

        <textarea cols="100" rows="12" id="content" name="content" class="large-text code" data-config-field="form.body"><?php
if ($view->isEditMode()) {
    echo $view->form->content;
} else {
    echo '<label class="label label-required" for="email">Email</label>

<input autocomplete="email" type="email" name="email" id="email" required label="Email" />

<button type="submit" name="mailcoach_subscribe_submit" id="submit">Subscribe</button>';
}?></textarea>
    </section>
    <section>
        <div>
            <h2>Messages</h2>

            <p>
                <label for="mailcoach-message-subscribed">Message when subscribed<br>
                    <input type="text" size="70" name="message-subscribed" id="mailcoach-message-subscribed" value="<?php echo $view->messages()->subscribed ?>">
                </label>
            </p>

            <p>
                <label for="mailcoach-message-pending">Message when pending subscription<br>
                    <input type="text" size="70" name="message-pending" id="mailcoach-message-pending" value="<?php echo $view->messages()->pending ?>">
                </label>
            </p>

            <p>
                <label for="mailcoach-message-already-subscribed">Message when already subscribed<br>
                    <input type="text" size="70" name="message-already-subscribed" id="mailcoach-message-already-subscribed" value="<?php echo $view->messages()->alreadySubscribed ?>">
                </label>
            </p>
        </div>
    </section>

    <button type="submit" name="submit" id="submit" class="button-primary">
        Save
    </button>
</form>

<?php
if ($view->isEditMode()) {
    include __DIR__ . '/delete-form.php';
}
?>
