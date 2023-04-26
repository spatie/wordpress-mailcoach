<?php

use Spatie\WordPressMailcoach\Admin\ValueObject\Settings;

include('custom-shortcodes.php');

function anonymizeSensitiveDate(string $input): string
{
    if ($input === '') {
        return '';
    }

    return str_repeat('*', strlen($input) - 4) . substr($input, -4);
}

function currentUrl(): string
{
    global $wp;

    return home_url(add_query_arg([], $wp->request));
}

function mailcoachTenantUrl(Settings $settings): string
{
    return substr($settings->apiEndpoint(), 0, strpos($settings->apiEndpoint(), '.app') + 4);
}
