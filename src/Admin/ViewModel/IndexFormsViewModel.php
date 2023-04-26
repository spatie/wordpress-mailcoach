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

    public function tableHeaders(): array
    {
        return ['Name', 'Shortcode', 'Email List', 'Date'];
    }

    /** @return Form[] */
    public function forms(): array
    {
        return $this->formRepository->all();
    }

    public function emailLists(): array
    {
        $emailLists = $this->mailcoach->emailLists();

        return $this->setEmailListRelation($emailLists, $this->forms());
    }

    private function setEmailListRelation(PaginatedResults $emailLists, array $forms): array
    {
        return array_map(static function (Form $form) use ($emailLists): void {
            foreach ($emailLists as $emailList) {
                if ($emailList->uuid === $form->emailListUuid) {
                    $form->setEmailList($emailList);

                    return;
                }
            }
        }, $forms);
    }
}
