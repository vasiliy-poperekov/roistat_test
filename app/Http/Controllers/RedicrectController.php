<?php

namespace App\Http\Controllers;

use AmoCRM\Client\AmoCRMApiClient;
use App\Models\AmoToken;
use Illuminate\Http\RedirectResponse;

class RedicrectController extends Controller
{
    private AmoCRMApiClient $amoCRMApiClient;
    public function __construct(AmoCRMApiClient $amoCRMApiClient)
    {
        $this->amoCRMApiClient = $amoCRMApiClient;
    }
    public function redirectToAuth(): RedirectResponse
    {
        if (AmoToken::all()->count() > 0) {
            return redirect('/form');
        }

        return redirect()->away($this->amoCRMApiClient->getOAuthClient()->getAuthorizeUrl([
            'state' => bin2hex(random_bytes(16)),
            'mode' => 'post_message',
        ]));
    }
}
