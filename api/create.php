<?php
include 'koneksi.php';

$input = json_decode(file_get_contents("php://input"), true);

if (!$input) {
    echo json_encode(["status" => "error", "message" => "Invalid JSON"]);
    exit;
}

$nama = $input["nama"];
$deskripsi = $input["deskripsi"];
$harga = $input["harga"];

$query = "INSERT INTO layanan (nama, deskripsi, harga) VALUES ('$nama', '$deskripsi', '$harga')";

if (mysqli_query($koneksi, $query)) {
    echo json_encode(["status" => "success", "message" => "Data berhasil ditambahkan"]);
} else {
    echo json_encode(["status" => "error", "message" => "Gagal menambah data"]);
}
?>
