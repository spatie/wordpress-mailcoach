<?php

namespace Spatie\WordPressMailcoach\Admin\ViewModel;

use Spatie\MailcoachSdk\Resources\EmailList;
use Spatie\WordPressMailcoach\Admin\MailcoachApi;
use Spatie\WordPressMailcoach\Admin\Model\Form;

class CreateOrUpdateForm
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

        ray(array_values(
            array_map(
                static function (EmailList $emailList) {
                    return $emailList->name;
                },
                $lists
            )
        ));

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
}
