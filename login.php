<?php
session_start();
require "config.php";

$error = "";

if (isset($_POST["login"])) {
    $nama = trim($_POST["nama"] ?? "");
    $password = $_POST["password"] ?? "";

    // Use prepared statements to avoid SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE nama = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param("s", $nama);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $data = $result->fetch_assoc();

            if (password_verify($password, $data["password"])) {
                // Prevent session fixation
                session_regenerate_id(true);
                $_SESSION["user"] = $data;
                header("Location: menu.php");
                exit;
            } else {
                $error = "Password salah!";
            }
        } else {
            $error = "Nama pengguna tidak ditemukan!";
        }

        $stmt->close();
    } else {
        $error = "Terjadi
         kesalahan (gagal menyiapkan query).";
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

            <form method="POST">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control mb-3" required>

                <label>Password</label>
                <input type="password" name="password" class="form-control mb-3" required>

                <button class="btn btn-primary w-100" name="login">Login</button>
            </form>

            <p class="text-center mt-3">
                Belum punya akun? <a href="register.php">Register</a>
            </p>
        </div>
    </div>
</div>

</body>
</html>
