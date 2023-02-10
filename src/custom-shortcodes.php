<?php

function subscribeLink(array $attributes)
{
    // $attributes is used in the view

    return include __DIR__ . '/Front/views/subscribe.php';
}

add_shortcode('subscribe-form-mailcoach', 'subscribeLink');
