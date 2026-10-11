<?php

// Konfigurasi Koneksi Database
$conn = mysqli_connect("localhost", "root", "", "ucchankslandscape");

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

?>