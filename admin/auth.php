<?php

/**
 * Autentikasi Admin - UCCHANK'S LANDSCAPE
 * Memastikan hanya admin yang memiliki session valid yang dapat mengakses halaman admin.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Menghitung path relatif ke login.php berdasarkan kedalaman folder file yang sedang diakses
    $currentScript = str_replace('\\', '/', dirname($_SERVER['SCRIPT_FILENAME'] ?? __FILE__));
    $adminDir = str_replace('\\', '/', __DIR__);

    $loginUrl = 'login.php';
    if ($currentScript !== $adminDir && strpos($currentScript, $adminDir) === 0) {
        $subDir = trim(substr($currentScript, strlen($adminDir)), '/');
        if ($subDir !== '') {
            $depth = count(explode('/', $subDir));
            $loginUrl = str_repeat('../', $depth) . 'login.php';
        }
    }

    header("Location: " . $loginUrl);
    exit;
}
