<?php

namespace Spatie\WordPressMailcoach\Admin;

use Spatie\WordPressMailcoach\Admin\Data\CreateOrUpdateFormData;
use Spatie\WordPressMailcoach\Admin\Data\DeleteFormData;
use Spatie\WordPressMailcoach\Admin\Repository\FormRepository;
use Spatie\WordPressMailcoach\Admin\ViewModel\CreateOrUpdateFormViewModel;
use Spatie\WordPressMailcoach\Admin\ViewModel\IndexFormsViewModel;
use Spatie\WordPressMailcoach\Includes\Api\MailcoachApi;
use Spatie\WordPressMailcoach\Support\HasHooks;

// If this file is called directly, abort.
if (! defined('ABSPATH')) {
    exit;
}

class FormsController implements HasHooks
{
    private function __construct(
        private readonly MailcoachApi   $mailcoach,
        private readonly FormRepository $formRepository,
    ) {
    }

    public static function make(MailcoachApi $mailcoach): self
    {
        return new self($mailcoach, FormRepository::make());
    }

    public function initializeActionHooks(): void
    {
        add_action('admin_post_create_new_form', fn () => $this->createOrUpdateForm());
        add_action('admin_post_delete_form', fn () => $this->deleteForm());
    }

    public function initializeHooks(): void
    {
        add_action('init', fn () => $this->indexForms());
        add_action('init', fn () => $this->createForm());
        add_action('init', fn () => $this->editForm());
    }

    public function indexForms(): void
    {
        $view = new IndexFormsViewModel($this->formRepository, $this->mailcoach);

        include __DIR__ . '/views/show-forms.php';
    }

    public function createForm(): void
    {
        $view = new CreateOrUpdateFormViewModel($this->mailcoach);

        include __DIR__ . '/views/create-or-update-form.php';
    }

    public function createOrUpdateForm(): void
    {
        $data = CreateOrUpdateFormData::fromRequest();

        $this->formRepository->createOrUpdateByShortcode($data);

        $form = $this->formRepository->firstByShortcode($data->shortcode);

        wp_redirect($form?->editUrl() ?? '/wp-admin/admin.php?page=mailcoach-forms');
    }

    public function editForm(): void
    {
        $form = $this->formRepository->firstById($_GET['form']);

        $view = new CreateOrUpdateFormViewModel($this->mailcoach, $form);

        include __DIR__ . '/views/create-or-update-form.php';
    }

    public function deleteForm(): void
    {
        $data = DeleteFormData::fromRequest();

        $this->formRepository->delete($data->shortcode);

        wp_redirect('/wp-admin/admin.php?page=mailcoach-forms');
    }
}
