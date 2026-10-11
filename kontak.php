<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - UCCHANK'S LANDSCAPE</title>

    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS -->
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
            <a href="jasa.php" class="nav-main-link">Jasa Kami</a>

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
<main class="kontak-page">

    <!-- ==================================================
         HEADER
    ================================================== -->
    <section class="kontak-header container">
        <span>KONTAK</span>
        <h1>Mari wujudkan kebutuhanmu.</h1>
        <p>
            Konsultasikan kebutuhan taman, kolam, tanaman,
            bunga, dan rumput bersama UCCHANK'S LANDSCAPE.
        </p>
    </section>

    <!-- ==================================================
         DUA KOLOM
    ================================================== -->
    <section class="kontak-grid container">

        <!-- ==================================================
             KONSULTASI
        ================================================== -->
        <div class="contact-box">
            <div class="contact-box-header">
                <span>KONSULTASI</span>
                <h2>Hubungi kami</h2>
                <p>
                    Isi data berikut untuk menyampaikan kebutuhan.
                    Pesan akan dikirim langsung melalui WhatsApp.
                </p>
            </div>

            <!-- NAMA -->
            <div class="contact-field">
                <label for="contactName">Nama</label>
                <input type="text" id="contactName" placeholder="Nama Anda">
            </div>

            <!-- NOMOR WHATSAPP -->
            <div class="contact-field">
                <label for="contactPhone">Nomor WhatsApp</label>
                <input type="text" id="contactPhone" placeholder="08xxxxxxxxxx">
            </div>

            <!-- KEBUTUHAN -->
            <div class="contact-field">
                <label for="contactNeed">Kebutuhan</label>
                <select id="contactNeed">
                    <option value="">Pilih kebutuhan</option>
                    <option value="Pembuatan Taman">Pembuatan Taman</option>
                    <option value="Renovasi Taman">Renovasi Taman</option>
                    <option value="Pembuatan Kolam">Pembuatan Kolam</option>
                    <option value="Renovasi Kolam">Renovasi Kolam</option>
                    <option value="Tanaman & Bunga">Tanaman &amp; Bunga</option>
                    <option value="Rumput">Rumput</option>
                </select>
            </div>

            <!-- PESAN -->
            <div class="contact-field">
                <label for="contactMessage">Pesan</label>
                <textarea id="contactMessage" placeholder="Tulis kebutuhan atau pertanyaan Anda..."></textarea>
            </div>

            <!-- TOMBOL -->
            <button type="button" id="contactSubmit" class="contact-submit">
                Kirim via WhatsApp
            </button>
        </div>

        <!-- ==================================================
             LOKASI
        ================================================== -->
        <div class="contact-box location-box">
            <div class="contact-box-header">
                <span>LOKASI</span>
                <h2>Temukan lokasi kami</h2>
                <p>
                    Lihat lokasi UCCHANK'S LANDSCAPE
                    langsung melalui Google Maps.
                </p>
            </div>

            <!-- GOOGLE MAPS -->
            <div class="map-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!4v1789926939995!6m8!1m7!1s-3BHOCmrrCxrBRQxs_mU3Q!2m2!1d-5.180386551887461!2d119.4067910756161!3f308.5885555889813!4f-9.682582781726353!5f0.7820865974627469"
                    width="800"
                    height="600"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="strict-origin-when-cross-origin">
                </iframe>
            </div>

            <!-- TOMBOL GOOGLE MAPS -->
            <a href="https://maps.app.goo.gl/xL8gb9BoBdCgABVi8" target="_blank" rel="noopener noreferrer" class="map-button">
                Buka di Google Maps
            </a>
        </div>

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