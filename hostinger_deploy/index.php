<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Ensure no stale cached config/routes break live environment
if (file_exists(__DIR__ . '/bootstrap/cache/config.php')) {
    @unlink(__DIR__ . '/bootstrap/cache/config.php');
}
if (file_exists(__DIR__ . '/bootstrap/cache/routes-v7.php')) {
    @unlink(__DIR__ . '/bootstrap/cache/routes-v7.php');
}

try {
    define('LARAVEL_START', microtime(true));

    // Determine if the application is in maintenance mode...
    if (file_exists($maintenance = __DIR__.'/storage/framework/maintenance.php')) {
        require $maintenance;
    }

    // Register the Composer autoloader...
    require __DIR__.'/vendor/autoload.php';

    // Bootstrap Laravel and handle the request...
    $app = require __DIR__.'/bootstrap/app.php';

    // Set public path to this directory (public_html)
    $app->usePublicPath(__DIR__);

    $app->handleRequest(Illuminate\Http\Request::capture());
} catch (\Throwable $e) {
    http_response_code(500);
    echo '<div style="font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,sans-serif;padding:30px;background:#fef2f2;border:2px solid #ef4444;border-radius:12px;max-width:900px;margin:50px auto;color:#991b1b;box-shadow:0 10px 25px -5px rgba(0,0,0,0.1);">';
    echo '<h1 style="margin:0 0 12px 0;font-size:22px;color:#b91c1c;">Startup / Server Diagnostic Details</h1>';
    echo '<p style="font-size:16px;font-weight:600;margin:0 0 10px 0;background:#fee2e2;padding:10px 14px;border-radius:6px;">' . htmlspecialchars(get_class($e)) . ': ' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<p style="font-size:14px;color:#475569;margin-bottom:16px;">File: <code>' . htmlspecialchars($e->getFile()) . '</code> : Line <strong>' . $e->getLine() . '</strong></p>';
    echo '<div style="font-size:13px;font-weight:600;color:#334155;margin-bottom:6px;">Stack Trace:</div>';
    echo '<pre style="background:#ffffff;padding:16px;border:1px solid #cbd5e1;border-radius:6px;overflow:auto;font-size:12px;line-height:1.5;max-height:450px;color:#1e293b;">' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
    echo '</div>';
    exit;
}
