<?php /** @var \Spatie\MailcoachSdk\Support\PaginatedResults $lists */ ?>
<?php /** @var string $basePathUI */ ?>

<h1 class="wp-heading-inline">Lists</h1>

<section class="wrap">
    <?php
    if (empty($lists->results())) {
        ?><p>No lists were found on your account.</p><?php
    }

    if (! empty($lists->results())) {
        $headers = ['Name', 'Subscribers'];
        ?>

        <table class="wp-list-table widefat fixed striped table-view-list postso">
            <thead>
            <tr>
                <?php foreach ($headers as $header) {
                    echo "<th>{$header}</th>";
                } ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($lists->results() as $list) {
                //$created = wp_date(get_option('date_format'), strtotime($list->attributes['created_at']));
                $linkToMailcoach = $basePathUI . '/email-lists/' . $list->attributes['uuid'] . '/summary';

                echo "<tr>";
                echo "<td><a href='{$linkToMailcoach}' target='_blank'>{$list->attributes['name']}</a></td>";
                echo "<td>{$list->attributes['active_subscribers_count']}</td>";
                echo "</tr>";
            } ?>
            </tbody>
        </table>

        <?php
    }
?>
</section>
