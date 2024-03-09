<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Http::macro('qls', function () {
            return Http::withHeaders([
                'Accept: application/json',
	            'Content-Type: application/json',
                
            ])->withOptions([
                'curl' => [
                    CURLOPT_USERPWD => env('QLS_API_USESRNAME') . ':' . env('QLS_API_PASSWORD')
                ]
            ])
            ->baseUrl(env('QLS_API_URL'));
        });
    }
}
