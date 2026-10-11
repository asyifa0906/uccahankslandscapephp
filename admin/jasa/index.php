<?php

require_once __DIR__ . '/../auth.php';
include "../../config/db.php";

/* ==================================================
   AMBIL DATA JASA
================================================== */

$query = mysqli_query($conn, "SELECT * FROM jasa ORDER BY id ASC");

if (!$query) {
    die("Query gagal: " . mysqli_error($conn));
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Jasa - UCCHANK'S LANDSCAPE</title>

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
    <a href="../index.php" class="admin-logo">
        <span>ucchank's</span>
        <strong>landscape</strong>
    </a>

    <!-- MENU TITLE -->
    <div class="admin-menu-title">MENU</div>

    <!-- MENU -->
    <nav class="admin-menu">
        <a href="../index.php" class="menu-link">
            Dashboard
        </a>

        <!-- JASA -->
        <a href="index.php" class="menu-link active">
            Jasa
        </a>

        <!-- PRODUK -->
        <div class="menu-product-group">
            <a href="#" class="menu-link menu-product-toggle" onclick="toggleProduk(event)">
                <span>Produk</span>
                <span class="menu-arrow" id="produkArrow">⌄</span>
            </a>

            <!-- SUBMENU PRODUK -->
            <div class="menu-submenu" id="produkSubmenu">
                <a href="../produk/tanaman-bunga/index.php" class="submenu-link">
                    Tanaman &amp; Bunga
                </a>
                <a href="../produk/rumput/index.php" class="submenu-link">
                    Rumput
                </a>
            </div>
        </div>

        <!-- KONSULTASI -->
        <a href="../konsultasi/index.php" class="menu-link">
            Konsultasi
        </a>

        <!-- KELUAR -->
        <a href="../logout.php" class="menu-link">
            Keluar
        </a>
    </nav>

</aside>

<!-- ==================================================
     CONTENT
================================================== -->
<main class="admin-content">

    <!-- CARD -->
    <div class="admin-card">

        <!-- HEADER CARD -->
        <div class="admin-card-header">
            <h1>Data Jasa</h1>
            <a href="tambah.php" class="btn btn-primary">
                + Tambah Jasa
            </a>
        </div>

        <!-- TABLE -->
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Jasa</th>
                        <th>Kategori</th>
                        <th>Jenis</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                if (mysqli_num_rows($query) > 0) {
                    while ($data = mysqli_fetch_assoc($query)) {
                ?>
                    <tr>
                        <!-- NO -->
                        <td><?= $no++; ?></td>

                        <!-- NAMA -->
                        <td>
                            <strong><?= htmlspecialchars($data['nama_jasa']); ?></strong>
                        </td>

                        <!-- KATEGORI -->
                        <td>
                            <span class="badge"><?= htmlspecialchars($data['kategori']); ?></span>
                        </td>

                        <!-- JENIS -->
                        <td>
                            <span class="badge"><?= htmlspecialchars($data['jenis']); ?></span>
                        </td>

                        <!-- DESKRIPSI -->
                        <td><?= htmlspecialchars($data['deskripsi']); ?></td>

                        <!-- GAMBAR -->
                        <td>
                            <?php if (!empty($data['gambar'])) { ?>
                                <img src="../../images/<?= htmlspecialchars($data['gambar']); ?>" alt="<?= htmlspecialchars($data['nama_jasa']); ?>">
                            <?php } else { echo "-"; } ?>
                        </td>

                        <!-- AKSI -->
                        <td>
                            <div class="table-actions">
                                <a href="edit.php?id=<?= $data['id']; ?>" class="btn-edit">
                                    Edit
                                </a>
                                <a href="hapus.php?id=<?= $data['id']; ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus jasa ini?');">
                                    Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="7" class="empty-state">
                            Belum ada data jasa.
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

</main>

<!-- ==================================================
     JAVASCRIPT PRODUK
================================================== -->
<script>
function toggleProduk(event) {
    event.preventDefault();
    const submenu = document.getElementById("produkSubmenu");
    const arrow   = document.getElementById("produkArrow");

    submenu.classList.toggle("show");
    if (submenu.classList.contains("show")) {
        arrow.textContent = "⌃";
    } else {
        arrow.textContent = "⌄";
    }
}
</script>

</body>
</html>