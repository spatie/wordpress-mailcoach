<?php

namespace Spatie\WordPressMailcoach\Admin\Enum;

enum SubscribeStatus: string
{
    case Subscribed = 'subscribed';
    case Pending = 'pending';
    case AlreadySubscribed = 'already_subscribed';
}
