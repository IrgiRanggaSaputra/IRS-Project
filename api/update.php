<?php
include 'koneksi.php';

$id = $_GET["id"];
$input = json_decode(file_get_contents("php://input"), true);

$nama = $input["nama"];
$deskripsi = $input["deskripsi"];
$harga = $input["harga"];

$query = "UPDATE layanan SET nama='$nama', deskripsi='$deskripsi', harga='$harga' WHERE id=$id";

if (mysqli_query($koneksi, $query)) {
    echo json_encode(["status" => "success", "message" => "Data berhasil diperbarui"]);
} else {
    echo json_encode(["status" => "error", "message" => "Gagal mengupdate data"]);
}
?>
