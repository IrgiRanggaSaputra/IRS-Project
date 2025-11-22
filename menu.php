<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Ambil data user (fallback ke array user jika tersedia)
$user_name = $_SESSION['user_name'] ?? ($_SESSION['user']['nama'] ?? 'Pengguna');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Utama </title>
    <link rel="icon" type="image/png" href="assets/image/logo-IRS.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .hero {
            background: linear-gradient(135deg,#4f46e5,#06b6d4);
            color: white;
            padding: 40px 20px;
            border-radius: 12px;
        }
        .menu-card { border-radius: 12px; transition: transform .18s ease, box-shadow .18s ease; }
        .menu-card:hover { transform: translateY(-6px); box-shadow: 0 12px 30px rgba(0,0,0,.08); }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg bg-white shadow-sm px-4 py-2">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
        <img src="assets/image/logo-IRS.png" alt="IRS Logo" height="40" class="me-2">
        <span class="fw-bold">IRS Project</span>
    </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item me-3"><span class="small text-muted">Signed in as</span> <strong class="ms-1"><?php echo htmlspecialchars($user_name); ?></strong></li>
                <li class="nav-item"><a class="nav-link text-primary" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-3">
    <div class="hero mb-4 d-flex align-items-center justify-content-between">
        <div>
            <h1 class="display-6 fw-bold mb-1">Selamat Datang, <?php echo htmlspecialchars($user_name); ?> 👋</h1>
            <p class="mb-0 opacity-75">Pilih menu di bawah untuk mengelola akun dan layanan Anda.</p>
        </div>
        <div>
            <a href="#contactModal" data-bs-toggle="modal" class="btn btn-outline-light">Hubungi Admin</a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Layanan Saya -->
        <div class="col-md-4">
            <div class="card menu-card h-100 shadow-sm p-3">
                <div class="card-body text-center">
                    <img src="assets/icons/service.png" width="64" class="mb-3">
                    <h5 class="card-title">Layanan Saya</h5>
                    <p class="card-text">Melihat layanan yang sedang Anda pesan atau gunakan.</p>
                    <a href="layanan_saya.php" class="btn btn-primary">Masuk</a>
                </div>
            </div>
        </div>

        <!-- Riwayat -->
        <div class="col-md-4">
            <div class="card menu-card h-100 shadow-sm p-3">
                <div class="card-body text-center">
                    <img src="assets/icons/dashboard.png" width="64" class="mb-3">
                    <h5 class="card-title">Riwayat</h5>
                    <p class="card-text">Lihat riwayat layanan, proyek, atau transaksi sebelumnya.</p>
                    <a href="riwayat.php" class="btn btn-primary">Masuk</a>
                </div>
            </div>
        </div>

        <!-- Profil -->
        <div class="col-md-4">
            <div class="card menu-card h-100 shadow-sm p-3">
                <div class="card-body text-center">
                    <img src="assets/icons/profile.png" width="64" class="mb-3">
                    <h5 class="card-title">Profil</h5>
                    <p class="card-text">Kelola data akun Anda seperti email, nomor HP, dan password.</p>
                    <a href="profil.php" class="btn btn-primary">Masuk</a>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Contact Modal -->
<div class="modal fade" id="contactModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hubungi Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Anda dapat menghubungi admin melalui email atau WhatsApp:</p>
        <ul>
          <li>Email: <a href="mailto:irgiranggasaputra12@gmail.com">admin</a></li>
          <li>WhatsApp: <a href="https://wa.me/62895600157209" target="_blank">+62 812-3456-7890</a></li>
        </ul>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>