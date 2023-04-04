<?php

namespace Spatie\WordPressMailcoach\Admin\ViewModel;

use Spatie\WordPressMailcoach\Admin\MailcoachApi;
use Spatie\WordPressMailcoach\Admin\ValueObject\Form;

class CreateOrUpdateForm
{
    public function __construct(
        private MailcoachApi $mailcoach,
        public ?Form $form = null,
    ) {
    }

    public function emailLists(): array
    {
        /** @var array{uuid: string, name: string} $emailLists */
        $emailLists = [];
        foreach ($this->mailcoach->emailLists()->results() as $list) {
            $emailLists[] = ['uuid' => $list->uuid, 'name' => $list->name];
        }

        return $emailLists;
    }

    public function pageTitle(): string
    {
        return $this->form ? 'Edit Form' : 'Create Form';
    }

    public function formName(): string
    {
        return $this->form->name ?? '';
    }

    public function selectedEmailList(): string
    {
        return $this->form->emailListUuid ?? '';
    }

    public function showShortcode(): bool
    {
        return $this->form !== null;
    }
}
