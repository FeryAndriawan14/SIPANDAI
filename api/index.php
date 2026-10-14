<?php

// 1. Tentukan direktori folder sementara di /tmp Vercel
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

// 2. Override path default Laravel sebelum aplikasi dimuat
putenv("APP_STORAGE_PATH={$tmpStorage}");
$_ENV['APP_STORAGE_PATH'] = $tmpStorage;

// 3. Muat autoloader Composer
require __DIR__ . '/../vendor/autoload.php';

// 4. Inisialisasi aplikasi Laravel dan arahkan path bootstrap cache
$app = require_once __DIR__ . '/../bootstrap/app.php';

if (method_exists($app, 'useBootstrapPath')) {
    $app->useBootstrapPath('/tmp/bootstrap');
}

// 5. Tangani request
$app->handleRequest(\Illuminate\Http\Request::capture());
