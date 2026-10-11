<?php

require_once __DIR__ . '/../auth.php';
include "../../config/db.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$query = mysqli_query($conn, "SELECT * FROM jasa WHERE id = $id");
$data  = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data jasa tidak ditemukan.");
}

if (isset($_POST['update'])) {
    $nama_jasa = mysqli_real_escape_string($conn, $_POST['nama_jasa']);
    $kategori  = mysqli_real_escape_string($conn, $_POST['kategori']);
    $jenis     = mysqli_real_escape_string($conn, $_POST['jenis']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $gambar    = mysqli_real_escape_string($conn, $_POST['gambar']);

    $queryUpdate = mysqli_query(
        $conn,
        "UPDATE jasa SET
            nama_jasa = '$nama_jasa',
            kategori  = '$kategori',
            jenis     = '$jenis',
            deskripsi = '$deskripsi',
            gambar    = '$gambar'
         WHERE id = $id"
    );

    if ($queryUpdate) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Data jasa gagal diperbarui: " . mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jasa - UCCHANK'S LANDSCAPE</title>

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

    <a href="../index.php" class="admin-logo">
        <span>ucchank's</span>
        <strong>landscape</strong>
    </a>

    <div class="admin-menu-title">MENU</div>

    <nav class="admin-menu">
        <!-- DASHBOARD -->
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
<main class="admin-content form-page">

    <div class="admin-card form-card">

        <div class="admin-card-header">
            <h1>Edit Jasa</h1>
        </div>

        <?php if (isset($error)) { ?>
            <div class="alert-error">
                <?= htmlspecialchars($error); ?>
            </div>
        <?php } ?>

        <form method="POST" class="admin-form">

            <!-- NAMA JASA -->
            <div class="form-group">
                <label>Nama Jasa</label>
                <input type="text" name="nama_jasa" value="<?= htmlspecialchars($data['nama_jasa']); ?>" required>
            </div>

            <!-- KATEGORI -->
            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori" required>
                    <option value="Taman" <?= $data['kategori'] === 'Taman' ? 'selected' : ''; ?>>
                        Taman
                    </option>
                    <option value="Kolam" <?= $data['kategori'] === 'Kolam' ? 'selected' : ''; ?>>
                        Kolam
                    </option>
                </select>
            </div>

            <!-- JENIS -->
            <div class="form-group">
                <label>Jenis</label>
                <select name="jenis" required>
                    <option value="Pembuatan" <?= $data['jenis'] === 'Pembuatan' ? 'selected' : ''; ?>>
                        Pembuatan
                    </option>
                    <option value="Renovasi" <?= $data['jenis'] === 'Renovasi' ? 'selected' : ''; ?>>
                        Renovasi
                    </option>
                </select>
            </div>

            <!-- DESKRIPSI -->
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" required><?= htmlspecialchars($data['deskripsi']); ?></textarea>
            </div>

            <!-- GAMBAR -->
            <div class="form-group">
                <label>Gambar</label>
                <input type="text" name="gambar" value="<?= htmlspecialchars($data['gambar']); ?>" placeholder="Contoh: jasa1.jpg" required>
                <small class="form-help">
                    Masukkan nama file gambar yang berada di folder images.
                </small>
            </div>

            <!-- ACTION -->
            <div class="form-actions">
                <a href="index.php" class="btn-secondary">Batal</a>
                <button type="submit" name="update" class="btn btn-primary">
                    Update Jasa
                </button>
            </div>

        </form>

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
    arrow.textContent = submenu.classList.contains("show") ? "⌃" : "⌄";
}
</script>

</body>
</html>