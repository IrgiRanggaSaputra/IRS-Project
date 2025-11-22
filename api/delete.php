<?php
include 'koneksi.php';

header("Content-Type: application/json");

// Ambil ID dari URL
$id = $_GET["id"] ?? null;

if (!$id) {
    echo json_encode(["status" => "error", "message" => "ID tidak ditemukan"]);
    exit;
}

// Query DELETE ke SQL users
$query = "DELETE FROM users WHERE id = $id";

if (mysqli_query($koneksi, $query)) {
    echo json_encode(["status" => "success", "message" => "User berhasil dihapus"]);
} else {
    echo json_encode(["status" => "error", "message" => "Gagal menghapus user"]);
}
?>
