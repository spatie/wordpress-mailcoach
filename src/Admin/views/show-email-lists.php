<?php /** @var \Spatie\MailcoachSdk\Support\PaginatedResults $lists */ ?>
<?php /** @var string $basePathUI */ ?>

<section class="flex-grow min-w-0 flex flex-col">
    <div class="flex-none flex">
        <h1 class="mt-8 markup-h1 truncate text-xl font-bold">Lists</h1>
    </div>

    <?php
    if (empty($lists->results())) {
        ?><p>No lists were found on your account.</p><?php
    }

    if (! empty($lists->results())) {
        $headers = ['Name', 'ID', 'Subscribers', 'Created At'];
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
                <?php foreach ($lists->results() as $list) {
                    $created = wp_date(get_option('date_format'), strtotime($list->attributes['created_at']));
                    $linkToMailcoach = $basePathUI . '/email-lists/' . $list->attributes['uuid'] . '/summary';

                    echo "<tr>";
                    echo "<td><a href='{$linkToMailcoach}' target='_blank'>{$list->attributes['name']}</a></td>";
                    echo "<td class='text-xs'>{$list->attributes['uuid']}</td>";
                    echo "<td>{$list->attributes['active_subscribers_count']}</td>";
                    echo "<td>{$created}</td>";
                    echo "</tr>";
                } ?>
                </tbody>
            </table>
        </div>

        <?php
    }
?>
</section>
