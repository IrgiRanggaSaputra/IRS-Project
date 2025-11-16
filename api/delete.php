<?php
include 'koneksi.php';

$id = $_GET["id"];

$query = "DELETE FROM layanan WHERE id = $id";

if (mysqli_query($koneksi, $query)) {
    echo json_encode(["status" => "success", "message" => "Data berhasil dihapus"]);
} else {
    echo json_encode(["status" => "error", "message" => "Gagal menghapus data"]);
}
?>
