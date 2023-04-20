<?php

use Spatie\WordPressMailcoach\Admin\Exception\NotFound;
use Spatie\WordPressMailcoach\Admin\Repository\FormRepository;

function subscribeLink($attributes, $content, $tag)
{
    $form = FormRepository::make()->firstByShortcode($tag);

    if (! $form) {
        throw NotFound::form($tag);
    }

    ob_start();

    include __DIR__ . '/Front/views/subscribe.php';

    return ob_get_clean();
}

// @todo how can we optimize this?
foreach (FormRepository::make()->allShortCodes() as $shortCode) {
    add_shortcode($shortCode, 'subscribeLink');
}
