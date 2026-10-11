<?php

require_once __DIR__ . '/../../auth.php';
include "../../../config/db.php";

/*
=========================================================
AMBIL DATA RUMPUT
=========================================================
*/

$query = mysqli_query(
    $conn,
    "SELECT
        id,
        nama_produk,
        kategori,
        deskripsi,
        gambar,
        harga,
        satuan
     FROM produk
     WHERE kategori = 'Rumput'
     ORDER BY id ASC"
);

if (!$query) {
    die("Query gagal: " . mysqli_error($conn));
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Rumput - UCCHANK'S LANDSCAPE</title>

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

    <!-- TITLE MENU -->
    <div class="admin-menu-title">MENU</div>

    <!-- MENU -->
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

            <!-- SUBMENU -->
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
<main class="admin-content">

    <div class="admin-card">

        <!-- HEADER -->
        <div class="admin-card-header">
            <h1>Data Rumput</h1>
            <a href="tambah.php" class="btn btn-primary">
                + Tambah Produk
            </a>
        </div>

        <!-- TABLE -->
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Satuan</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <!-- NO -->
                            <td><?= $no++; ?></td>

                            <!-- NAMA -->
                            <td><?= htmlspecialchars($data['nama_produk']); ?></td>

                            <!-- DESKRIPSI -->
                            <td><?= htmlspecialchars($data['deskripsi']); ?></td>

                            <!-- HARGA -->
                            <td>Rp<?= number_format($data['harga'], 0, ',', '.'); ?></td>

                            <!-- SATUAN -->
                            <td><?= htmlspecialchars($data['satuan']); ?></td>

                            <!-- GAMBAR -->
                            <td>
                                <?php if (!empty($data['gambar'])) { ?>
                                    <img src="../../../images/<?= htmlspecialchars($data['gambar']); ?>" alt="<?= htmlspecialchars($data['nama_produk']); ?>">
                                <?php } else { echo "-"; } ?>
                            </td>

                            <!-- AKSI -->
                            <td>
                                <div class="table-actions">
                                    <a href="edit.php?id=<?= $data['id']; ?>" class="btn-edit">
                                        Edit
                                    </a>
                                    <a href="hapus.php?id=<?= $data['id']; ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus produk ini?');">
                                        Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

</main>

<!-- ==================================================
     JAVASCRIPT
================================================== -->
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