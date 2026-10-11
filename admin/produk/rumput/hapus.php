<?php

require_once __DIR__ . '/../../auth.php';
include "../../../config/db.php";

/*
=========================================================
CEK ID
=========================================================
*/
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

/*
=========================================================
HAPUS DATA RUMPUT
=========================================================
*/
$query = mysqli_query(
    $conn,
    "DELETE FROM produk
     WHERE id = $id
     AND kategori = 'Rumput'"
);

if ($query) {
    header("Location: index.php");
    exit;
} else {
    die("Data gagal dihapus: " . mysqli_error($conn));
}
?>