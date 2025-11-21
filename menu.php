<?php
session_start();
require_once "config.php";

// Jika user belum login
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

// Ambil data statistik dari Database (gunakan $conn dari config.php)
$jumlahUser = 0;
$res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
if ($res) {
    $row = mysqli_fetch_assoc($res);
    $jumlahUser = $row["total"] ?? 0;
}

// Jika punya tabel layanan
$jumlahLayanan = 0;
$res = mysqli_query($conn, "SHOW TABLES LIKE 'layanan'");
if ($res && $res->num_rows > 0) {
    $res2 = mysqli_query($conn, "SELECT COUNT(*) AS total FROM layanan");
    if ($res2) {
        $row = mysqli_fetch_assoc($res2);
        $jumlahLayanan = $row["total"] ?? 0;
    }
}

// Jika punya tabel proyek
$jumlahProyek = 0;
$res = mysqli_query($conn, "SHOW TABLES LIKE 'proyek'");
if ($res && $res->num_rows > 0) {
    $res2 = mysqli_query($conn, "SELECT COUNT(*) AS total FROM proyek");
    if ($res2) {
        $row = mysqli_fetch_assoc($res2);
        $jumlahProyek = $row["total"] ?? 0;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Menu Utama</title>
    <link rel="icon" type="image/png" href="assets/image/logo-IRS.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f8ff;
        }
        .menu-card {
            transition: 0.3s;
            cursor: pointer;
        }
        .menu-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .top-banner {
            background: linear-gradient(135deg, #1f6feb, #37b7ff);
            color: white;
            padding: 35px;
            border-radius: 15px;
        }
    </style>
</head>

<body>

<div class="container mt-4">

    <!-- Banner Selamat Datang -->
    <div class="top-banner mb-4">
        <h2 class="fw-bold mb-0">Halo, <?= $_SESSION["user"]["nama"] ?> 👋</h2>
        <p class="mt-2">Selamat datang di sistem IRS Project. Silakan pilih menu untuk melanjutkan.</p>
    </div>

    <!-- Stat Cards -->
    <div class="row mb-4">
        
        <div class="col-md-4">
            <div class="card text-center p-3 shadow-sm">
                <h5 class="fw-bold">Total User</h5>
                <h2 class="text-primary fw-bold"><?= $jumlahUser ?></h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-3 shadow-sm">
                <h5 class="fw-bold">Total Layanan</h5>
                <h2 class="text-success fw-bold"><?= $jumlahLayanan ?></h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-3 shadow-sm">
                <h5 class="fw-bold">Total Proyek</h5>
                <h2 class="text-warning fw-bold"><?= $jumlahProyek ?></h2>
            </div>
        </div>

    </div>

    <h4 class="fw-bold mb-3">Menu Utama</h4>

    <div class="row">

        <!-- DASHBOARD -->
        <div class="col-md-4 mb-4">
            <div class="card menu-card p-3" onclick="window.location='dashboard.php'">
                <div class="card-body text-center">
                    <img src="assets/icons/dashboard.png" width="60" class="mb-3">
                    <h5 class="fw-bold">Dashboard</h5>
                    <p class="text-muted">Melihat ringkasan data dan aktivitas penting.</p>
                </div>
            </div>
        </div>

        <!-- LAYANAN -->
        <div class="col-md-4 mb-4">
            <div class="card menu-card p-3" onclick="window.location='layanan.php'">
                <div class="card-body text-center">
                    <img src="assets/icons/service.png" width="60" class="mb-3">
                    <h5 class="fw-bold">Kelola Layanan</h5>
                    <p class="text-muted">Mengelola data layanan, deskripsi, dan konten.</p>
                </div>
            </div>
        </div>

        <!-- USER MANAGEMENT -->
        <div class="col-md-4 mb-4">
            <div class="card menu-card p-3" onclick="window.location='users.php'">
                <div class="card-body text-center">
                    <img src="assets/icons/user.png" width="60" class="mb-3">
                    <h5 class="fw-bold">Manajemen User</h5>
                    <p class="text-muted">Mengatur akun admin, operator, dan akses lainnya.</p>
                </div>
            </div>
        </div>

    </div>

    <h4 class="fw-bold mt-4 mb-3">Pengaturan</h4>

    <div class="row">

        <!-- PROFIL -->
        <div class="col-md-6 mb-4">
            <div class="card menu-card p-3" onclick="window.location='profile.php'">
                <div class="card-body text-center">
                    <img src="assets/icons/profile.png" width="60" class="mb-3">
                    <h5 class="fw-bold">Profil Saya</h5>
                    <p class="text-muted">Perbarui informasi akun Anda.</p>
                </div>
            </div>
        </div>

        <!-- LOGOUT -->
        <div class="col-md-6 mb-4">
            <div class="card menu-card p-3 bg-danger text-white" onclick="window.location='logout.php'">
                <div class="card-body text-center">
                    <img src="assets/icons/logout.png" width="60" class="mb-3">
                    <h5 class="fw-bold">Logout</h5>
                    <p>Keluar dari sistem dengan aman.</p>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>
