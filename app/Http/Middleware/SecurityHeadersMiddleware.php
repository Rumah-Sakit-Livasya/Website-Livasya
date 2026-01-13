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
        // Feature-Policy: Legacy support for Permissions-Policy
        $response->headers->set('Feature-Policy', "camera 'none'; microphone 'none'; geolocation 'none'");

        // X-Permitted-Cross-Domain-Policies: Prevents Flash/Acrobat cross-domain requests
        $response->headers->set('X-Permitted-Cross-Domain-Policies', 'none');

        // X-Download-Options: IE specific, prevents opening files directly
        $response->headers->set('X-Download-Options', 'noopen');

        // Strict-Transport-Security (HSTS): Enforces HTTPS
        // max-age=31536000 = 1 year
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');

        // Content-Security-Policy: Prevents XSS and injection attacks
        $csp = implode('; ', [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://code.jquery.com https://unpkg.com https://www.googletagmanager.com https://static.cloudflareinsights.com",
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://fonts.bunny.net https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://unpkg.com",
            "font-src 'self' https://fonts.gstatic.com https://fonts.bunny.net https://cdnjs.cloudflare.com data:",
            "img-src 'self' data: https: blob:",
            "connect-src 'self' https://www.googletagmanager.com https://static.cloudflareinsights.com",
            "frame-ancestors 'self'",
            "base-uri 'self'",
            "form-action 'self'",
        ]);
        // $response->headers->set('Content-Security-Policy', $csp);

        // Remove X-Powered-By header to hide PHP version
        $response->headers->remove('X-Powered-By');

        // Attempt to remove/overwrite Server header (Note: Web server might override this)
        $response->headers->remove('Server');

        return $response;
    }
}
