<?php
// SERVER_CHECK.php
// Access this via https://livasya.com/SERVER_CHECK.php

header('Content-Type: text/plain');

echo "=== SERVER HEADER DIAGNOSTIC ===\n\n";

echo "1. PHP REPORTED HEADERS (headers_list):\n";
echo "--------------------------------------\n";
foreach (headers_list() as $header) {
    if (stripos($header, 'Server') === 0 || stripos($header, 'X-Powered-By') === 0) {
        echo $header . "\n";
    }
}
echo "\n";

echo "2. $_SERVER Environment Variables:\n";
echo "--------------------------------------\n";
echo "SERVER_SOFTWARE: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Not Set') . "\n";
echo "SERVER_SIGNATURE: " . ($_SERVER['SERVER_SIGNATURE'] ?? 'Not Set') . "\n";

echo "\n";
echo "=== INSTRUCTIONS ===\n";
echo "If you see 'LiteSpeed' or 'OpenResty' in the output above,\n";
echo "it means the Web Server configuration (not PHP) is still adding the banner.\n";
echo "Please verify: openlitespeed configuration and Restart server.\n";
