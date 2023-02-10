<?php

include('custom-shortcodes.php');

function anonymizeSensitiveDate(string $input): string
{
    return str_repeat('*', strlen($input) - 4) . substr($input, -4);
}

add_action('template_redirect', 'createSubscriberFromShortCode');

/** @todo can we get this working in a class ? */
function createSubscriberFromShortCode(): void
{
    if (! isset($_POST['mailcoach_subscribe_submit']) || ! isset($_POST['mailcoach_subscribe_nonce'])) {
        return;
    }

    if (! wp_verify_nonce($_POST['mailcoach_subscribe_nonce'], 'faire-don')) {
        return;
    }

    if (isset($_POST['email_list_uuid'])) {
        $emailListUuid = sanitize_text_field($_POST['email_list_uuid']);
    }

    $attributes = [];
    foreach ($_POST as $key => $value) {
        if (in_array($key, ['_wp_http_referer', 'mailcoach_subscribe_nonce', 'mailcoach_subscribe_submit', 'email_list_uuid'])) {
            continue;
        }

        $attributes[$key] = sanitize_text_field($value);
    }

    // @todo use MailcoachApi class to subscribe
}
