<?php
require_once "includes/header.php";
require_once __DIR__ . '/config.php';

// fetch layanan
$layanan = [];
$res = $conn->query("SELECT id, nama, image, deskripsi, harga FROM layanan ORDER BY id ASC");
if ($res && $res->num_rows > 0) {
		while ($r = $res->fetch_assoc()) {
				$maybe = json_decode($r['deskripsi'] ?? '', true);
				$summary = is_array($maybe) && !empty($maybe['description']) ? mb_substr(strip_tags($maybe['description']),0,160) : mb_substr(strip_tags($r['deskripsi'] ?? ''),0,160);
				$layanan[] = [
						'id'=>$r['id'],'nama'=>$r['nama'],'image'=>$r['image'],'summary'=>$summary,'harga'=>$r['harga']
				];
		}
}
?>

<div class="container mt-4">
	<h3 class="mb-3">Daftar Layanan</h3>
	<div class="row">
		<?php if(empty($layanan)): ?>
			<div class="col-12"><div class="alert alert-info">Belum ada layanan tersedia.</div></div>
		<?php else: foreach($layanan as $l): ?>
			<div class="col-md-4 mb-4">
				<div class="card shadow-sm h-100">
					<img src="assets/image/<?= htmlspecialchars($l['image']) ?>" class="card-img-top" style="height:180px;object-fit:cover;">
					<div class="card-body d-flex flex-column">
						<h5 class="card-title"><?= htmlspecialchars($l['nama']) ?></h5>
						<p class="card-text small text-muted"><?= htmlspecialchars($l['summary']) ?></p>
						<div class="mt-auto d-flex justify-content-between align-items-center">
							<a href="detail.php?id=<?= $l['id'] ?>" class="btn btn-primary">Lihat Detail</a>
							<?php if(!empty($l['harga'])): ?>
								<div class="text-success fw-bold">Rp <?= number_format($l['harga'],0,',','.') ?></div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; endif; ?>
	</div>
</div>

<?php require_once "includes/footer.php"; ?>

