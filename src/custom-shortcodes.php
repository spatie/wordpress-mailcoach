<?php

function subscribeLink(array $attributes)
{
    return include __DIR__ . '/Front/views/subscribe.php';
}

add_shortcode('subscribe-form-mailcoach', 'subscribeLink');
