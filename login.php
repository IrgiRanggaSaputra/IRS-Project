<?php
session_start();

// Load users JSON
$file = "data/users.json";
$users = json_decode(file_get_contents($file), true);

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["nama"]);
    $password = trim($_POST["password"]);

    foreach ($users as $u) {
        if ($u["nama"] === $nama && $u["password"] === $password) {
            
            // Simpan session
            $_SESSION["user"] = [
                "nama" => $u["nama"],
                "email" => $u["email"]
            ];

            // Pindah ke menu utama
            header("Location: menu.php");
            exit;
        }
    }

    $error = "Nama atau Password salah!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #eef2f7; }
        .login-box {
            max-width: 420px;
            margin: 80px auto;
            padding: 30px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<h2 class="text-center fw-bold my-4">Login</h2>

<div class="login-box">

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100 mt-2">Login</button>

        <a href="register.php" class="btn btn-link w-100 mt-2">Belum punya akun? Register</a>
    </form>

</div>

</body>
</html>
