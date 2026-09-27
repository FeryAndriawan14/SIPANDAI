<?php

// Izinkan PHP menampilkan error jika terjadi kesalahan
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Forward request ke public/index.php milik Laravel
require __DIR__ . '/../public/index.php';
