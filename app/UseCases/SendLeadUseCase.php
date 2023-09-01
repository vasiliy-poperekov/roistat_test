<?php

namespace App\UseCases;

use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Models\LeadModel;
use AmoCRM\Collections\ContactsCollection;
use AmoCRM\Collections\CustomFieldsValuesCollection;
use AmoCRM\Models\ContactModel;
use AmoCRM\Models\CustomFieldsValues\MultitextCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\MultitextCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\MultitextCustomFieldValueModel;
use App\DTOs\SendedLeadDTO;

class SendLeadUseCase
{
    public function handle(
        SendedLeadDTO $sendedLead,
        AmoCRMApiClient $amoCRMApiClient
    ): LeadModel {
        return $amoCRMApiClient->leads()->addOneComplex(
            (new LeadModel())
                ->setPrice($sendedLead->getPrice())
                ->setContacts(
                    (new ContactsCollection())->add(
                        (new ContactModel())
                            ->setFirstName($sendedLead->getContactName())
                            ->setCustomFieldsValues(
                                (new CustomFieldsValuesCollection())
                                    ->add(
                                        (new MultitextCustomFieldValuesModel())
                                            ->setFieldCode('PHONE')
                                            ->setValues(
                                                (new MultitextCustomFieldValueCollection())
                                                    ->add(
                                                        (new MultitextCustomFieldValueModel())
                                                            ->setValue($sendedLead->getPhone())
                                                    )
                                            )
                                    )
                                    ->add(
                                        (new MultitextCustomFieldValuesModel())
                                            ->setFieldCode('EMAIL')
                                            ->setValues(
                                                (new MultitextCustomFieldValueCollection())
                                                    ->add(
                                                        (new MultitextCustomFieldValueModel())
                                                            ->setValue($sendedLead->getEmail())
                                                    )
                                            )
                                    )
                            )
                    )
                )
        );
    }
}
