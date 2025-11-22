<?php
include 'koneksi.php';

header("Content-Type: application/json");

// Pastikan requestnya adalah PUT atau POST (biasanya Postman kirim PUT)
if ($_SERVER["REQUEST_METHOD"] !== "PUT" && $_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Method harus PUT atau POST"]);
    exit;
}

// Ambil ID dari URL
$id = $_GET["id"] ?? null;

if (!$id) {
    echo json_encode(["status" => "error", "message" => "ID tidak ditemukan"]);
    exit;
}

// Karena PUT tidak otomatis baca $_POST, kita ambil manual
parse_str(file_get_contents("php://input"), $input);

// Ambil data yang di-update
$nama = $input["nama"] ?? null;
$email = $input["email"] ?? null;
$password = $input["password"] ?? null;

// Validasi
if (!$nama || !$email || !$password) {
    echo json_encode(["status" => "error", "message" => "Semua field wajib diisi"]);
    exit;
}

// Hash password
$hashPass = password_hash($password, PASSWORD_BCRYPT);

// Query update SQL
$query = "UPDATE users SET 
            nama='$nama', 
            email='$email', 
            password='$hashPass' 
          WHERE id=$id";

if (mysqli_query($koneksi, $query)) {
    echo json_encode(["status" => "success", "message" => "User berhasil diperbarui"]);
} else {
    echo json_encode(["status" => "error", "message" => "Gagal memperbarui user"]);
}
?>
