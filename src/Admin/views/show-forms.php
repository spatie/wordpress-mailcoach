<section class="flex-grow min-w-0 flex flex-col">
    <div class="flex-none flex">
        <h1 class="mt-1 markup-h1 truncate text-xl font-bold">Forms</h1>
    </div>

    <a href="<?php echo esc_url(admin_url('admin.php?page=mailcoach-add-form')); ?>">
        <button type="submit" name="submit" id="submit" class="primary-button mt-1">
            Add New
        </button>
    </a>

    <?php
    $headers = ['Name', 'Shortcode', 'Email List', 'Date'];

    /** @var \Spatie\WordPressMailcoach\Admin\Model\Form[] $forms */
    ?>

    <div class="card p-0 pb-24 md:pb-0 overflow-x-auto md:overflow-visible">
        <table class="table-styled table-auto">
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
                echo "<td><input type='text' readonly='readonly' value='{$form->shortcode}' class='large-text code'></td>";
                echo "<td>{$form->emailList->name}</td>";
                echo "<td>{$form->createdAt()}</td>";
                echo "</tr>";
            } ?>
            </tbody>
        </table>
    </div>
</section>
