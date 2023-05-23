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
                <?php foreach ($headers as $header) { ?>
                    <th><?php echo esc_html($header) ?></th>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($lists->results() as $list) { ?>
                <?php $linkToMailcoach = esc_url($basePathUI . '/email-lists/' . $list->attributes['uuid'] . '/summary'); ?>
                <tr>
                    <td><a href="<?php echo esc_url($linkToMailcoach) ?>" target="_blank"><?php echo esc_html($list->attributes['name']) ?></a></td>
                    <td><?php echo esc_html($list->attributes['active_subscribers_count']) ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

        <?php
    }
?>
</section>
