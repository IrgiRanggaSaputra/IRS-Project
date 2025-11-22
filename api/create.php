<?php
include 'koneksi.php';

header("Content-Type: application/json");

// Pastikan request POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Method harus POST"]);
    exit;
}

// Ambil data dari POST (bukan JSON)
$nama     = $_POST['nama'] ?? null;
$email    = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

// Validasi sederhana
if (!$nama || !$email || !$password) {
    echo json_encode(["status" => "error", "message" => "Semua field harus diisi"]);
    exit;
}

// Enkripsi password
$hashPass = password_hash($password, PASSWORD_BCRYPT);

// Query insert
$query = "INSERT INTO users (nama, email, password) VALUES ('$nama', '$email', '$hashPass')";

if (mysqli_query($koneksi, $query)) {
    echo json_encode([
        "status" => "success",
        "message" => "User berhasil ditambahkan",
        "data" => [
            "nama" => $nama,
            "email" => $email
        ]
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Gagal menambah user: " . mysqli_error($koneksi)
    ]);
}
?>
