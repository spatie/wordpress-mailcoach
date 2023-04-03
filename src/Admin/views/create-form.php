<?php /** @var array{uuid: string, name: string} $emailLists */ ?>

<form class="card-grid" method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
    <input type="hidden" name="action" value="create_new_form">
    <?php wp_nonce_field('create_new_form', 'mailcoach_create_new_form_nonce'); ?>

    <section class="flex-grow min-w-0 flex flex-col">
        <div class="flex-none flex">
            <h1 class="mt-1 markup-h1 truncate text-xl font-bold">Create Form</h1>
        </div>

        <div>
            <label for="title">Title</label>
            <input type="text" name="title" size="30" value="" id="title" spellcheck="true" autocomplete="off">
        </div>

        <label for="email-list">Choose a list</label>
        <select name="email-list" id="email-list">

        <?php
        foreach ($emailLists as $list) {
            echo "<option value='{$list['uuid']}'>{$list['name']}</option>";
        }
?>

        <textarea cols="100" rows="24" id="mailcoach-form-content" class="large-text code" data-config-field="form.body"><?php echo
        '<label class="label label-required" for="email">Email</label>

    <input autocomplete="email" type="email" name="email" id="email" required label="Email" />

    <button type="submit" name="mailcoach_subscribe_submit" id="submit">Subscribe</button>'; ?></textarea>

            <button type="submit" name="submit" id="submit" class="primary-button mt-1">
                Save
            </button>
    </section>
</form>
