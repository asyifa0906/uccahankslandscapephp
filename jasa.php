<?php

include "config/db.php";

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
    <title>Jasa Kami - UCCHANK'S LANDSCAPE</title>

    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS UTAMA -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

<!-- ==================================================
     NAVBAR
================================================== -->
<header class="header">
    <div class="container nav">

        <!-- LOGO -->
        <a href="index.php" class="logo">
            <span>ucchank's</span>
            <strong>landscape</strong>
        </a>

        <!-- MENU -->
        <nav class="nav-links">
            <a href="index.php" class="nav-main-link">Home</a>
            <a href="jasa.php" class="nav-main-link active">Jasa Kami</a>

            <!-- PRODUK -->
            <div class="nav-product">
                <a href="produk.php?category=tanaman-bunga" class="nav-main-link">
                    Produk Kami
                    <span class="nav-arrow">⌄</span>
                </a>
                <div class="nav-dropdown">
                    <a href="produk.php?category=tanaman-bunga">Tanaman &amp; Bunga</a>
                    <a href="produk.php?category=rumput">Rumput</a>
                </div>
            </div>
        </nav>

        <!-- KONTAK -->
        <a href="kontak.php" class="contact-btn">Kontak</a>

    </div>
</header>

<!-- ==================================================
     MAIN
================================================== -->
<main class="jasa-page">

    <!-- ==================================================
         HEADER
    ================================================== -->
    <section class="jasa-header">
        <span>JASA KAMI</span>
        <h1>Pilih jasa yang sesuai kebutuhan.</h1>
        <p>
            Kami menyediakan jasa pembuatan dan renovasi
            taman serta kolam sesuai ukuran area dan kebutuhan.
        </p>
    </section>

    <!-- ==================================================
         DAFTAR JASA
    ================================================== -->
    <section class="jasa-list">
        <?php while ($data = mysqli_fetch_assoc($query)) { ?>
            <article class="jasa-card">
                <div class="jasa-image">
                    <img src="images/<?= htmlspecialchars($data['gambar']); ?>" alt="<?= htmlspecialchars($data['nama_jasa']); ?>">
                </div>

                <div class="jasa-card-body">
                    <span class="jasa-tag">
                        <?= htmlspecialchars($data['kategori']); ?> • <?= htmlspecialchars($data['jenis']); ?>
                    </span>
                    <h2><?= htmlspecialchars($data['nama_jasa']); ?></h2>
                    <p><?= htmlspecialchars($data['deskripsi']); ?></p>
                    <button type="button" class="detail-btn" data-service="<?= htmlspecialchars($data['nama_jasa']); ?>">
                        Detail
                    </button>
                </div>
            </article>
        <?php } ?>
    </section>

    <!-- ==================================================
         KONSULTASI
    ================================================== -->
    <section id="konsultasi" class="consult">

        <div class="consult-header">
            <h2>Konsultasi <span id="selectedService">Pembuatan Taman</span></h2>
            <p>
                Isi ukuran area dan kebutuhan.
                Luas otomatis dihitung dari panjang × lebar.
            </p>
        </div>

        <div class="form-grid">
            <!-- JASA DIPILIH -->
            <div class="field">
                <label>Jasa yang dipilih</label>
                <input type="text" id="serviceField" value="Pembuatan Taman" readonly>
            </div>

            <!-- JENIS PENGERJAAN -->
            <div class="field">
                <label>Jenis pengerjaan</label>
                <select id="workField">
                    <option value="Jasa Pengerjaan">Jasa Pengerjaan</option>
                    <option value="Terima Jadi">Terima Jadi</option>
                </select>
            </div>

            <!-- NAMA -->
            <div class="field">
                <label>Nama</label>
                <input type="text" id="nameField" placeholder="Nama Anda">
            </div>

            <!-- WHATSAPP -->
            <div class="field">
                <label>WhatsApp</label>
                <input type="text" id="phoneField" placeholder="08xxxxxxxxxx">
            </div>

            <!-- PANJANG -->
            <div class="field">
                <label>Panjang area (meter)</label>
                <input type="number" id="lengthField" min="0" step="0.1" placeholder="Contoh: 5">
            </div>

            <!-- LEBAR -->
            <div class="field">
                <label>Lebar area (meter)</label>
                <input type="number" id="widthField" min="0" step="0.1" placeholder="Contoh: 4">
            </div>

            <!-- LUAS -->
            <div class="field full">
                <div class="area-result">
                    Luas area:
                    <strong><span id="areaResult">0</span> m²</strong>
                </div>
            </div>

            <!-- LOKASI -->
            <div class="field full">
                <label>Lokasi</label>
                <input type="text" id="locationField" placeholder="Kelurahan / Kecamatan / Kota">
            </div>

            <!-- CATATAN -->
            <div class="field full">
                <label>Catatan kebutuhan</label>
                <textarea id="noteField" placeholder="Tulis kebutuhan atau gambaran yang diinginkan..."></textarea>
            </div>
        </div>

        <!-- WHATSAPP BUTTON -->
        <button type="button" class="wa-btn" id="waBtn">
            Konsultasi via WhatsApp
        </button>

    </section>

</main>

<!-- ==================================================
     FOOTER
================================================== -->
<footer>
    <div class="footer-main container">
        <!-- BRAND -->
        <div class="footer-brand">
            <h3>ucchank's landscape</h3>
            <p>
                Jasa pembuatan dan renovasi taman serta kolam,
                serta penyedia tanaman, bunga, dan rumput.
            </p>
        </div>

        <!-- MENU -->
        <div class="footer-column">
            <h4>MENU</h4>
            <a href="index.php">Home</a>
            <a href="jasa.php">Jasa Kami</a>
            <a href="produk.php?category=tanaman-bunga">Produk Kami</a>
            <a href="kontak.php">Kontak</a>
        </div>

        <!-- JASA -->
        <div class="footer-column">
            <h4>JASA</h4>
            <a href="jasa.php">Pembuatan Taman</a>
            <a href="jasa.php">Renovasi Taman</a>
            <a href="jasa.php">Pembuatan Kolam</a>
            <a href="jasa.php">Renovasi Kolam</a>
        </div>

        <!-- KONTAK -->
        <div class="footer-column">
            <h4>KONTAK</h4>
            <a href="#">WhatsApp</a>
            <span>Alamat Usaha</span>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <span>© 2026 UCCHANK'S LANDSCAPE</span>
            <span>Jasa Taman &amp; Kolam</span>
        </div>
    </div>
</footer>

<!-- ==================================================
     JQUERY & SCRIPTS
================================================== -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="script.js"></script>
<script src="konsultasi.js"></script>

</body>
</html>