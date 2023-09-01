<?php

namespace App\Repositories;

use League\OAuth2\Client\Token\AccessToken;

interface AmoTokenRepositoryInterface
{
    public function create(array $amoTokenData);
    public function getAccessToken(int $accoutnId): AccessToken;
}
