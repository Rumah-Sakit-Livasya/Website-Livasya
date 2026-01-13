<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// PARANOID SECURITY MODE: Generate Nonce for CSP
// We define it here so both index.php (fallback) and Laravel (middleware) use the SAME nonce
$nonce = bin2hex(random_bytes(16));
define('CSP_NONCE', $nonce);

// PARANOID SECURITY MODE: Force headers at PHP entry point
// This bypasses middleware and frameworks to ensure headers are always present
if (function_exists('header_remove')) {
    header_remove('X-Powered-By');
}

// FINAL RESORT: Force Runtime Configuration
// Bypass Laravel config cache entirely
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_samesite', 'Strict');
ini_set('session.use_strict_mode', 1);

// Attempt to overwrite Server header (Tricks Nginx into using this instead of default)
header('Server: LivasyaSecure');

// Enforce Security Headers
header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');
header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
// Feature-Policy: camera 'none'; microphone 'none'; geolocation 'none' (Deprecated, using Permissions-Policy)
header('X-Permitted-Cross-Domain-Policies: none');
header('X-Download-Options: noopen');

// Simplified CSP for entry point
// REMOVED 'unsafe-inline' from script-src and added 'nonce'
// style-src MUST have 'unsafe-inline' for JS libs (SweetAlert, etc). Nonce disables unsafe-inline for styles, so we DO NOT use nonce for styles.
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'nonce-{$nonce}' https:; style-src 'self' 'unsafe-inline' https:; font-src 'self' https: data:; img-src 'self' data: https: blob:; connect-src 'self' https:; frame-ancestors 'self'; frame-src 'self' https://www.instagram.com https://www.google.com https://maps.google.com;");

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__ . '/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
