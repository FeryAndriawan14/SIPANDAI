<?php

// 1. Definisikan jalur direktori aman di /tmp Vercel
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

// 2. Override environment path Laravel agar mengarah ke /tmp
$_ENV['APP_STORAGE_PATH'] = $tmpStorage;
putenv("APP_STORAGE_PATH={$tmpStorage}");

// 3. Muat file bootstrap Laravel secara manual
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

if (method_exists($app, 'useBootstrapPath')) {
    $app->useBootstrapPath('/tmp/bootstrap');
}

// 4. Jalankan aplikasi Laravel
$app->handleRequest(\Illuminate\Http\Request::capture());
