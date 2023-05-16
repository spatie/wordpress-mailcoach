<?php

namespace Spatie\WordPressMailcoach\Front\ViewModel;

use Spatie\WordPressMailcoach\Admin\Enum\SubscribeStatus;
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

    public function isProcessed(): bool
    {
        return isset($_GET['status']);
    }

    public function submitMessage(): string
    {
        $status = SubscribeStatus::from(sanitize_text_field($_GET['status']));

        return $this->form->messages->fromStatus($status);
    }

    /**
     * @return array{subscribed: string, pending: string, already_subscribed: string}
     */
    public function endpoints(): array
    {
        return [
            'subscribed' => $this->currentUrl() . '?status=' . SubscribeStatus::Subscribed->value,
            'pending' => $this->currentUrl() . '?status=' . SubscribeStatus::Pending->value,
            'already_subscribed' => $this->currentUrl() . '?status=' . SubscribeStatus::AlreadySubscribed->value,
        ];
    }
}
