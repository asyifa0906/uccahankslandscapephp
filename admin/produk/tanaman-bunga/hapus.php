<?php

require_once __DIR__ . '/../../auth.php';
include "../../../config/db.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

mysqli_query(
    $conn,
    "DELETE FROM produk
     WHERE id = $id
     AND kategori = 'Tanaman & Bunga'"
);

header("Location: index.php");
exit;
?>