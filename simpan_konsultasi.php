<?php

include "config/db.php";

header("Content-Type: application/json");

// ==================================================
// CEK REQUEST
// ==================================================

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode([
        "status" => "error",
        "message" => "Request tidak valid."
    ]);
    exit;
}

// ==================================================
// AMBIL DATA
// ==================================================

$sumber = trim($_POST["sumber"] ?? "");
$nama = trim($_POST["nama"] ?? "");
$whatsapp = trim($_POST["whatsapp"] ?? "");

$jasa = trim($_POST["jasa"] ?? "");
$jenis_kebutuhan = trim($_POST["jenis_kebutuhan"] ?? "");

$produk = trim($_POST["produk"] ?? "");

$jumlahInput = $_POST["jumlah"] ?? "";
$satuan = trim($_POST["satuan"] ?? "");

$kebutuhan_tanah = trim($_POST["kebutuhan_tanah"] ?? "");

$panjangInput = $_POST["panjang"] ?? "";
$lebarInput = $_POST["lebar"] ?? "";

$lokasi = trim($_POST["lokasi"] ?? "");
$catatan = trim($_POST["catatan"] ?? "");

// ==================================================
// VALIDASI SUMBER
// ==================================================

if ($sumber === "") {
    if (!empty($jasa)) {
        $sumber = "Jasa";
    } elseif (!empty($produk)) {
        $sumber = "Produk";
    }
}

if ($sumber === "") {
    echo json_encode([
        "status" => "error",
        "message" => "Sumber data tidak diketahui."
    ]);
    exit;
}

// ==================================================
// VALIDASI NAMA
// ==================================================

if (($sumber === "Jasa" || $sumber === "Kontak") && $nama === "") {
    echo json_encode([
        "status" => "error",
        "message" => "Nama belum diisi."
    ]);
    exit;
}

// ==================================================
// VALIDASI WHATSAPP
// ==================================================

if (($sumber === "Jasa" || $sumber === "Kontak") && $whatsapp === "") {
    echo json_encode([
        "status" => "error",
        "message" => "Nomor WhatsApp belum diisi."
    ]);
    exit;
}

// ==================================================
// PANJANG, LEBAR, LUAS
// ==================================================

if ($panjangInput !== "" && is_numeric($panjangInput)) {
    $panjang = (float)$panjangInput;
} else {
    $panjang = 0;
}

if ($lebarInput !== "" && is_numeric($lebarInput)) {
    $lebar = (float)$lebarInput;
} else {
    $lebar = 0;
}

$luas = $panjang * $lebar;

// ==================================================
// JUMLAH
// ==================================================

if ($jumlahInput !== "" && is_numeric($jumlahInput)) {
    $jumlah = (float)$jumlahInput;
} else {
    $jumlah = 0;
}

// ==================================================
// STATUS
// ==================================================

$status = "Menunggu";

// ==================================================
// AMANKAN DATA
// ==================================================

$sumber = mysqli_real_escape_string($conn, $sumber);
$nama = mysqli_real_escape_string($conn, $nama);
$whatsapp = mysqli_real_escape_string($conn, $whatsapp);
$jasa = mysqli_real_escape_string($conn, $jasa);
$jenis_kebutuhan = mysqli_real_escape_string($conn, $jenis_kebutuhan);
$produk = mysqli_real_escape_string($conn, $produk);
$satuan = mysqli_real_escape_string($conn, $satuan);
$kebutuhan_tanah = mysqli_real_escape_string($conn, $kebutuhan_tanah);
$lokasi = mysqli_real_escape_string($conn, $lokasi);
$catatan = mysqli_real_escape_string($conn, $catatan);
$status = mysqli_real_escape_string($conn, $status);

// ==================================================
// INSERT DATABASE
// ==================================================

$sql = "
    INSERT INTO konsultasi
    (
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
        status
    )
    VALUES
    (
        '$sumber',
        '$nama',
        '$whatsapp',
        '$jasa',
        '$jenis_kebutuhan',
        '$produk',
        '$jumlah',
        '$satuan',
        '$kebutuhan_tanah',
        '$panjang',
        '$lebar',
        '$luas',
        '$lokasi',
        '$catatan',
        '$status'
    )
";

// ==================================================
// JALANKAN QUERY
// ==================================================

$query = mysqli_query($conn, $sql);

// ==================================================
// BERHASIL
// ==================================================

if ($query) {
    echo json_encode([
        "status" => "success",
        "message" => "Data berhasil disimpan ke database."
    ]);
    exit;
}

// ==================================================
// GAGAL
// ==================================================

echo json_encode([
    "status" => "error",
    "message" => "Data gagal disimpan ke database: " . mysqli_error($conn)
]);

?>