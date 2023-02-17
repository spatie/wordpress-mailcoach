<section class="flex-grow min-w-0 flex flex-col">
    <div class="flex-none flex">
        <h1 class="mt-1 markup-h1 truncate text-xl font-bold">Forms</h1>
    </div>

    <a href="">
        <button type="submit" name="submit" id="submit" class="primary-button mt-1">
            Add New
        </button>
    </a>

    <?php
    $headers = ['Name', 'Shortcode', 'Author', 'Date'];
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
                $created = wp_date(get_option('date_format'), strtotime($form['created_at']));

                echo "<tr>";
                echo "<td class='text-xs'>{$form['name']}</td>";
                //echo "<td><input type='text' readonly='readonly' value='{$form['shortcode']}' class='large-text code'></td>";
                echo "<td>{$form['shortcode']}</td>";
                echo "<td>{$form['author']}</td>";
                echo "<td>{$created}</td>";
                echo "</tr>";
            } ?>
            </tbody>
        </table>
    </div>
</section>
