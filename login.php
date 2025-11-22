<?php
session_start();
require "config.php";

$error = "";

if (isset($_POST["login"])) {
    $nama = trim($_POST["nama"] ?? "");
    $password = $_POST["password"] ?? "";

    $stmt = $conn->prepare("SELECT * FROM users WHERE nama = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param("s", $nama);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $data = $result->fetch_assoc();

            if (password_verify($password, $data["password"])) {
                session_regenerate_id(true);
                // set both legacy 'user' array and the specific keys menu.php expects
                $_SESSION["user"] = $data;
                $_SESSION["user_id"] = $data['id'] ?? null;
                $_SESSION["user_name"] = $data['nama'] ?? ($data['name'] ?? null);
                header("Location: menu.php");
                exit;
            } else {
                $error = "Nama dan Password salah!";
            }
        } else {
            $error = "Nama dan password tidak ditemukan!";
        }

        $stmt->close();
    } else {
        $error = "Terjadi kesalahan (gagal menyiapkan query).";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login IRS Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="col-md-4 mx-auto">
        <div class="card p-4 shadow">
            <h3 class="text-center mb-3">Login</h3>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?=$error;?></div>
            <?php endif; ?>

            <!-- Tambahkan event onsubmit untuk validasi -->
            <form method="POST" onsubmit="return validateLogin()">

                <label>Nama</label>
                <input type="text" id="nama" name="nama" class="form-control mb-3" required>

                <label>Password</label>
                <input type="password" id="password" name="password" class="form-control mb-3" required>

                <button  class="btn btn-primary w-100" name="login">Login</button>
            </form>

            <p class="text-center mt-3">
                Belum punya akun? <a href="register.php">Register</a>
            </p>
        </div>
    </div>
</div>

<!-- ============================= -->
<!--  JavaScript Validasi Login IF -->
<!-- ============================= -->

<script>
function validateLogin() {
    let nama = document.getElementById("nama").value.trim();
    let password = document.getElementById("password").value.trim();

    // Cek nama kosong
    if (nama === "") {
        alert("Nama tidak boleh kosong!");
        return false;
    }

    // Cek panjang nama
    if (nama.length < 3) {
        alert("Nama harus minimal 3 karakter!");
        return false;
    }

    // Cek password kosong
    if (password === "") {
        alert("Password tidak boleh kosong!");
        return false;
    }

    // Cek panjang password
    if (password.length < 6) {
        alert("Password minimal 6 karakter!");
        return false;
    }

    return true; // valid → submit form ke PHP
}
</script>

</body>
</html>
