<?php

require_once __DIR__ . '/../auth.php';
include "../../config/db.php";

$error = "";

/*
=========================================================
CEK ID
=========================================================
*/
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

/*
=========================================================
AMBIL DATA
=========================================================
*/
$query = mysqli_query(
    $conn,
    "SELECT *
     FROM konsultasi
     WHERE id = $id"
);

if (!$query || mysqli_num_rows($query) == 0) {
    die("Data konsultasi tidak ditemukan.");
}

$data = mysqli_fetch_assoc($query);

/*
=========================================================
UPDATE STATUS
=========================================================
*/
if (isset($_POST['update'])) {
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $update = mysqli_query(
        $conn,
        "UPDATE konsultasi
         SET status = '$status'
         WHERE id = $id"
    );

    if ($update) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Status gagal diperbarui: " . mysqli_error($conn);
    }

    $data['status'] = $status;
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Konsultasi - UCCHANK'S LANDSCAPE</title>

    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- ADMIN CSS -->
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<!-- ==================================================
     SIDEBAR
================================================== -->
<aside class="admin-sidebar">
    <!-- LOGO -->
    <a href="../../index.html" class="admin-logo">
        <span>ucchank's</span>
        <strong>landscape</strong>
    </a>

    <div class="admin-menu-title">MENU</div>

    <nav class="admin-menu">
        <!-- DASHBOARD -->
        <a href="../index.php" class="menu-link">Dashboard</a>

        <!-- JASA -->
        <a href="../jasa/index.php" class="menu-link">Jasa</a>

        <!-- PRODUK -->
        <div class="menu-product-group">
            <a href="#" class="menu-link menu-product-toggle" onclick="toggleProduk(event)">
                <span>Produk</span>
                <span class="menu-arrow" id="produkArrow">⌄</span>
            </a>

            <div class="menu-submenu" id="produkSubmenu">
                <a href="../produk/tanaman-bunga/index.php" class="submenu-link">Tanaman &amp; Bunga</a>
                <a href="../produk/rumput/index.php" class="submenu-link">Rumput</a>
            </div>
        </div>

        <!-- KONSULTASI -->
        <a href="index.php" class="menu-link active">Konsultasi</a>

        <!-- KELUAR -->
        <a href="../logout.php" class="menu-link">Keluar</a>
    </nav>
</aside>

<!-- ==================================================
     CONTENT
================================================== -->
<main class="admin-content form-page">
    <div class="admin-card form-card">
        <div class="admin-card-header">
            <h1>Edit Konsultasi</h1>
        </div>

        <?php if ($error != "") { ?>
            <div class="alert-error">
                <?= htmlspecialchars($error); ?>
            </div>
        <?php } ?>

        <form method="POST" class="admin-form">
            <!-- NAMA -->
            <div class="form-group">
                <label>Nama</label>
                <input type="text" value="<?= htmlspecialchars($data['nama']); ?>" readonly>
            </div>

            <!-- WHATSAPP -->
            <div class="form-group">
                <label>WhatsApp</label>
                <input type="text" value="<?= htmlspecialchars($data['whatsapp']); ?>" readonly>
            </div>

            <!-- SUMBER -->
            <div class="form-group">
                <label>Sumber</label>
                <input type="text" value="<?= htmlspecialchars($data['sumber']); ?>" readonly>
            </div>

            <!-- JASA -->
            <div class="form-group">
                <label>Jasa</label>
                <input type="text" value="<?= htmlspecialchars($data['jasa'] ?: '-'); ?>" readonly>
            </div>

            <!-- PRODUK -->
            <div class="form-group">
                <label>Produk</label>
                <input type="text" value="<?= htmlspecialchars($data['produk'] ?: '-'); ?>" readonly>
            </div>

            <!-- LOKASI -->
            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" value="<?= htmlspecialchars($data['lokasi'] ?: '-'); ?>" readonly>
            </div>

            <!-- STATUS -->
            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="Menunggu" <?= $data['status'] === 'Menunggu' ? 'selected' : ''; ?>>Menunggu</option>
                    <option value="Diproses" <?= $data['status'] === 'Diproses' ? 'selected' : ''; ?>>Diproses</option>
                    <option value="Selesai" <?= $data['status'] === 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                </select>
            </div>

            <!-- ACTION -->
            <div class="form-actions">
                <a href="index.php" class="btn-secondary">Batal</a>
                <button type="submit" name="update" class="btn btn-primary">Update Status</button>
            </div>
        </form>
    </div>
</main>

<script>
function toggleProduk(event) {
    event.preventDefault();
    const submenu = document.getElementById("produkSubmenu");
    const arrow = document.getElementById("produkArrow");
    submenu.classList.toggle("show");
    arrow.classList.toggle("rotate");
}
</script>

</body>
</html>