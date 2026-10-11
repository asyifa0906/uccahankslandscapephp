<?php

require_once __DIR__ . '/../auth.php';
include "../../config/db.php";

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
HAPUS DATA
=========================================================
*/
$query = mysqli_query(
    $conn,
    "DELETE FROM konsultasi
     WHERE id = $id"
);

if ($query) {
    header("Location: index.php");
    exit;
} else {
    die("Data konsultasi gagal dihapus: " . mysqli_error($conn));
}
?>