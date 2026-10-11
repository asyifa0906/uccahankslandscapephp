<?php

require_once __DIR__ . '/../auth.php';

include "../../config/db.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query($conn, "DELETE FROM jasa WHERE id = $id");

if ($query) {
    header("Location: index.php");
    exit;
} else {
    echo "Data jasa gagal dihapus: " . mysqli_error($conn);
}

?>