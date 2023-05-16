<?php
/** @var \Spatie\WordPressMailcoach\Admin\ViewModel\CreateOrUpdateFormViewModel $view */
?>

<script>
    document.getElementById('toplevel_page_mailcoach').classList.remove('wp-not-current-submenu');
    document.getElementById('toplevel_page_mailcoach').classList.add('wp-has-current-submenu');

    document.querySelector('#toplevel_page_mailcoach > a').classList.remove('wp-not-current-submenu');
    document.querySelector('#toplevel_page_mailcoach > a').classList.add('wp-has-current-submenu', 'wp-menu-open');
    document.querySelector('#toplevel_page_mailcoach li:nth-child(3)').classList.add('current');
</script>

<div class="wrap">
    <?php if ($view->isSaved()) { ?>
        <div class="notice notice-success">
            <p>Form saved successfully</p>
        </div>
    <?php } ?>

    <h1 id="add-new-user"><?php echo $view->pageTitle() ?></h1>

    <form class="validate" method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <input type="hidden" name="action" value="create_new_form">
        <?php wp_nonce_field('create_new_form', 'mailcoach_create_new_form_nonce'); ?>

        <table class="form-table" role="presentation">
            <tbody>
                <tr class="form-field form-required">
                    <th scope="row"><label for="name">Name</label></th>
                    <td><input name="name" type="text" id="name" value="<?php echo $view->formName() ?>" aria-required="true" size="30" required></td>
                </tr>

                <?php if ($view->showShortcode()) { ?>
                    <tr class="form-field form-required">
                        <th scope="row"><label for="shortcode">Shortcode</label></th>
                        <td><input name="shortcode" type="text" id="shortcode" value="<?php echo $view->form->shortcode ?>" readonly></td>
                    </tr>
                <?php } ?>

                <tr class="form-field">
                    <th scope="row"><label for="email-list">Email list</label></th>
                    <td>
                        <select name="email-list" id="email-list">
                            <?php foreach ($view->emailLists() as $emailList) { ?>
                                <option
                                    <?php echo $emailList->uuid === $view->selectedEmailList() ? 'selected' : '' ?>
                                    value="<?php echo $emailList->uuid ?>"
                                ><?php echo $emailList->name ?></option>
                            <?php } ?>
                        </select>
                        <p id="mailcoach-external-form-subscriptions-warning" class="description notice notice-warning"></p>
                    </td>
                </tr>

                <tr class="form-field">
                    <th scope="row"><label for="content">Form</label></th>
                    <td>
                        <textarea cols="30" rows="12" id="content" name="content" class="large-text code" data-config-field="form.body"><?php if ($view->isEditMode()) { ?>
<?php echo $view->form->content ?>
<?php } else { ?>
<label class="label label-required" for="email">Email</label>

<input autocomplete="email" type="email" name="email" id="email" required label="Email" />

<button type="submit" name="mailcoach_subscribe_submit" id="submit">Subscribe</button>
<?php } ?></textarea>
                    </td>
                </tr>
            </tbody>
        </table>

        <h2>Messages</h2>

        <table class="form-table">
            <tbody>
                <tr class="form-field form-required">
                    <th scope="row"><label for="message-subscribed">Message when subscribed</label></th>
                    <td><input name="message-subscribed" type="text" id="message-subscribed" value="<?php echo $view->messages()->subscribed ?>" required></td>
                </tr>

                <tr class="form-field form-required">
                    <th scope="row"><label for="message-pending">Message when pending subscription</label></th>
                    <td><input name="message-pending" type="text" id="message-pending" value="<?php echo $view->messages()->pending ?>" required></td>
                </tr>

                <tr class="form-field form-required">
                    <th scope="row"><label for="message-already-subscribed">Message when already subscribed</label></th>
                    <td><input name="message-already-subscribed" type="text" id="message-already-subscribed" value="<?php echo $view->messages()->alreadySubscribed ?>" required></td>
                </tr>
            </tbody>
        </table>

        <input type="submit" name="submit" id="submit" class="button button-primary d-inline-block" value="Save">
    </form>
    <?php if ($view->isEditMode()) { ?>
        <div style="text-align: right; margin-top: -30px; margin-right: 45px;">
            <?php include __DIR__ . '/delete-form.php'; ?>
        </div>
    <?php } ?>
</div>

<script>
    document.getElementById('mailcoach-external-form-subscriptions-warning').style.display = 'none';

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
        warning.style.display = 'block';
    }

    function removeWarning() {
        let warning = document.getElementById('mailcoach-external-form-subscriptions-warning');

        warning.innerHTML = '';
        warning.style.display = 'none';
    }
</script>
