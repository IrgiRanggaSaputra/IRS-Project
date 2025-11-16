<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "irs_project";

$koneksi = mysqli_connect($host, $user, $pass, $db);

header("Content-Type: application/json");

if (!$koneksi) {
    echo json_encode(["status" => "error", "message" => "Koneksi gagal"]);
    exit;
}
?>
