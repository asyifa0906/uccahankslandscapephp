<?php

require_once __DIR__ . '/auth.php';
include "../config/db.php";

function getCount($conn, $table, $where = "")
{
    $sql = "SELECT COUNT(*) AS total FROM `$table`";

    if ($where !== "") {
        $sql .= " WHERE $where";
    }

    $query = mysqli_query($conn, $sql);

    if (!$query) {
        return 0;
    }

    $data = mysqli_fetch_assoc($query);

    return (int) ($data['total'] ?? 0);
}

$totalJasa       = getCount($conn, "jasa");
$totalProduk     = getCount($conn, "produk");
$totalKonsultasi = getCount($conn, "konsultasi");
$totalMenunggu   = getCount($conn, "konsultasi", "status = 'Menunggu'");

$queryTerbaru = mysqli_query(
    $conn,
    "SELECT
        id,
        nama,
        jasa,
        produk,
        catatan,
        status,
        created_at
     FROM konsultasi
     ORDER BY created_at DESC
     LIMIT 5"
);

if (!$queryTerbaru) {
    $queryTerbaru = false;
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - UCCHANK'S LANDSCAPE</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="admin-sidebar">
        <a href="../index.php" class="admin-logo">
            <span>ucchank's</span>
            <strong>landscape</strong>
        </a>

        <div class="admin-menu-title">MENU</div>

        <nav class="admin-menu">
            <!-- DASHBOARD -->
            <a href="index.php" class="menu-link active">
                Dashboard
            </a>

            <!-- JASA -->
            <a href="jasa/index.php" class="menu-link">
                Jasa
            </a>

            <!-- PRODUK -->
            <div class="menu-product-group">
                <a href="#" class="menu-link menu-product-toggle" onclick="toggleProduk(event)">
                    <span>Produk</span>
                    <span class="menu-arrow" id="produkArrow">⌄</span>
                </a>
                <div class="menu-submenu" id="produkSubmenu">
                    <a href="produk/tanaman-bunga/index.php" class="submenu-link">
                        Tanaman &amp; Bunga
                    </a>
                    <a href="produk/rumput/index.php" class="submenu-link">
                        Rumput
                    </a>
                </div>
            </div>

            <!-- KONSULTASI -->
            <a href="konsultasi/index.php" class="menu-link">
                Konsultasi
            </a>

            <!-- KELUAR -->
            <a href="logout.php" class="menu-link">
                Keluar
            </a>
        </nav>
    </aside>

    <!-- CONTENT -->
    <main class="admin-content">
        <div class="dashboard-welcome">
            <h1>Dashboard</h1>
            <p>Selamat datang di Admin UCCHANK'S LANDSCAPE.</p>
        </div>

        <!-- STATISTIK -->
        <div class="dashboard-stats">
            <div class="dashboard-stat">
                <span>Total Jasa</span>
                <strong><?= $totalJasa; ?></strong>
                <small>Data jasa taman &amp; kolam</small>
            </div>

            <div class="dashboard-stat">
                <span>Total Produk</span>
                <strong><?= $totalProduk; ?></strong>
                <small>Tanaman, bunga &amp; rumput</small>
            </div>

            <div class="dashboard-stat">
                <span>Total Konsultasi</span>
                <strong><?= $totalKonsultasi; ?></strong>
                <small>Semua data konsultasi</small>
            </div>

            <div class="dashboard-stat">
                <span>Menunggu</span>
                <strong><?= $totalMenunggu; ?></strong>
                <small>Konsultasi belum ditangani</small>
            </div>
        </div>

        <!-- KONSULTASI TERBARU -->
        <div class="admin-card dashboard-table-card">
            <div class="dashboard-table-header">
                <h2>Konsultasi Terbaru</h2>
                <a href="konsultasi/index.php" class="dashboard-view-all">
                    Lihat Semua
                </a>
            </div>

            <div class="table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jasa / Produk</th>
                            <th>Pesan</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if ($queryTerbaru && mysqli_num_rows($queryTerbaru) > 0):
                            while ($data = mysqli_fetch_assoc($queryTerbaru)):
                                $jasaProduk = "-";
                                if (!empty($data['jasa'])) {
                                    $jasaProduk = $data['jasa'];
                                } elseif (!empty($data['produk'])) {
                                    $jasaProduk = $data['produk'];
                                }

                                $pesan = "-";
                                if (!empty($data['catatan'])) {
                                    $pesan = $data['catatan'];
                                }

                                if (strlen($pesan) > 38) {
                                    $pesan = substr($pesan, 0, 38) . "...";
                                }

                                $status = $data['status'] ?? "Menunggu";
                                $statusClass = "default";

                                if ($status === "Menunggu") {
                                    $statusClass = "menunggu";
                                } elseif ($status === "Diproses") {
                                    $statusClass = "diproses";
                                } elseif ($status === "Selesai") {
                                    $statusClass = "selesai";
                                }

                                $tanggal = "-";
                                if (!empty($data['created_at'])) {
                                    $tanggal = date("d M Y", strtotime($data['created_at']));
                                }
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><strong><?= htmlspecialchars($data['nama'] ?? "-"); ?></strong></td>
                                <td><?= htmlspecialchars($jasaProduk); ?></td>
                                <td><?= htmlspecialchars($pesan); ?></td>
                                <td>
                                    <span class="dashboard-status <?= $statusClass; ?>">
                                        <?= htmlspecialchars($status); ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($tanggal); ?></td>
                            </tr>
                        <?php
                            endwhile;
                        else:
                        ?>
                            <tr>
                                <td colspan="6" class="dashboard-empty">
                                    Belum ada data konsultasi.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="admin-footer">
            &copy; 2026 UCCHANK'S LANDSCAPE. Admin Panel.
        </div>
    </main>

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