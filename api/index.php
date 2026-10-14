<?php

// 1. Tentukan direktori folder sementara di /tmp Vercel (karena /var/task bersifat read-only)
$tmpStorage = '/tmp/storage';
$tmpBootstrapCache = '/tmp/bootstrap/cache';

$dirs = [
    $tmpStorage . '/app',
    $tmpStorage . '/framework/cache/data',
    $tmpStorage . '/framework/sessions',
    $tmpStorage . '/framework/views',
    $tmpStorage . '/logs',
    $tmpBootstrapCache,
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// 2. Override path default Laravel agar mengarah ke /tmp sebelum aplikasi dimuat
putenv("APP_STORAGE_PATH={$tmpStorage}");
$_ENV['APP_STORAGE_PATH'] = $tmpStorage;

// 3. Muat autoloader Composer terlebih dahulu
require __DIR__ . '/../vendor/autoload.php';

// 4. Inisialisasi aplikasi Laravel dan arahkan path bootstrap cache
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Gunakan path bootstrap cache di /tmp
if (method_exists($app, 'useBootstrapPath')) {
    $app->useBootstrapPath('/tmp/bootstrap');
}

// 5. Tangani request dari browser
$app->handleRequest(\Illuminate\Http\Request::capture());
