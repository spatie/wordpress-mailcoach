<h1 class="wp-heading-inline">Forms</h1>

<section class="wrap">
    <div class="tablenav top">
        <a href="<?php echo esc_url(admin_url('admin.php?page=mailcoach-add-form')); ?>">
            <button type="submit" name="submit" id="submit" class="button action">
                Add New
            </button>
        </a>
    </div>

    <?php
    $headers = ['Name', 'Shortcode', 'Email List', 'Date'];

        /** @var \Spatie\WordPressMailcoach\Admin\Model\Form[] $forms */
        ?>

    <table class="wp-list-table widefat fixed striped table-view-list posts">
        <thead>
        <tr>
            <?php foreach ($headers as $header) {
                echo "<th>{$header}</th>";
            } ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($forms as $form) {
            echo "<tr>";
            echo "<td class='text-xs'><a href={$form->editUrl()}>{$form->name}</a></td>";
            echo "<td><input type='text' readonly='readonly' value='[{$form->shortcode}]' class='large-text code'></td>";
            echo "<td>{$form->emailList->name}</td>";
            echo "<td>{$form->createdAt()}</td>";
            echo "</tr>";
        } ?>
        </tbody>
    </table>
</section>
