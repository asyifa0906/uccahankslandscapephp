<?php

require_once __DIR__ . '/../auth.php';
include "../../config/db.php";

/*
=========================================================
AMBIL DATA KONSULTASI
=========================================================
*/
$query = mysqli_query(
    $conn,
    "SELECT
        id,
        sumber,
        nama,
        whatsapp,
        jasa,
        jenis_kebutuhan,
        produk,
        jumlah,
        satuan,
        kebutuhan_tanah,
        panjang,
        lebar,
        luas,
        lokasi,
        catatan,
        status,
        created_at
     FROM konsultasi
     ORDER BY created_at DESC"
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
    <title>Data Konsultasi - UCCHANK'S LANDSCAPE</title>

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

    <!-- MENU TITLE -->
    <div class="admin-menu-title">MENU</div>

    <!-- MENU -->
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

            <!-- SUBMENU PRODUK -->
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
<main class="admin-content">
    <div class="admin-card">
        <!-- HEADER -->
        <div class="admin-card-header">
            <h1>Data Konsultasi</h1>
        </div>

        <!-- TABLE -->
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Sumber</th>
                        <th>Nama</th>
                        <th>WhatsApp</th>
                        <th>Jasa</th>
                        <th>Jenis Kebutuhan</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Kebutuhan Tanah</th>
                        <th>Panjang</th>
                        <th>Lebar</th>
                        <th>Luas</th>
                        <th>Lokasi</th>
                        <th>Catatan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
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

                            <!-- SUMBER -->
                            <td><?= htmlspecialchars($data['sumber']); ?></td>

                            <!-- NAMA -->
                            <td>
                                <strong><?= htmlspecialchars($data['nama']); ?></strong>
                            </td>

                            <!-- WHATSAPP -->
                            <td><?= htmlspecialchars($data['whatsapp']); ?></td>

                            <!-- JASA -->
                            <td><?= !empty($data['jasa']) ? htmlspecialchars($data['jasa']) : '-'; ?></td>

                            <!-- JENIS KEBUTUHAN -->
                            <td><?= !empty($data['jenis_kebutuhan']) ? htmlspecialchars($data['jenis_kebutuhan']) : '-'; ?></td>

                            <!-- PRODUK -->
                            <td><?= !empty($data['produk']) ? htmlspecialchars($data['produk']) : '-'; ?></td>

                            <!-- JUMLAH -->
                            <td><?= $data['jumlah'] !== null ? htmlspecialchars($data['jumlah']) : '-'; ?></td>

                            <!-- SATUAN -->
                            <td><?= !empty($data['satuan']) ? htmlspecialchars($data['satuan']) : '-'; ?></td>

                            <!-- KEBUTUHAN TANAH -->
                            <td><?= !empty($data['kebutuhan_tanah']) ? htmlspecialchars($data['kebutuhan_tanah']) : '-'; ?></td>

                            <!-- PANJANG -->
                            <td><?= $data['panjang'] !== null ? htmlspecialchars($data['panjang']) . ' m' : '-'; ?></td>

                            <!-- LEBAR -->
                            <td><?= $data['lebar'] !== null ? htmlspecialchars($data['lebar']) . ' m' : '-'; ?></td>

                            <!-- LUAS -->
                            <td><?= $data['luas'] !== null ? htmlspecialchars($data['luas']) . ' m²' : '-'; ?></td>

                            <!-- LOKASI -->
                            <td><?= !empty($data['lokasi']) ? htmlspecialchars($data['lokasi']) : '-'; ?></td>

                            <!-- CATATAN -->
                            <td><?= !empty($data['catatan']) ? htmlspecialchars($data['catatan']) : '-'; ?></td>

                            <!-- STATUS -->
                            <td>
                                <span class="badge"><?= htmlspecialchars($data['status']); ?></span>
                            </td>

                            <!-- TANGGAL -->
                            <td><?= date('d-m-Y H:i', strtotime($data['created_at'])); ?></td>

                            <!-- AKSI -->
                            <td>
                                <div class="table-actions">
                                    <a href="edit.php?id=<?= $data['id']; ?>" class="btn-edit">Edit</a>
                                    <a href="hapus.php?id=<?= $data['id']; ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus data konsultasi ini?');">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    <?php
                        }
                    } else {
                    ?>
                        <tr>
                            <td colspan="18" class="empty-state">Belum ada data konsultasi.</td>
                        </tr>
                    <?php
                    }
                    ?>
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
    const arrow = document.getElementById("produkArrow");
    submenu.classList.toggle("show");
    arrow.classList.toggle("rotate");
}
</script>

</body>
</html>