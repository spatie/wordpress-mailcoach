<?php

use Spatie\WordPressMailcoach\Admin\ValueObject\Settings;

include('custom-shortcodes.php');

function mailcoach_anonymize_api_key(string $input): string
{
    if ($input === '') {
        return '';
    }

    return str_repeat('*', strlen($input) - 4) . substr($input, -4);
}

function mailcoach_current_url(): string
{
    global $wp;

    return home_url(add_query_arg([], $wp->request));
}

function mailcoach_tenant_url(Settings $settings): string
{
    return substr($settings->apiEndpoint(), 0, strpos($settings->apiEndpoint(), '.app') + 4);
}
