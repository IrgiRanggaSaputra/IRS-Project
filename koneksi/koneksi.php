<?php
$koneksi = mysqli_connect("localhost", "root", "", "irs_project");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
