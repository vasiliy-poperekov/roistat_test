<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AmoCRM\Client\AmoCRMApiClient;
use App\Repositories\AmoTokenRepositoryInterface;
use App\UseCases\SaveAmoTokenUseCase;
use Illuminate\Http\RedirectResponse;

class SaveUserController extends Controller
{
    private AmoCRMApiClient $amoCRMApiClient;
    private SaveAmoTokenUseCase $saveAmoTokenUseCase;
    private AmoTokenRepositoryInterface $amoTokenRepository;
    public function __construct(
        AmoCRMApiClient $amoCRMApiClient,
        SaveAmoTokenUseCase $saveAmoTokenUseCase,
        AmoTokenRepositoryInterface $amoTokenRepository
    ) {
        $this->amoCRMApiClient = $amoCRMApiClient;
        $this->saveAmoTokenUseCase = $saveAmoTokenUseCase;
        $this->amoTokenRepository = $amoTokenRepository;
    }

    public function save(Request $request): RedirectResponse
    {
        $this->amoCRMApiClient->getOAuthClient()->setBaseDomain($request->input('referer'));
        $accessToken = $this->amoCRMApiClient
            ->getOAuthClient()
            ->getAccessTokenByCode($request->input('code'));
        $this->amoCRMApiClient->setAccessToken($accessToken);

        $this->saveAmoTokenUseCase->handle(
            [
                'accountId' => $this->amoCRMApiClient->account()->getCurrent()->getId(),
                'domain' => $request->input('referer'),
                'accessToken' => $accessToken,
                'refreshToken' => $accessToken->getRefreshToken(),
                'expiresIn' => $accessToken->getExpires(),
            ],
            $this->amoTokenRepository
        );

        return redirect('/form');
    }
}
