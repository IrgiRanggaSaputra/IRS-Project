<?php
require_once "includes/header.php";
require_once __DIR__ . '/config.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
		header('Location: login.php');
		exit;
}

$userId = $_SESSION['user_id'];
$message = '';

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$nama = trim($_POST['nama'] ?? '');
		$email = trim($_POST['email'] ?? '');
		$newpass = $_POST['password'] ?? '';

		if ($nama === '' || $email === '') {
				$message = 'Nama dan email tidak boleh kosong.';
		} else {
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$message = 'Format email tidak valid.';
				} else {
						// update nama & email
						$stmt = $conn->prepare("UPDATE users SET nama = ?, email = ? WHERE id = ?");
						if ($stmt) {
								$stmt->bind_param('ssi', $nama, $email, $userId);
								$stmt->execute();
								$stmt->close();
						}

						// update password jika diisi
						if (!empty($newpass)) {
								$hashed = password_hash($newpass, PASSWORD_DEFAULT);
								$stmt2 = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
								if ($stmt2) {
										$stmt2->bind_param('si', $hashed, $userId);
										$stmt2->execute();
										$stmt2->close();
								}
						}

						// refresh session data
						$res = $conn->prepare("SELECT id, nama, email FROM users WHERE id = ? LIMIT 1");
						if ($res) {
								$res->bind_param('i', $userId);
								$res->execute();
								$r = $res->get_result();
								if ($r && $r->num_rows > 0) {
										$row = $r->fetch_assoc();
										$_SESSION['user'] = $row;
										$_SESSION['user_name'] = $row['nama'];
								}
								$res->close();
						}

						$message = 'Profil berhasil diperbarui.';
				}
		}
}

// Load current user data
$user = $_SESSION['user'] ?? [];
$namaVal = htmlspecialchars($user['nama'] ?? '');
$emailVal = htmlspecialchars($user['email'] ?? '');
?>

<div class="container mt-4">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card p-4 shadow-sm">
				<h4 class="mb-3">Profil Saya</h4>
				<?php if ($message): ?>
					<div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
				<?php endif; ?>

				<form method="post">
					<label>Nama</label>
					<input type="text" name="nama" class="form-control mb-2" required value="<?= $namaVal ?>">

					<label>Email</label>
					<input type="email" name="email" class="form-control mb-2" required value="<?= $emailVal ?>">

					<label>Ganti Password (kosongkan jika tidak ingin mengubah)</label>
					<input type="password" name="password" class="form-control mb-3">

					<button class="btn btn-primary w-100" type="submit">Simpan Perubahan</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php require_once "includes/footer.php"; ?>

