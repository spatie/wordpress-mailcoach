<?php

function subscribeLink()
{
    $list = '4bee592b-a9bc-465a-94ed-7ad61cf0f54b';

    return include __DIR__ . '/Front/views/subscribe.php';
}

add_shortcode('subscribe-form-mailcoach', 'subscribeLink');
