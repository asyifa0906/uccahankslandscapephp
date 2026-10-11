<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCCHANK'S LANDSCAPE</title>

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
                <a href="index.php" class="active">Home</a>
                <a href="jasa.php">Jasa Kami</a>

                <!-- PRODUK -->
                <div class="nav-product">
                    <a href="produk.php?category=tanaman-bunga" class="nav-main-link">
                        Produk Kami
                        <span class="nav-arrow">⌄</span>
                    </a>
                    <div class="nav-dropdown">
                        <a href="produk.php?category=tanaman-bunga">Tanaman & Bunga</a>
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
    <main>

        <!-- ==================================================
             HERO
        ================================================== -->
        <section class="hero">
            <!-- VIDEO BACKGROUND -->
            <video class="hero-video" autoplay muted loop playsinline>
                <source src="videos/hero.mp4" type="video/mp4">
                Browser Anda tidak mendukung video.
            </video>

            <!-- OVERLAY -->
            <div class="hero-overlay"></div>

            <!-- HERO TEXT -->
            <div class="container hero-content">
                <div class="hero-text">
                    <span>UCCHANK'S LANDSCAPE</span>
                    <h1>
                        Ruang luar<br>
                        yang lebih hidup.
                    </h1>
                </div>
            </div>
        </section>

        <!-- ==================================================
             TENTANG
        ================================================== -->
        <section class="about">
            <!-- BACKGROUND IMAGE -->
            <div class="about-background"></div>

            <!-- OVERLAY -->
            <div class="about-overlay"></div>

            <div class="container about-content">
                <!-- JUDUL -->
                <div class="about-title">
                    <span>Tentang</span>
                    <h2>UCCHANK'S LANDSCAPE</h2>
                </div>

                <!-- DESKRIPSI -->
                <div class="about-description">
                    <p>
                        Menyediakan jasa pembuatan
                        dan renovasi taman serta kolam, sekaligus
                        menyediakan tanaman, bunga, dan rumput untuk
                        memperindah lingkungan.
                    </p>
                </div>

                <!-- JASA & PRODUK -->
                <div class="service-box">
                    <!-- JASA -->
                    <div class="service-item">
                        <div class="service-number">01</div>
                        <div class="service-text">
                            <h3>Jasa</h3>
                            <p>Pembuatan dan renovasi taman serta kolam.</p>
                        </div>
                    </div>

                    <!-- PRODUK -->
                    <div class="service-item">
                        <div class="service-number">02</div>
                        <div class="service-text">
                            <h3>Produk</h3>
                            <p>Tanaman, bunga, dan rumput.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================================================
             CARA PEMESANAN
        ================================================== -->
        <section class="process">
            <div class="container">
                <div class="section-heading">
                    <span>Cara Pemesanan</span>
                    <h2>Alur pemesanan</h2>
                </div>

                <div class="process-list">
                    <div class="process-item">
                        <span>01</span>
                        <h3>Konsultasi</h3>
                    </div>

                    <div class="process-item">
                        <span>02</span>
                        <h3>Cek Lokasi</h3>
                    </div>

                    <div class="process-item">
                        <span>03</span>
                        <h3>Penentuan Harga</h3>
                    </div>

                    <div class="process-item">
                        <span>04</span>
                        <h3>Kesepakatan</h3>
                    </div>

                    <div class="process-item">
                        <span>05</span>
                        <h3>Pengerjaan</h3>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================================================
             GALERI
        ================================================== -->
        <section class="gallery">
            <div class="container">
                <!-- JUDUL GALERI -->
                <div class="section-heading gallery-heading">
                    <span>Galeri</span>
                    <h2>Foto & Video</h2>
                </div>

                <!-- ==================================================
                     FOTO
                ================================================== -->
                <div class="gallery-grid">
                    <div class="photo">
                        <img src="images/foto1.jpg" alt="Foto taman 1">
                    </div>
                    <div class="photo">
                        <img src="images/foto2.jpg" alt="Foto taman 2">
                    </div>
                    <div class="photo">
                        <img src="images/foto3.jpg" alt="Foto taman 3">
                    </div>
                    <div class="photo">
                        <img src="images/foto4.jpg" alt="Foto taman 4">
                    </div>
                    <div class="photo">
                        <img src="images/foto5.jpg" alt="Foto taman 5">
                    </div>
                    <div class="photo">
                        <img src="images/foto6.jpg" alt="Foto taman 6">
                    </div>
                    <div class="photo">
                        <img src="images/foto7.jpg" alt="Foto taman 7">
                    </div>
                    <div class="photo">
                        <img src="images/foto8.jpg" alt="Foto taman 8">
                    </div>
                    <div class="photo">
                        <img src="images/foto9.jpg" alt="Foto taman 9">
                    </div>
                    <div class="photo">
                        <img src="images/foto10.jpg" alt="Foto taman 10">
                    </div>
                </div>

                <!-- ==================================================
                     VIDEO
                ================================================== -->
                <div class="video-grid">
                    <!-- VIDEO 1 -->
                    <div class="video-card">
                        <video controls playsinline>
                            <source src="videos/video1.mp4" type="video/mp4">
                            Browser Anda tidak mendukung video.
                        </video>
                    </div>

                    <!-- VIDEO 2 -->
                    <div class="video-card">
                        <video controls playsinline>
                            <source src="videos/video2.mp4" type="video/mp4">
                            Browser Anda tidak mendukung video.
                        </video>
                    </div>

                    <!-- VIDEO 3 -->
                    <div class="video-card">
                        <video controls playsinline>
                            <source src="videos/video3.mp4" type="video/mp4">
                            Browser Anda tidak mendukung video.
                        </video>
                    </div>

                    <!-- VIDEO 4 -->
                    <div class="video-card">
                        <video controls playsinline>
                            <source src="videos/video4.mp4" type="video/mp4">
                            Browser Anda tidak mendukung video.
                        </video>
                    </div>
                </div>

            </div>
        </section>

        <!-- ==================================================
             AREA PELAYANAN
        ================================================== -->
        <section class="area">
            <div class="area-background"></div>
            <div class="container area-content">
                <span>Area Pelayanan</span>
                <h2>Sulawesi Selatan</h2>
            </div>
        </section>

    </main>

    <!-- ==================================================
         FOOTER
    ================================================== -->
    <footer>
        <div class="container footer-main">
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
                <h4>Menu</h4>
                <a href="index.php">Home</a>
                <a href="jasa.php">Jasa Kami</a>
                <a href="produk.php">Produk Kami</a>
                <a href="kontak.php">Kontak</a>
            </div>

            <!-- JASA -->
            <div class="footer-column">
                <h4>Jasa</h4>
                <span>Pembuatan Taman</span>
                <span>Renovasi Taman</span>
                <span>Pembuatan Kolam</span>
                <span>Renovasi Kolam</span>
            </div>

            <!-- KONTAK -->
            <div class="footer-column">
                <h4>Kontak</h4>
                <span>WhatsApp</span>
                <span>Alamat Usaha</span>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <span>© 2026 UCCHANK'S LANDSCAPE</span>
                <span>Jasa Taman & Kolam</span>
            </div>
        </div>
    </footer>

    <!-- ==================================================
         JQUERY & SCRIPT
    ================================================== -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="script.js"></script>

</body>

</html>