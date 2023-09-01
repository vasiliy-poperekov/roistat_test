<?php

namespace App\Http\Controllers;

use AmoCRM\Client\AmoCRMApiClient;
use Illuminate\Http\Request;
use App\DTOs\SendedLeadDTO;
use App\UseCases\SendLeadUseCase;
use App\Repositories\AmoTokenRepositoryInterface;
use Illuminate\Http\JsonResponse;

class SendLeadController extends Controller
{
    private AmoCRMApiClient $amoCRMApiClient;
    private SendLeadUseCase $sendLeadUseCase;
    private AmoTokenRepositoryInterface $amoTokenRepository;
    public function __construct(
        AmoCRMApiClient $amoCRMApiClient,
        SendLeadUseCase $sendLeadUseCase,
        AmoTokenRepositoryInterface $amoTokenRepository
    ) {
        $this->amoCRMApiClient = $amoCRMApiClient;
        $this->sendLeadUseCase = $sendLeadUseCase;
        $this->amoTokenRepository = $amoTokenRepository;
    }

    public function sendLead(Request $request): JsonResponse
    {
        $amoAccessToken = $this->amoTokenRepository->getAccessToken($request->input('accountId'));
        $this->amoCRMApiClient
            ->setAccessToken(
                $amoAccessToken
            )
            ->setAccountBaseDomain($amoAccessToken->getValues()['baseDomain']);

        $addedLead = $this->sendLeadUseCase->handle(
            new SendedLeadDTO(
                $request->input('price'),
                $request->input('name'),
                $request->input('phone'),
                $request->input('email')
            ),
            $this->amoCRMApiClient
        );

        return response()->json([
            'leadId' => $addedLead->getId(),
            'contactId' => $addedLead->getContacts()->first()->getId(),
        ]);
    }
}
