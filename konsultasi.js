$(function () {

    /* ==================================================
       UCCHANK'S LANDSCAPE - KONSULTASI.JS
    ================================================== */

    const nomorWhatsApp = "6283862555466";

    /* ==================================================
       FUNGSI SIMPAN DATABASE
    ================================================== */

    function simpanDatabase(data, callback) {
        $.ajax({
            url: "simpan_konsultasi.php",
            type: "POST",
            dataType: "json",
            data: data,
            success: function (response) {
                if (response.status === "success") {
                    callback(true);
                } else {
                    alert(response.message || "Data gagal disimpan.");
                    callback(false);
                }
            },
            error: function (xhr) {
                alert("Terjadi kesalahan saat menyimpan data ke database.");
                callback(false);
            }
        });
    }

    /* ==================================================
       1. FORM KONSULTASI JASA
    ================================================== */

    $("#waBtn").off("click");
    $(document).off("click", "#waBtn").on("click", "#waBtn", function () {
        const $button = $(this);

        const service = $("#serviceField").val().trim();
        const work    = $("#workField").val().trim();
        const name    = $("#nameField").val().trim();
        const phone   = $("#phoneField").val().trim();
        const panjang = $("#lengthField").val();
        const lebar   = $("#widthField").val();
        const luas    = $("#areaResult").text().trim();
        const lokasi  = $("#locationField").val().trim();
        const catatan = $("#noteField").val().trim();

        // Validasi input
        if (name === "") {
            alert("Silakan isi nama terlebih dahulu.");
            $("#nameField").focus();
            return;
        }

        if (phone === "") {
            alert("Silakan isi nomor WhatsApp terlebih dahulu.");
            $("#phoneField").focus();
            return;
        }

        if (panjang === "") {
            alert("Silakan isi panjang area terlebih dahulu.");
            $("#lengthField").focus();
            return;
        }

        if (lebar === "") {
            alert("Silakan isi lebar area terlebih dahulu.");
            $("#widthField").focus();
            return;
        }

        if (lokasi === "") {
            alert("Silakan isi lokasi terlebih dahulu.");
            $("#locationField").focus();
            return;
        }

        $button.prop("disabled", true);

        // Simpan ke database
        simpanDatabase({
            sumber: "Jasa",
            nama: name,
            whatsapp: phone,
            jasa: service,
            jenis_kebutuhan: work,
            produk: "",
            jumlah: 0,
            satuan: "",
            kebutuhan_tanah: "",
            panjang: panjang,
            lebar: lebar,
            lokasi: lokasi,
            catatan: catatan
        }, function (berhasil) {
            if (!berhasil) {
                $button.prop("disabled", false);
                return;
            }

            const message =
`Halo UCCHANK'S LANDSCAPE,

Saya ingin berkonsultasi mengenai jasa.

Jasa yang dipilih: ${service}
Jenis pengerjaan: ${work}

Nama: ${name}
WhatsApp: ${phone}

Panjang area: ${panjang} m
Lebar area: ${lebar} m
Luas area: ${luas} m²

Lokasi: ${lokasi}

Catatan kebutuhan:

${catatan || "-"}`;

            const waURL = "https://wa.me/" + nomorWhatsApp + "?text=" + encodeURIComponent(message);
            window.open(waURL, "_blank");

            $button.prop("disabled", false);
        });
    });

    /* ==================================================
       2. ORDER PRODUK VIA WHATSAPP
    ================================================== */

    $(document).off("click", ".product-wa-btn").on("click", ".product-wa-btn", function () {
        const $card = $(this).closest(".product-card");

        const productName     = $card.find(".product-name").text().trim();
        const category        = $card.find(".product-category").text().trim();
        const price           = $card.find(".product-price").text().trim();
        const unit            = $card.find(".product-unit").last().text().trim();
        const productCategory = $card.data("category");

        // Cek nama produk
        if (productName === "") {
            alert("Data produk tidak ditemukan.");
            return;
        }

        // Cek jumlah
        const quantity = parseInt($card.find(".qty-input").val(), 10) || 0;
        if (quantity <= 0) {
            alert("Silakan tentukan jumlah produk terlebih dahulu.");
            $card.find(".qty-input").focus();
            return;
        }

        // Pilihan instalasi
        const install = $card.find(".install-select").val() || "Tidak";

        // Kebutuhan tanah untuk rumput
        let soilQty  = 0;
        let soilUnit = "";

        if (productCategory === "rumput") {
            soilQty  = parseInt($card.find(".soil-qty").val(), 10) || 0;
            soilUnit = $card.find(".soil-unit").val() || "Karung";
        }

        // Simpan ke database
        simpanDatabase({
            sumber: "Produk",
            nama: "",
            whatsapp: "",
            jasa: "",
            jenis_kebutuhan: "Pembelian",
            produk: productName,
            jumlah: quantity,
            satuan: unit,
            kebutuhan_tanah: (productCategory === "rumput") ? soilQty + " " + soilUnit : "",
            panjang: 0,
            lebar: 0,
            lokasi: "",
            catatan: "Harga: " + price + " / " + unit + " | Instalasi: " + install
        }, function (berhasil) {
            if (!berhasil) {
                return;
            }

            // Format pesan WhatsApp
            let message =
`Halo UCCHANK'S LANDSCAPE,

Saya ingin memesan produk.

Produk: ${productName}
Kategori: ${category}
Jumlah: ${quantity} ${unit}
Harga: ${price} / ${unit}
Instalasi: ${install}`;

            if (productCategory === "rumput") {
                message += `\nTanah tambahan: ${soilQty} ${soilUnit}`;
            }

            message += `\n\nMohon informasi ketersediaan dan total biaya.`;

            const waURL = "https://wa.me/" + nomorWhatsApp + "?text=" + encodeURIComponent(message);
            window.open(waURL, "_blank");
        });
    });

    /* ==================================================
       3. FORM KONTAK
    ================================================== */

    $("#contactSubmit").off("click");
    $(document).off("click", "#contactSubmit").on("click", "#contactSubmit", function () {
        const name        = $("#contactName").val().trim();
        const phone       = $("#contactPhone").val().trim();
        const need        = $("#contactNeed").val();
        const messageText = $("#contactMessage").val().trim();

        // Validasi input
        if (name === "") {
            alert("Silakan isi nama terlebih dahulu.");
            $("#contactName").focus();
            return;
        }

        if (phone === "") {
            alert("Silakan isi nomor WhatsApp terlebih dahulu.");
            $("#contactPhone").focus();
            return;
        }

        if (need === "") {
            alert("Silakan pilih kebutuhan terlebih dahulu.");
            $("#contactNeed").focus();
            return;
        }

        if (messageText === "") {
            alert("Silakan isi pesan terlebih dahulu.");
            $("#contactMessage").focus();
            return;
        }

        // Tentukan kategori jasa / produk
        let jasa   = "";
        let produk = "";

        if (
            need === "Pembuatan Taman" ||
            need === "Renovasi Taman" ||
            need === "Pembuatan Kolam" ||
            need === "Renovasi Kolam"
        ) {
            jasa = need;
        }

        if (need === "Tanaman & Bunga") {
            produk = "Tanaman & Bunga";
        }

        if (need === "Rumput") {
            produk = "Rumput";
        }

        // Simpan ke database
        simpanDatabase({
            sumber: "Kontak",
            nama: name,
            whatsapp: phone,
            jasa: jasa,
            jenis_kebutuhan: "Konsultasi",
            produk: produk,
            jumlah: 0,
            satuan: "",
            kebutuhan_tanah: "",
            panjang: 0,
            lebar: 0,
            lokasi: "",
            catatan: messageText
        }, function (berhasil) {
            if (!berhasil) {
                return;
            }

            // Pesan WhatsApp
            const message =
`Halo UCCHANK'S LANDSCAPE,

Saya ingin berkonsultasi.

Nama: ${name}
WhatsApp: ${phone}
Kebutuhan: ${need}

Pesan:

${messageText}`;

            const waURL = "https://wa.me/" + nomorWhatsApp + "?text=" + encodeURIComponent(message);
            window.open(waURL, "_blank");
        });
    });

});