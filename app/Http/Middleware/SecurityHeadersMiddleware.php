<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeadersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // X-Frame-Options: Prevents clickjacking attacks
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // X-Content-Type-Options: Prevents MIME type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // X-XSS-Protection: Enables XSS filtering in older browsers
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Referrer-Policy: Controls referrer information
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Permissions-Policy: Restricts browser features
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        // Feature-Policy: Legacy support (Removed to prevent conflicts with Permissions-Policy)
        // $response->headers->set('Feature-Policy', "camera 'none'; microphone 'none'; geolocation 'none'");

        // X-Permitted-Cross-Domain-Policies: Prevents Flash/Acrobat cross-domain requests
        $response->headers->set('X-Permitted-Cross-Domain-Policies', 'none');

        // X-Download-Options: IE specific, prevents opening files directly
        $response->headers->set('X-Download-Options', 'noopen');

        // Strict-Transport-Security (HSTS): Enforces HTTPS
        // max-age=31536000 = 1 year
        if ($request->isSecure() || app()->environment('production')) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        // Get the nonce generated in AppServiceProvider
        $nonce = \Illuminate\Support\Facades\View::shared('nonce');

        $scriptSources = implode(' ', [
            "'self'",
            "'unsafe-inline'",
            "'unsafe-eval'",
            "'nonce-{$nonce}'",
            'https://www.googletagmanager.com',
            'https://www.google-analytics.com',
            'https://cdn.jsdelivr.net',
            'https://cdnjs.cloudflare.com',
            'https://cdn.rawgit.com',
            'https://www.instagram.com',
            'http://localhost:5173',
            'http://[::1]:5173',
        ]);

        $styleSources = implode(' ', [
            "'self'",
            "'unsafe-inline'",
            'https://fonts.googleapis.com',
            'https://cdn.jsdelivr.net',
            'https://cdnjs.cloudflare.com',
            'http://localhost:5173',
            'http://[::1]:5173',
        ]);

        $fontSources = implode(' ', [
            "'self'",
            'data:',
            'https://fonts.gstatic.com',
            'https://cdnjs.cloudflare.com',
            'https://cdn.jsdelivr.net',
        ]);

        $imgSources = implode(' ', [
            "'self'",
            'data:',
            'blob:',
            'https:',
        ]);

        $connectSources = implode(' ', [
            "'self'",
            'https://www.google-analytics.com',
            'https://www.googletagmanager.com',
            'https://www.instagram.com',
            'http://localhost:5173',
            'http://[::1]:5173',
            'ws://localhost:5173',
            'ws://[::1]:5173',
        ]);

        // Content-Security-Policy: Prevents XSS and injection attacks.
        // Keep compatibility with current Blade/third-party embeds, while forcing HTTPS assets in production.
        $directives = [
            "default-src 'self'",
            "script-src {$scriptSources}",
            "script-src-elem {$scriptSources}",
            "script-src-attr 'unsafe-inline'",
            "style-src {$styleSources}",
            "font-src {$fontSources}",
            "img-src {$imgSources}",
            "connect-src {$connectSources}",
            "frame-ancestors 'self'",
            "frame-src 'self' https://www.googletagmanager.com https://www.youtube.com https://www.youtube-nocookie.com https://www.google.com https://maps.google.com https://www.instagram.com https://copafacil.com",
            "base-uri 'self'",
            "form-action 'self'",
        ];

        if ($request->isSecure() || app()->environment('production')) {
            $directives[] = 'upgrade-insecure-requests';
        }

        $csp = implode('; ', $directives);
        $response->headers->set('Content-Security-Policy', $csp);

        // Remove X-Powered-By header to hide PHP version
        $response->headers->remove('X-Powered-By');

        // Attempt to remove/overwrite Server header (Note: Web server might override this)
        $response->headers->remove('Server');

        return $response;
    }
}
