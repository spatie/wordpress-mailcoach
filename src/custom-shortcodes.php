<?php

use Spatie\WordPressMailcoach\Admin\Exception\NotFound;
use Spatie\WordPressMailcoach\Admin\Repository\FormRepository;
use Spatie\WordPressMailcoach\Front\ViewModel\ShowSubscribeViewModel;

if (! function_exists('mailcoach_subscribe_link')) {
    function mailcoach_subscribe_link($attributes, $content, $tag)
    {
        $form = FormRepository::make()->firstByShortcode($tag);

        if (! $form) {
            throw NotFound::form($tag);
        }

        $view = new ShowSubscribeViewModel($form);

        ob_start();

        include __DIR__ . '/Front/views/subscribe.php';

        return ob_get_clean();
    }
}

// @todo how can we optimize this?
foreach (FormRepository::make()->allShortCodes() as $shortCode) {
    add_shortcode($shortCode, 'mailcoach_subscribe_link');
}
