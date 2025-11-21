<?php
require "config.php";

$msg = "";

if (isset($_POST["register"])) {
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (nama, email, password) VALUES ('$nama', '$email', '$password')";

    if ($conn->query($query)) {
        $msg = "Registrasi berhasil! Silakan login.";
    } else {
        $msg = "Terjadi kesalahan.";
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

            <form method="POST">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control mb-3" required>

                <label>Email</label>
                <input type="email" name="email" class="form-control mb-3" required>

                <label>Password</label>
                <input type="password" name="password" class="form-control mb-3" required>

                <button class="btn btn-success w-100" name="register">Register</button>
            </form>

            <p class="text-center mt-3">
                Sudah punya akun? <a href="login.php">Login</a>
            </p>
        </div>
    </div>
</div>

</body>
</html>
