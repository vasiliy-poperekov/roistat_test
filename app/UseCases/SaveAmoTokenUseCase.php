<?php

namespace App\UseCases;

use App\Repositories\AmoTokenRepository;

class SaveAmoTokenUseCase
{
    public function handle(array $amoTokenData, AmoTokenRepository $amoTokenRepository)
    {
        if (
            isset($amoTokenData)
            && isset($amoTokenData['accountId'])
            && isset($amoTokenData['domain'])
            && isset($amoTokenData['accessToken'])
            && isset($amoTokenData['refreshToken'])
            && isset($amoTokenData['expiresIn'])
        ) {
            $amoTokenRepository->create($amoTokenData);
        }
    }
}
