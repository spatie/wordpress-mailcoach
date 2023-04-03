<?php

namespace Spatie\WordPressMailcoach\Admin;

use Spatie\WordPressMailcoach\Admin\Data\StoreFormData;
use Spatie\WordPressMailcoach\Admin\Repository\FormRepository;
use Spatie\WordPressMailcoach\Admin\ValueObject\Form;
use Spatie\WordPressMailcoach\Support\HasHooks;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class Forms implements HasHooks
{
    private function __construct(
        private MailcoachApi $mailcoach,
        private FormRepository $formRepository,
    ) {
    }

    public static function make(MailcoachApi $mailcoach): self
    {
        return new self($mailcoach, FormRepository::make());
    }

    public function initializeActionHooks(): void
    {
        add_action('admin_post_create_new_form', fn () => $this->storeForm());
    }

    public function initializeHooks(): void
    {
        add_action('init', fn () => $this->showForm());
        add_action('init', fn () => $this->createForm());
    }

    public function showForm(): void
    {
        $forms = $this->formRepository->all();
        $emailLists = $this->mailcoach->emailLists();

        $emailLists = array_map(static function (Form $form) use ($emailLists): void {
            foreach ($emailLists as $emailList) {
                if ($emailList->uuid === $form->emailListUuid) {
                    $form->setEmailList($emailList);

                    continue;
                }
            }
        }, $forms);

        include __DIR__ . '/views/show-forms.php';
    }

    public function createForm(): void
    {
        /** @var array{uuid: string, name: string} $emailLists */
        $emailLists = [];
        foreach ($this->mailcoach->emailLists()->results() as $list) {
            $emailLists[] = ['uuid' => $list->uuid, 'name' => $list->name];
        }

        include __DIR__ . '/views/create-form.php';
    }

    public function storeForm(): void
    {
        $data = StoreFormData::fromRequest();

        $this->formRepository->store($data);

        wp_redirect('/wp-admin/admin.php?page=mailcoach-forms');
    }
}
