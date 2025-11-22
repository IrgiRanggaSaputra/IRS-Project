<?php
require_once "includes/header.php";

// Simple riwayat page. If you have an orders/transactions table, we could query it here.
if (!isset($_SESSION['user_id'])) {
		header('Location: login.php');
		exit;
}

$userId = $_SESSION['user_id'];
?>

<div class="container mt-4">
	<div class="card p-4 shadow-sm">
		<h4>Riwayat Anda</h4>
		<p class="text-muted">Berikut riwayat layanan/aktivitas Anda.</p>

		<div class="mt-3">
			<div class="alert alert-info">Belum ada riwayat yang tercatat. .</div>
			<a href="layanan.php" class="btn btn-primary">Lihat Layanan</a>
		</div>
	</div>
</div>

<?php require_once "includes/footer.php"; ?>

