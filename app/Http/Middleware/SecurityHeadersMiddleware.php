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
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');

        // Get the nonce generated in AppServiceProvider
        $nonce = \Illuminate\Support\Facades\View::shared('nonce');

        // Content-Security-Policy: Prevents XSS and injection attacks
        $csp = implode('; ', [
            "default-src 'self'",
            // Script: Strict Nonce-based (No unsafe-inline, No unsafe-eval)
            "script-src 'self' 'nonce-{$nonce}' https: blob:",
            // Style: Must allow unsafe-inline for JS libraries (SweetAlert, etc) to inject styles.
            // We DO NOT use nonce here because it would disable unsafe-inline.
            "style-src 'self' 'unsafe-inline' https: blob: fonts.googleapis.com",
            "font-src 'self' https: data:",
            "img-src 'self' data: https: blob:",
            "connect-src 'self' https:",
            "frame-ancestors 'self'",
            "frame-src 'self' https://www.instagram.com https://www.google.com https://maps.google.com",
            "base-uri 'self'",
            "form-action 'self'",
        ]);
        $response->headers->set('Content-Security-Policy', $csp);

        // Remove X-Powered-By header to hide PHP version
        $response->headers->remove('X-Powered-By');

        // Attempt to remove/overwrite Server header (Note: Web server might override this)
        $response->headers->remove('Server');

        return $response;
    }
}
