<?php

require_once __DIR__ . '/../../auth.php';
include "../../../config/db.php";

/* ==================================================
   PROSES SIMPAN
================================================== */
if (isset($_POST['simpan'])) {
    $nama_produk = mysqli_real_escape_string($conn, $_POST['nama_produk']);
    $deskripsi   = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $gambar      = mysqli_real_escape_string($conn, $_POST['gambar']);
    $harga       = mysqli_real_escape_string($conn, $_POST['harga']);
    $satuan      = mysqli_real_escape_string($conn, $_POST['satuan']);
    $kategori    = "Tanaman & Bunga";

    /* ==================================================
       VALIDASI
    ================================================== */
    if (
        trim($_POST['nama_produk']) === "" ||
        trim($_POST['deskripsi']) === "" ||
        trim($_POST['gambar']) === "" ||
        trim($_POST['harga']) === "" ||
        trim($_POST['satuan']) === ""
    ) {
        $error = "Semua data produk wajib diisi.";
    } else {
        /* ==================================================
           SIMPAN DATA
        ================================================== */
        $query = mysqli_query(
            $conn,
            "INSERT INTO produk (
                nama_produk,
                kategori,
                deskripsi,
                gambar,
                harga,
                satuan
            ) VALUES (
                '$nama_produk',
                '$kategori',
                '$deskripsi',
                '$gambar',
                '$harga',
                '$satuan'
            )"
        );

        if ($query) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Data produk gagal disimpan: " . mysqli_error($conn);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - UCCHANK'S LANDSCAPE</title>

    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- ADMIN CSS -->
    <link rel="stylesheet" href="../../css/admin.css">
</head>
<body>

<!-- ==================================================
     SIDEBAR
================================================== -->
<aside class="admin-sidebar">
    <!-- LOGO -->
    <a href="../../../index.html" class="admin-logo">
        <span>ucchank's</span>
        <strong>landscape</strong>
    </a>

    <!-- MENU TITLE -->
    <div class="admin-menu-title">MENU</div>

    <!-- MENU -->
    <nav class="admin-menu">
        <!-- DASHBOARD -->
        <a href="../../index.php" class="menu-link">Dashboard</a>

        <!-- JASA -->
        <a href="../../jasa/index.php" class="menu-link">Jasa</a>

        <!-- PRODUK -->
        <div class="menu-product-group">
            <a href="#" class="menu-link active menu-product-toggle" onclick="toggleProduk(event)">
                <span>Produk</span>
                <span class="menu-arrow" id="produkArrow">⌃</span>
            </a>

            <!-- SUBMENU -->
            <div class="menu-submenu show" id="produkSubmenu">
                <a href="index.php" class="submenu-link active">Tanaman &amp; Bunga</a>
                <a href="../rumput/index.php" class="submenu-link">Rumput</a>
            </div>
        </div>

        <!-- KONSULTASI -->
        <a href="../../konsultasi/index.php" class="menu-link">Konsultasi</a>

        <!-- KELUAR -->
        <a href="../../logout.php" class="menu-link">Keluar</a>
    </nav>
</aside>

<!-- ==================================================
     CONTENT
================================================== -->
<main class="admin-content form-page">
    <!-- CARD -->
    <div class="admin-card form-card">
        <!-- HEADER CARD -->
        <div class="admin-card-header">
            <h1>Tambah Produk</h1>
        </div>

        <!-- ERROR -->
        <?php if (isset($error)) { ?>
            <div class="alert-error">
                <?= htmlspecialchars($error); ?>
            </div>
        <?php } ?>

        <!-- FORM -->
        <form method="POST" class="admin-form">
            <!-- NAMA PRODUK -->
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" placeholder="Contoh: Bonsai Beringin" value="<?= htmlspecialchars($_POST['nama_produk'] ?? ''); ?>" required>
            </div>

            <!-- KATEGORI -->
            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori" required>
                    <option value="Tanaman & Bunga" selected>Tanaman &amp; Bunga</option>
                </select>
            </div>

            <!-- DESKRIPSI -->
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" placeholder="Masukkan deskripsi produk..." required><?= htmlspecialchars($_POST['deskripsi'] ?? ''); ?></textarea>
            </div>

            <!-- GAMBAR -->
            <div class="form-group">
                <label>Gambar</label>
                <input type="text" name="gambar" placeholder="Contoh: tanaman1.jpg" value="<?= htmlspecialchars($_POST['gambar'] ?? ''); ?>" required>
                <small class="form-help">Masukkan nama file gambar yang berada di folder images.</small>
            </div>

            <!-- HARGA -->
            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" placeholder="Contoh: 750000" min="0" step="1" value="<?= htmlspecialchars($_POST['harga'] ?? ''); ?>" required>
            </div>

            <!-- SATUAN -->
            <div class="form-group">
                <label>Satuan</label>
                <input type="text" name="satuan" placeholder="Contoh: pohon" value="<?= htmlspecialchars($_POST['satuan'] ?? ''); ?>" required>
            </div>

            <!-- ACTION -->
            <div class="form-actions">
                <a href="index.php" class="btn-secondary">Batal</a>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan Produk</button>
            </div>
        </form>
    </div>
</main>

<!-- ==================================================
     JAVASCRIPT SIDEBAR
================================================== -->
<script>
function toggleProduk(event) {
    event.preventDefault();
    const submenu = document.getElementById("produkSubmenu");
    const arrow = document.getElementById("produkArrow");
    submenu.classList.toggle("show");
    arrow.textContent = submenu.classList.contains("show") ? "⌃" : "⌄";
}
</script>

</body>
</html>