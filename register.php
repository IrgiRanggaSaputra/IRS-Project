<?php
require "config.php";

$msg = "";

if (isset($_POST["register"])) {
    $nama = trim($_POST["nama"]);
    $email = trim($_POST["email"]);
    $passwordRaw = $_POST["password"];
    $password = password_hash($passwordRaw, PASSWORD_DEFAULT);

    // Gunakan prepared statement agar aman
    $stmt = $conn->prepare("INSERT INTO users (nama, email, password) VALUES (?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sss", $nama, $email, $password);

        if ($stmt->execute()) {
            $msg = "Registrasi berhasil! Silakan login.";
        } else {
            $msg = "Terjadi kesalahan saat registrasi!";
        }

        $stmt->close();
    } else {
        $msg = "Gagal memproses data!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register IRS Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="col-md-4 mx-auto">
        <div class="card p-4 shadow">
            <h3 class="text-center mb-3">Register</h3>

            <?php if ($msg): ?>
                <div class="alert alert-info"><?=$msg;?></div>
            <?php endif; ?>

            <!-- Tambahkan validasi JavaScript -->
            <form method="POST" onsubmit="return validateRegister()">

                <label>Nama</label>
                <input type="text" id="nama" name="nama" class="form-control mb-3" required>

                <label>Email</label>
                <input type="email" id="email" name="email" class="form-control mb-3" required>

                <label>Password</label>
                <input type="password" id="password" name="password" class="form-control mb-3" required>

                <button class="btn btn-success w-100" name="register">Register</button>
            </form>

            <p class="text-center mt-3">
                Sudah punya akun? <a href="login.php">Login</a>
            </p>
        </div>
    </div>
</div>

<!-- =============================== -->
<!--  JavaScript Validasi Register IF -->
<!-- =============================== -->
<script>
function validateRegister() {
    let nama = document.getElementById("nama").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();

    // Validasi nama
    if (nama === "") {
        alert("Nama tidak boleh kosong!");
        return false;
    }
    if (nama.length < 3) {
        alert("Nama harus minimal 3 karakter!");
        return false;
    }

    // Validasi email format sederhana
    if (email === "") {
        alert("Email tidak boleh kosong!");
        return false;
    }
    if (!email.includes("@") || !email.includes(".")) {
        alert("Format email tidak valid!");
        return false;
    }

    // Validasi password
    if (password === "") {
        alert("Password tidak boleh kosong!");
        return false;
    }
    if (password.length < 6) {
        alert("Password minimal 6 karakter!");
        return false;
    }

    return true; // form valid → kirim ke PHP
}
</script>

</body>
</html>
