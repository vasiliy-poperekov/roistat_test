<?php

namespace App\Repositories;

use App\Models\AmoToken;
use App\Repositories\AmoTokenRepositoryInterface;
use League\OAuth2\Client\Token\AccessToken;

class AmoTokenRepository implements AmoTokenRepositoryInterface
{
    public function create(array $amoTokenData)
    {
        AmoToken::create([
            'account_id' => $amoTokenData['accountId'],
            'domain' => $amoTokenData['domain'],
            'access_token' => $amoTokenData['accessToken'],
            'refresh_token' => $amoTokenData['refreshToken'],
            'expires_in' => date("Y-m-d h:m:s", $amoTokenData['expiresIn']),
        ]);
    }

    public function getAccessToken(int $accountId): AccessToken
    {
        $amoToken = AmoToken::firstWhere('account_id', $accountId);
        return new AccessToken([
            'access_token' => $amoToken->access_token,
            'refresh_token' => $amoToken->refresh_token,
            'expires' => strtotime($amoToken->expires_in),
            'baseDomain' => $amoToken->domain,
        ]);
    }
}
