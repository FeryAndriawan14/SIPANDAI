<?php

// Matikan tampilan error/warning langsung ke response HTTP
ini_set('display_errors', '0');
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

// Forward request ke public/index.php milik Laravel
require __DIR__ . '/../public/index.php';
