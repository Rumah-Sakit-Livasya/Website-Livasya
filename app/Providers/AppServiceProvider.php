<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;

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
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        $request = request();
        $appUrl = (string) config('app.url');
        $forwardedProto = strtolower((string) $request->header('x-forwarded-proto'));

        if (
            $this->app->environment('production')
            || str_starts_with($appUrl, 'https://')
            || $request->isSecure()
            || $forwardedProto === 'https'
            || $request->getHost() === 'livasya.com'
            || $request->getHost() === 'www.livasya.com'
        ) {
            URL::forceScheme('https');
        }

        // Generate CSP Nonce (Use the one from index.php if available)
        $nonce = defined('CSP_NONCE') ? CSP_NONCE : Str::random(16);
        View::share('nonce', $nonce);
    }
}
