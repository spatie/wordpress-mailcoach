<?php

use Spatie\WordPressMailcoach\Admin\Exception\NotFound;
use Spatie\WordPressMailcoach\Admin\Repository\FormRepository;

function subscribeLink($attributes, $content, $tag)
{
    $form = FormRepository::make()->firstByShortcode($tag);

    if (! $form) {
        throw NotFound::form($tag);
    }

    return include __DIR__ . '/Front/views/subscribe.php';
}

// @todo add caching
foreach (FormRepository::make()->allShortCodes() as $shortCode) {
    add_shortcode($shortCode, 'subscribeLink');
}
