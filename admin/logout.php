<?php

/**
 * Logout Admin - UCCHANK'S LANDSCAPE
 * Mengakhiri session admin secara aman dan menghapus cookie session.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kosongkan seluruh variabel session
$_SESSION = [];

// Hapus cookie session jika digunakan oleh PHP
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Hancurkan session
session_destroy();

// Redirect ke halaman login
header("Location: login.php");
exit;
