<?php

/**
 * Halaman Login Admin - UCCHANK'S LANDSCAPE
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Jika sudah login, langsung arahkan ke Dashboard
if (!empty($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: index.php");
    exit;
}

require_once __DIR__ . "/../config/db.php";

$error = "";

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = "Silakan masukkan username dan password.";
    } else {
        $stmt = mysqli_prepare($conn, "SELECT id, username, password_hash FROM admin_users WHERE username = ? LIMIT 1");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);

            if ($user && password_verify($password, $user['password_hash'])) {
                session_regenerate_id(true);
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['admin_username'] = $user['username'];

                header("Location: index.php");
                exit;
            } else {
                $error = "Username atau password salah.";
            }
        } else {
            $error = "Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - UCCHANK'S LANDSCAPE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f7f8f4;
            font-family: 'Poppins', sans-serif;
            color: #26332c;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(32, 86, 63, 0.08);
            border: 1px solid rgba(32, 86, 63, 0.1);
            overflow: hidden;
        }

        .login-header {
            background: #20563f;
            color: #ffffff;
            padding: 35px 30px;
            text-align: center;
        }

        .login-header h1 {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            line-height: 1.2;
        }

        .login-header h1 span {
            display: block;
            font-weight: 500;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.85);
            letter-spacing: 2px;
            margin-bottom: 2px;
        }

        .login-header p {
            margin-top: 10px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.75);
        }

        .login-body {
            padding: 35px 30px;
        }

        .alert-error {
            background: #fdf2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 13px;
            margin-bottom: 22px;
            line-height: 1.4;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #26332c;
        }

        .form-input {
            width: 100%;
            height: 48px;
            padding: 0 16px;
            font-family: inherit;
            font-size: 14px;
            color: #26332c;
            background: #f9fafb;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-input:focus {
            background: #ffffff;
            border-color: #20563f;
            box-shadow: 0 0 0 3px rgba(32, 86, 63, 0.15);
        }

        .btn-submit {
            width: 100%;
            height: 50px;
            margin-top: 10px;
            background: #20563f;
            color: #ffffff;
            border: none;
            border-radius: 12px;
            font-family: inherit;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.1s ease;
        }

        .btn-submit:hover {
            background: #184431;
        }

        .btn-submit:active {
            transform: scale(0.99);
        }

        .login-footer {
            margin-top: 25px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <h1>
                <span>ucchank's</span>
                landscape
            </h1>
            <p>Panel Autentikasi Administrator</p>
        </div>

        <div class="login-body">
            <?php if (!empty($error)): ?>
                <div class="alert-error">
                    <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST" autocomplete="off">
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input
                        type="text"
                        name="username"
                        id="username"
                        class="form-input"
                        placeholder="Masukkan username"
                        value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8') : ''; ?>"
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-input"
                        placeholder="Masukkan password"
                        required
                    >
                </div>

                <button type="submit" class="btn-submit">
                    Masuk
                </button>
            </form>

            <div class="login-footer">
                &copy; <?= date('Y'); ?> UCCHANK'S LANDSCAPE. All rights reserved.
            </div>
        </div>
    </div>

</body>
</html>
