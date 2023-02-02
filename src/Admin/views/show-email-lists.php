<hr>
<h3>Lists</h3>

<?php
if (empty($lists->results())) {
    ?><p>No lists were found on your account.</p><?php
}

if (! empty($lists->results())) {
    $headers = ['Name', 'Active Subscribers', 'Created At'];
    ?>
        <div class="card p-0 pb-24 md:pb-0 overflow-x-auto md:overflow-visible">
            <table class="table-styled w-full">
                <thead>
                    <tr>
                        <?php foreach ($headers as $header) {
                            echo "<th>{$header}</th>";
                        } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lists->results() as $list) {
                        $created = wp_date(get_option( 'date_format' ), strtotime($list->attributes['created_at']));

                        echo "<tr>";
                        echo "<td>{$list->attributes['name']}</td>";
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
