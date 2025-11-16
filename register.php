<?php
// Mulai session
session_start();

$file = "data/users.json";

// Jika file belum ada, buat file JSON kosong
if (!file_exists($file)) {
    file_put_contents($file, "[]");
}

$users = json_decode(file_get_contents($file), true);
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nama = trim($_POST["nama"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Cek apakah user sudah ada
    foreach ($users as $u) {
        if ($u["nama"] === $nama) {
            $error = "Nama sudah digunakan!";
            break;
        }
        if ($u["email"] === $email) {
            $error = "Email sudah terdaftar!";
            break;
        }
    }

    // Jika tidak ada error → simpan user baru
    if (!$error) {
        $users[] = [
            "nama" => $nama,
            "email" => $email,
            "password" => $password // (bisa di-hash nanti)
        ];

        file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));

        $success = "Registrasi berhasil! Silakan login.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #eef2f7; }
        .register-box {
            max-width: 450px;
            margin: 70px auto;
            padding: 30px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<h2 class="text-center fw-bold my-4">Registrasi Akun</h2>

<div class="register-box">

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form method="post">

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-success w-100 mt-2">Daftar</button>

        <a href="login.php" class="btn btn-link w-100 mt-2">Sudah punya akun? Login</a>

    </form>

</div>

</body>
</html>
