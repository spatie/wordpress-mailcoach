<?php

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
