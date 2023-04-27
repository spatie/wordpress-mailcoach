<?php /** @var \Spatie\WordPressMailcoach\Admin\ViewModel\IndexFormsViewModel $view */ ?>

<?php if ($view->isApiSetup()) { ?>
    <section class="wrap">
        <h1 class="wp-heading-inline">
            Forms
        </h1>
        <a href="<?php echo esc_url(admin_url('admin.php?page=mailcoach-add-form')); ?>" class="page-title-action">Add
            New</a>
        <hr class="wp-header-end">

        <table class="wp-list-table widefat fixed striped table-view-list posts">
            <thead>
            <tr>
                <?php foreach ($view->tableHeaders() as $header) {
                    echo "<th scope=\"col\" class=\"manage-column\">{$header}</th>";
                } ?>
            </tr>
            </thead>

            <tbody id="the-list">
                <?php if (count($view->forms())) { ?>
                    <?php foreach ($view->forms() as $form) { ?>
                        <tr class='format-standard'>
                        <td class='text-xs'><a href="<?= $form->editUrl() ?>"><?= $form->name ?></a></td>
                        <td><input type='text' readonly='readonly' value='[<?= $form->shortcode ?>]' class='large-text code'></td>
                        <td><?= $form->emailList?->name ?></td>
                        <td><?= $form->createdAt() ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <td colspan="<?= count($view->tableHeaders()) ?>">No forms yet.</td>
                <?php } ?>
            </tbody>

            <tfoot>
                <tr>
                    <?php foreach ($view->tableHeaders() as $header) {
                        echo "<th scope=\"col\" class=\"manage-column\">{$header}</th>";
                    } ?>
                </tr>
            </tfoot>

        </table>
    </section>
<?php } else { ?>
    <div class="notice notice-error" style="margin-left: 0;">
        <p>Your Mailcoach credentials have not been set up yet. <a href="<?= admin_url('admin.php?page=mailcoach') ?>">You
                can do this here</a></p>
    </div>
<?php } ?>
