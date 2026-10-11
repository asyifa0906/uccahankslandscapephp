$(function () {

    /* =========================================================
       UCCHANK'S LANDSCAPE - SCRIPT.JS
    ========================================================= */

    const nomorWhatsApp = "6283862555466";

    /* =========================================================
       BERANDA / HOME INTERAKSI
    ========================================================= */

    if ($(".hero-text").length) {
        $(".hero-text").hide().fadeIn(1200);
    }

    $(".photo")
        .on("mouseenter", function () {
            $(this).stop(true, true).animate({ opacity: 0.88 }, 200);
        })
        .on("mouseleave", function () {
            $(this).stop(true, true).animate({ opacity: 1 }, 200);
        });

    $(".service-item")
        .on("mouseenter", function () {
            $(this).stop(true, true).animate({ paddingLeft: "45px" }, 200);
        })
        .on("mouseleave", function () {
            $(this).stop(true, true).animate({ paddingLeft: "38px" }, 200);
        });

    $(".process-item")
        .on("mouseenter", function () {
            $(this).stop(true, true).animate({ opacity: 0.75 }, 200);
        })
        .on("mouseleave", function () {
            $(this).stop(true, true).animate({ opacity: 1 }, 200);
        });

    $(window).on("scroll", function () {
        $(".header").css(
            "box-shadow",
            $(window).scrollTop() > 50 ? "0 4px 18px rgba(0,0,0,0.08)" : "none"
        );
    });

    $(".video-card video").on("play", function () {
        $(".video-card video").not(this).each(function () {
            this.pause();
        });
    });

    /* =========================================================
       JASA KAMI INTERAKSI
    ========================================================= */

    if ($("#konsultasi").length) {

        /* -----------------------------------------------------
           PILIH JASA
        ----------------------------------------------------- */
        $(".detail-btn").on("click", function () {
            const service = $(this).data("service") || "-";

            $("#serviceField").val(service);
            $("#selectedService").text(service);

            const $consult = $("#konsultasi");

            if (!$consult.hasClass("show")) {
                $consult.hide().addClass("show").slideDown(400);
            } else {
                $consult.stop(true, true).slideDown(300);
            }

            $("html, body").stop(true, true).animate({
                scrollTop: $consult.offset().top - 110
            }, 500);
        });

        /* -----------------------------------------------------
           HITUNG LUAS
        ----------------------------------------------------- */
        function hitungLuas() {
            const panjang = parseFloat($("#lengthField").val()) || 0;
            const lebar   = parseFloat($("#widthField").val()) || 0;
            const luas    = panjang * lebar;

            $("#areaResult").text(
                Number.isInteger(luas) ? luas : luas.toFixed(2)
            );
        }

        $("#lengthField, #widthField").on("input", hitungLuas);

        /* -----------------------------------------------------
           KONSULTASI VIA WHATSAPP (SIMPAN DATABASE & BUKA WA)
        ----------------------------------------------------- */
        $("#waBtn").on("click", function () {
            const $button = $(this);

            const service  = $("#serviceField").val().trim() || "-";
            const work     = $("#workField").val().trim() || "-";
            const name     = $("#nameField").val().trim();
            const phone    = $("#phoneField").val().trim();
            const panjang  = $("#lengthField").val();
            const lebar    = $("#widthField").val();
            const luas     = $("#areaResult").text().trim() || "0";
            const location = $("#locationField").val().trim();
            const note     = $("#noteField").val().trim();

            /* VALIDASI */
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

            if (location === "") {
                alert("Silakan isi lokasi terlebih dahulu.");
                $("#locationField").focus();
                return;
            }

            const waWindow = window.open("about:blank", "_blank");
            $button.prop("disabled", true);

            /* SIMPAN DATA KE DATABASE */
            $.ajax({
                url: "simpan_konsultasi.php",
                type: "POST",
                dataType: "json",
                data: {
                    sumber: "Jasa",
                    nama: name,
                    whatsapp: phone,
                    jasa: service,
                    jenis_kebutuhan: work,
                    panjang: panjang,
                    lebar: lebar,
                    lokasi: location,
                    catatan: note
                },
                success: function (response) {
                    if (response.status !== "success") {
                        if (waWindow) {
                            waWindow.close();
                        }
                        alert(response.message || "Data gagal disimpan.");
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

Lokasi: ${location}

Catatan kebutuhan:

${note || "-"}`;

                    const waURL = "https://wa.me/" + nomorWhatsApp + "?text=" + encodeURIComponent(message);

                    if (waWindow) {
                        waWindow.location.href = waURL;
                    } else {
                        window.location.href = waURL;
                    }

                    $button.prop("disabled", false);
                },
                error: function () {
                    if (waWindow) {
                        waWindow.close();
                    }
                    alert("Data konsultasi gagal dikirim ke database.");
                    $button.prop("disabled", false);
                }
            });
        });

    }

    /* =========================================================
       KONTAK
    ========================================================= */

    if ($("#contactSubmit").length) {

        $("#contactSubmit").on("click", function () {
            const name        = $("#contactName").val().trim();
            const phone       = $("#contactPhone").val().trim();
            const need        = $("#contactNeed").val();
            const messageText = $("#contactMessage").val().trim();

            /* VALIDASI NAMA */
            if (name === "") {
                alert("Silakan isi nama terlebih dahulu.");
                $("#contactName").focus();
                return;
            }

            /* VALIDASI NOMOR */
            if (phone === "") {
                alert("Silakan isi nomor WhatsApp terlebih dahulu.");
                $("#contactPhone").focus();
                return;
            }

            /* VALIDASI KEBUTUHAN */
            if (need === "") {
                alert("Silakan pilih kebutuhan terlebih dahulu.");
                $("#contactNeed").focus();
                return;
            }

            /* VALIDASI PESAN */
            if (messageText === "") {
                alert("Silakan isi pesan terlebih dahulu.");
                $("#contactMessage").focus();
                return;
            }

            /* PESAN */
            const message =
`Halo UCCHANK'S LANDSCAPE,

Saya ingin berkonsultasi.

Nama: ${name}
WhatsApp: ${phone}
Kebutuhan: ${need}

Pesan:

${messageText}`;

            const url = "https://wa.me/" + nomorWhatsApp + "?text=" + encodeURIComponent(message);
            window.open(url, "_blank");
        });

    }

});
