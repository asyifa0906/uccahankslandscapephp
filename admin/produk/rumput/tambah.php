<?php

require_once __DIR__ . '/../../auth.php';
include "../../../config/db.php";

$error = "";

/*
=========================================================
SIMPAN DATA
=========================================================
*/

if (isset($_POST['simpan'])) {
    $nama_produk = mysqli_real_escape_string($conn, $_POST['nama_produk']);
    $deskripsi   = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $gambar      = mysqli_real_escape_string($conn, $_POST['gambar']);
    $harga       = mysqli_real_escape_string($conn, $_POST['harga']);
    $satuan      = mysqli_real_escape_string($conn, $_POST['satuan']);

    $query = mysqli_query(
        $conn,
        "INSERT INTO produk (nama_produk, kategori, deskripsi, gambar, harga, satuan)
         VALUES ('$nama_produk', 'Rumput', '$deskripsi', '$gambar', '$harga', '$satuan')"
    );

    if ($query) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Data produk gagal disimpan: " . mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Rumput - UCCHANK'S LANDSCAPE</title>

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
    <a href="../../index.php" class="admin-logo">
        <span>ucchank's</span>
        <strong>landscape</strong>
    </a>

    <div class="admin-menu-title">MENU</div>

    <nav class="admin-menu">
        <!-- DASHBOARD -->
        <a href="../../index.php" class="menu-link">
            Dashboard
        </a>

        <!-- JASA -->
        <a href="../../jasa/index.php" class="menu-link">
            Jasa
        </a>

        <!-- PRODUK -->
        <div class="menu-product-group">
            <a href="#" class="menu-link menu-product-toggle" onclick="toggleProduk(event)">
                <span>Produk</span>
                <span class="menu-arrow" id="produkArrow">⌄</span>
            </a>

            <div class="menu-submenu" id="produkSubmenu">
                <a href="../tanaman-bunga/index.php" class="submenu-link">
                    Tanaman &amp; Bunga
                </a>
                <a href="index.php" class="submenu-link active">
                    Rumput
                </a>
            </div>
        </div>

        <!-- KONSULTASI -->
        <a href="../../konsultasi/index.php" class="menu-link">
            Konsultasi
        </a>

        <!-- KELUAR -->
        <a href="../../logout.php" class="menu-link">
            Keluar
        </a>
    </nav>

</aside>

<!-- ==================================================
     CONTENT
================================================== -->
<main class="admin-content form-page">

    <div class="admin-card form-card">

        <div class="admin-card-header">
            <h1>Tambah Rumput</h1>
        </div>

        <?php if ($error != "") { ?>
            <div class="alert-error">
                <?= htmlspecialchars($error); ?>
            </div>
        <?php } ?>

        <form method="POST" class="admin-form">

            <!-- NAMA PRODUK -->
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" placeholder="Contoh: Rumput Jepang" required>
            </div>

            <!-- KATEGORI -->
            <div class="form-group">
                <label>Kategori</label>
                <input type="text" value="Rumput" readonly>
            </div>

            <!-- DESKRIPSI -->
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" placeholder="Masukkan deskripsi produk" required></textarea>
            </div>

            <!-- HARGA -->
            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" min="0" placeholder="Contoh: 25000" required>
            </div>

            <!-- SATUAN -->
            <div class="form-group">
                <label>Satuan</label>
                <input type="text" name="satuan" value="m²" required>
            </div>

            <!-- GAMBAR -->
            <div class="form-group">
                <label>Gambar</label>
                <input type="text" name="gambar" placeholder="Contoh: rumput1.jpg" required>
                <small class="form-help">
                    Masukkan nama file gambar yang berada di folder images.
                </small>
            </div>

            <!-- ACTION -->
            <div class="form-actions">
                <a href="index.php" class="btn-secondary">Batal</a>
                <button type="submit" name="simpan" class="btn btn-primary">
                    Simpan Produk
                </button>
            </div>

        </form>

    </div>

</main>

<script>
function toggleProduk(event) {
    event.preventDefault();
    const submenu = document.getElementById("produkSubmenu");
    const arrow   = document.getElementById("produkArrow");

    submenu.classList.toggle("show");
    arrow.classList.toggle("rotate");
}
</script>

</body>
</html>