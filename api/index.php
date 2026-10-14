<?php

// 1. Buat folder sementara di /tmp agar Vercel tidak error saat membaca cache/storage
$tmpDirs = [
    '/tmp/storage/app',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache',
];

foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// 2. Arahkan path Storage dan Cache Laravel ke folder /tmp
$_ENV['APP_STORAGE_PATH'] = '/tmp/storage';
$_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';

// 3. Panggil file index.php bawaan Laravel
require __DIR__ . '/../public/index.php';
