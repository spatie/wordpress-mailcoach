<?php

namespace Spatie\WordPressMailcoach\Front;

use Spatie\WordPressMailcoach\Admin\MailcoachApi;

class Form
{
    public function submit()
    {
        if (isset($_POST['form_email'])) {
            $email = sanitize_text_field($_POST['form_email']);
        }
    }
}
