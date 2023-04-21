<?php

namespace Spatie\WordPressMailcoach\Front\ViewModel;

use Spatie\WordPressMailcoach\Admin\Model\Form;

class ShowSubscribeViewModel
{
    public function __construct(
        public Form $form,
    ) {
    }

    public function currentUrl(): string
    {
        return currentUrl();
    }
}
