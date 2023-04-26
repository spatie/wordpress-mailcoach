<?php

namespace Spatie\WordPressMailcoach\Admin\ViewModel;

use Spatie\MailcoachSdk\Resources\EmailList;
use Spatie\WordPressMailcoach\Admin\Model\Form;
use Spatie\WordPressMailcoach\Admin\ValueObject\Messages;
use Spatie\WordPressMailcoach\Includes\Api\MailcoachApi;

class CreateOrUpdateFormViewModel
{
    public function __construct(
        private readonly MailcoachApi $mailcoach,
        public ?Form $form = null,
    ) {
    }

    public function emailLists(): array
    {
        return $this->mailcoach->emailListOptions();
    }

    public function enabledEmailListNames(): array
    {
        $lists = array_filter($this->emailLists(), static function (EmailList $emailList) {
            return $emailList->allowFormSubscriptions;
        });

        return array_values(
            array_map(
                static function (EmailList $emailList) {
                    return $emailList->name;
                },
                $lists
            )
        );
    }

    public function isEditMode(): bool
    {
        return $this->form !== null;
    }

    public function pageTitle(): string
    {
        return $this->isEditMode() ? 'Edit Form' : 'Create Form';
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
        return $this->isEditMode();
    }

    public function messages(): Messages
    {
        if ($this->form === null) {
            return Messages::default();
        }

        return $this->form->messages;
    }
}
