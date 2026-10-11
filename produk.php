<?php

include "config/db.php";

/*
==================================================
KATEGORI
==================================================
*/
$currentCategory = $_GET["category"] ?? "tanaman-bunga";

if ($currentCategory !== "tanaman-bunga" && $currentCategory !== "rumput") {
    $currentCategory = "tanaman-bunga";
}

$kategoriDatabase = ($currentCategory === "tanaman-bunga") ? "Tanaman & Bunga" : "Rumput";

/*
==================================================
AMBIL DATA PRODUK DARI DATABASE
==================================================
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
     WHERE kategori = '$kategoriDatabase'
     ORDER BY id ASC"
);

if (!$query) {
    die("Query produk gagal: " . mysqli_error($conn));
}

$jumlahProduk = mysqli_num_rows($query);

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Kami - UCCHANK'S LANDSCAPE</title>

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
                <a href="produk.php?category=tanaman-bunga" class="nav-main-link active">
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
     HALAMAN PRODUK
================================================== -->
<main class="produk-page">

    <!-- HEADER PRODUK -->
    <section class="produk-header">
        <p class="section-label">PRODUK KAMI</p>
        <h1>Tanaman, bunga, dan rumput.</h1>
        <p class="produk-intro">
            Pilih kategori produk, cari produk yang dibutuhkan, tentukan jumlah, lalu pesan melalui WhatsApp.
        </p>
    </section>

    <!-- ==================================================
         SHOP
    ================================================== -->
    <section class="product-shop">

        <!-- SEARCH -->
        <div class="shop-bar">
            <div class="search-wrap">
                <span class="search-icon">⌕</span>
                <input type="search" id="searchInput" class="search" placeholder="Cari produk...">
            </div>
        </div>

        <!-- HASIL -->
        <div class="result-line">
            <strong id="categoryTitle"><?= htmlspecialchars($kategoriDatabase); ?></strong>
            <span id="resultCount"><?= $jumlahProduk; ?> produk</span>
        </div>

        <!-- ==================================================
             PRODUK DARI DATABASE
        ================================================== -->
        <section class="product-grid" id="productGrid">

            <?php if ($jumlahProduk > 0): ?>
                <?php while ($data = mysqli_fetch_assoc($query)): ?>
                    <?php
                    $id             = (int) $data["id"];
                    $namaProduk     = $data["nama_produk"] ?? "";
                    $kategori       = $data["kategori"] ?? "";
                    $deskripsi      = $data["deskripsi"] ?? "";
                    $gambar         = $data["gambar"] ?? "";
                    $harga          = (float) ($data["harga"] ?? 0);
                    $satuan         = $data["satuan"] ?? "";
                    $kebutuhanTanah = $data["kebutuhan_tanah"] ?? "";

                    $hargaTampil = "Rp" . number_format($harga, 0, ",", ".");

                    if ($gambar !== "") {
                        $gambarPath = "images/" . $gambar;
                    } else {
                        $gambarPath = "images/no-image.jpg";
                    }
                    ?>

                    <!-- ==================================================
                         CARD PRODUK
                    ================================================== -->
                    <article
                        class="product-card"
                        data-id="<?= $id; ?>"
                        data-category="<?= htmlspecialchars($currentCategory); ?>"
                        data-name="<?= htmlspecialchars($namaProduk); ?>"
                        data-description="<?= htmlspecialchars($deskripsi); ?>"
                    >

                        <!-- GAMBAR -->
                        <div class="product-image">
                            <img
                                src="<?= htmlspecialchars($gambarPath); ?>"
                                alt="<?= htmlspecialchars($namaProduk); ?>"
                                loading="lazy"
                                onerror="this.src='images/no-image.jpg';"
                            >
                        </div>

                        <!-- ISI CARD -->
                        <div class="product-card-body">

                            <!-- KATEGORI -->
                            <span class="product-category">
                                <?= htmlspecialchars($kategori); ?>
                            </span>

                            <!-- NAMA PRODUK -->
                            <h2 class="product-name">
                                <?= htmlspecialchars($namaProduk); ?>
                            </h2>

                            <!-- DESKRIPSI -->
                            <p class="product-description">
                                <?= htmlspecialchars($deskripsi); ?>
                            </p>

                            <!-- HARGA -->
                            <div class="product-price-box">
                                <span class="product-price-label">
                                    Harga / <?= htmlspecialchars($satuan); ?>
                                </span>
                                <strong class="product-price">
                                    <?= $hargaTampil; ?>
                                </strong>
                            </div>

                            <!-- JUMLAH -->
                            <div class="product-option">
                                <span>Jumlah</span>
                                <div class="quantity-control">
                                    <button type="button" class="qty-minus" data-id="<?= $id; ?>">−</button>
                                    <input type="number" class="qty-input" data-id="<?= $id; ?>" value="0" min="0">
                                    <button type="button" class="qty-plus" data-id="<?= $id; ?>">+</button>
                                </div>
                                <span class="product-unit">
                                    <?= htmlspecialchars($satuan); ?>
                                </span>
                            </div>

                            <?php if ($currentCategory === "rumput"): ?>
                                <!-- TANAH -->
                                <div class="product-option grass-soil">
                                    <label>Tanah</label>
                                    <div class="soil-input">
                                        <input type="number" class="soil-qty" data-id="<?= $id; ?>" min="0" value="0" placeholder="0">
                                        <select class="soil-unit" data-id="<?= $id; ?>">
                                            <option value="Karung">Karung</option>
                                            <option value="Pickup">Pickup</option>
                                            <option value="Truk">Truk</option>
                                        </select>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- INSTALASI -->
                            <div class="product-option">
                                <label>Instalasi</label>
                                <select class="install-select" data-id="<?= $id; ?>">
                                    <option value="Tidak">Tidak</option>
                                    <option value="Ya">Ya</option>
                                </select>
                            </div>

                            <!-- WHATSAPP -->
                            <button type="button" class="product-wa-btn" data-id="<?= $id; ?>">
                                Pesan via WhatsApp
                            </button>

                        </div>

                    </article>

                <?php endwhile; ?>
            <?php endif; ?>

        </section>

        <!-- ==================================================
             TIDAK ADA HASIL
        ================================================== -->
        <div class="no-result" id="noResult" style="display: <?= $jumlahProduk > 0 ? 'none' : 'block'; ?>;">
            <?php if ($jumlahProduk === 0): ?>
                Produk pada kategori ini belum tersedia.
            <?php else: ?>
                Produk yang dicari belum ditemukan.
            <?php endif; ?>
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

<!-- ==================================================
     JAVASCRIPT PRODUK (Pencarian & Kontrol Jumlah)
================================================== -->
<script>
$(function () {
    const nomorWhatsApp = "6283862555466";

    /*
    ==================================================
    PENCARIAN
    ==================================================
    */
    $("#searchInput").on("input", function () {
        const keyword = $(this).val().toLowerCase().trim();
        let jumlahTampil = 0;

        $(".product-card").each(function () {
            const $card = $(this);
            const nama = ($card.attr("data-name") || "").toLowerCase();
            const deskripsi = ($card.attr("data-description") || "").toLowerCase();

            if (nama.includes(keyword) || deskripsi.includes(keyword)) {
                $card.show();
                jumlahTampil++;
            } else {
                $card.hide();
            }
        });

        $("#resultCount").text(jumlahTampil + " produk");

        if ($(".product-card").length === 0 || jumlahTampil === 0) {
            $("#noResult").show();
        } else {
            $("#noResult").hide();
        }
    });

    /*
    ==================================================
    KONTROL JUMLAH (MINUS & PLUS)
    ==================================================
    */
    $(document).on("click", ".qty-minus", function () {
        const $input = $(this).closest(".quantity-control").find(".qty-input");
        let jumlah = parseInt($input.val(), 10);

        if (isNaN(jumlah) || jumlah <= 0) {
            jumlah = 0;
        } else {
            jumlah--;
        }

        $input.val(jumlah);
    });

    $(document).on("click", ".qty-plus", function () {
        const $input = $(this).closest(".quantity-control").find(".qty-input");
        let jumlah = parseInt($input.val(), 10);

        if (isNaN(jumlah) || jumlah < 0) {
            jumlah = 0;
        }

        jumlah++;
        $input.val(jumlah);
    });

    $(document).on("input", ".qty-input", function () {
        let jumlah = parseInt($(this).val(), 10);

        if (isNaN(jumlah) || jumlah < 0) {
            $(this).val(0);
        }
    });

    /*
    ==================================================
    WHATSAPP PRODUK (FALLBACK JIKA DIKLIK LANGSUNG)
    ==================================================
    */
    $(document).on("click", ".product-wa-btn", function () {
        const $card = $(this).closest(".product-card");
        const namaProduk = $card.find(".product-name").text().trim();
        const kategori = $card.find(".product-category").text().trim();
        const harga = $card.find(".product-price").text().trim();
        const satuan = $card.find(".product-unit").text().trim();
        const jumlah = parseInt($card.find(".qty-input").val(), 10) || 0;
        const instalasi = $card.find(".install-select").val() || "Tidak";

        if (jumlah <= 0) {
            alert("Silakan tentukan jumlah produk terlebih dahulu.");
            $card.find(".qty-input").focus();
            return;
        }

        let pesan =
`Halo UCCHANK'S LANDSCAPE,

Saya ingin memesan produk.

Produk: ${namaProduk}
Kategori: ${kategori}

Jumlah: ${jumlah} ${satuan}
Harga: ${harga} / ${satuan}

Instalasi: ${instalasi}`;

        const soilQty = $card.find(".soil-qty");
        if (soilQty.length > 0) {
            const jumlahTanah = soilQty.val() || 0;
            const satuanTanah = $card.find(".soil-unit").val() || "Karung";
            pesan += `\nKebutuhan tanah: ${jumlahTanah} ${satuanTanah}`;
        }

        pesan += `\n\nMohon informasi ketersediaan dan total biaya.`;

        const url = "https://wa.me/" + nomorWhatsApp + "?text=" + encodeURIComponent(pesan);
        window.open(url, "_blank");
    });

});
</script>
<script src="script.js"></script>
<script src="konsultasi.js"></script>

</body>
</html>