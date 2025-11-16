<?php
include 'koneksi.php';

$data = [];
$q = mysqli_query($koneksi, "SELECT * FROM layanan");

while ($row = mysqli_fetch_assoc($q)) {
    $data[] = $row;
}

echo json_encode([
    "status" => "success",
    "data" => $data
]);
?>
