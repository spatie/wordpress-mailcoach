<?php

function subscribeLink()
{
    return include __DIR__ . '/Front/views/subscribe.php';
}

add_shortcode('subscribe-form-mailcoach', 'subscribeLink');
