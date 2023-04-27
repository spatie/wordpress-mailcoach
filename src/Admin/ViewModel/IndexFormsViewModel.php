<?php

namespace Spatie\WordPressMailcoach\Admin\ViewModel;

use Spatie\MailcoachSdk\Support\PaginatedResults;
use Spatie\WordPressMailcoach\Admin\Model\Form;
use Spatie\WordPressMailcoach\Admin\Repository\FormRepository;
use Spatie\WordPressMailcoach\Includes\Api\MailcoachApi;

class IndexFormsViewModel
{
    public function __construct(
        private FormRepository $formRepository,
        private MailcoachApi $mailcoach,
    ) {
    }

    public function isApiSetup(): bool
    {
        return $this->mailcoach->hasCredentials();
    }

    /** @return string[] */
    public function tableHeaders(): array
    {
        return ['Name', 'Shortcode', 'Email List', 'Date'];
    }

    /** @return Form[] */
    public function forms(): array
    {
        try {
            $forms = $this->formRepository->all();

            return $this->setEmailListRelation($forms, $this->emailLists());
        } catch (\Exception $e) {
            return [];
        }
    }

    public function emailLists(): PaginatedResults
    {
        return $this->mailcoach->emailLists();
    }

    /**
     * @param Form[] $forms
     * @return Form[]
     */
    private function setEmailListRelation(array $forms, PaginatedResults $emailLists): array
    {
        return array_map(function (Form $form) use ($emailLists): Form {
            foreach ($emailLists as $emailList) {
                if ($emailList->uuid === $form->emailListUuid) {
                    return $form->setEmailList($emailList);
                }
            }

            return $form;
        }, $forms);
    }
}
