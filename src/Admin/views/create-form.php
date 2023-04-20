<?php
    /** @var \Spatie\WordPressMailcoach\Admin\ViewModel\CreateOrUpdateForm $view */
    ?>

<form class="card-grid" method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
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
                    <label for="shortcode">Copy this shortcode and paste it into your post, page, or text widget content:</label>
                    <span>
                <input type="text" id="shortcode" readonly="readonly" class="large-text code" value=<?php echo $view->form->shortcode; ?>>
            </span>
                </p>
            </div>
            <?php
            }
    ?>

        <label for="email-list">Choose a list</label>
        <select name="email-list" id="email-list">

        <?php
    foreach ($view->emailLists() as $list) {
        echo "<option value='{$list['uuid']}'";

        if ($list['uuid'] === $view->selectedEmailList()) {
            echo " selected";
        }
        echo ">{$list['name']}</option>";
    }
    ?>

        <textarea cols="100" rows="24" id="content" name="content" class="large-text code" data-config-field="form.body"><?php
    if ($view->isEditMode()) {
        echo $view->form->content;
    } else {
        echo '<label class="label label-required" for="email">Email</label>

<input autocomplete="email" type="email" name="email" id="email" required label="Email" />

<button type="submit" name="mailcoach_subscribe_submit" id="submit">Subscribe</button>';
    }?></textarea>

            <button type="submit" name="submit" id="submit" class="button-primary">
                Save
            </button>
    </section>
</form>
