<?php

namespace App\Providers;

use App\Repositories\AmoTokenRepository;
use Illuminate\Support\ServiceProvider;
use AmoCRM\Client\AmoCRMApiClient;
use App\Repositories\AmoTokenRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AmoCRMApiClient::class, function() {
            return new AmoCRMApiClient(
                env('CLIENT_ID'),
                env('CLIENT_SECRET'),
                env('REDIRECT_URL')
            );
        });

        $this->app->bind(AmoTokenRepositoryInterface::class, function() {
            return new AmoTokenRepository();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
