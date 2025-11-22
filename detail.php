<?php
require_once "includes/header.php";
require_once __DIR__ . '/config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$item = null;

if ($id > 0) {
    $stmt = $conn->prepare("SELECT id, nama, image, deskripsi, harga FROM layanan WHERE id = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Decode JSON dari kolom deskripsi
            $json = json_decode($row['deskripsi'], true);

            if (is_array($json)) {
                $item = [
                    'id'          => $row['id'],
                    'title'       => $row['nama'],
                    'image'       => $row['image'],
                    'description' => $json['description'] ?? '',
                    'summary'     => mb_substr(strip_tags($json['description'] ?? ''), 0, 160),
                    'harga'       => (int) $row['harga'],
                    'scope'       => $json['scope'] ?? [],
                    'benefits'    => $json['benefits'] ?? [],
                    'process'     => $json['process'] ?? [],
                ];
            } else {
                // Jika suatu saat deskripsi bukan JSON
                $text = $row['deskripsi'];
                $item = [
                    'id'          => $row['id'],
                    'title'       => $row['nama'],
                    'image'       => $row['image'],
                    'description' => $text,
                    'summary'     => mb_substr(strip_tags($text), 0, 160),
                    'harga'       => (int) $row['harga'],
                    'scope'       => [],
                    'benefits'    => [],
                    'process'     => [],
                ];
            }
        }
        $stmt->close();
    }
}
?>

<?php if ($item): ?>
<div class="container py-4">

    <div class="card shadow-sm border-0">
        <div class="row g-0">
            
            <!-- Image -->
            <div class="col-md-6 position-relative">
                <img src="assets/image/<?= htmlspecialchars($item['image']) ?>"
                     class="img-fluid w-100 h-100 rounded-start"
                     style="object-fit: cover; max-height:520px;" 
                     alt="<?= htmlspecialchars($item['title']) ?>">

                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end"
                     style="background: linear-gradient(180deg, rgba(0,0,0,0) 50%, rgba(0,0,0,0.35));">
                    <div class="p-3 text-white">
                        <h2 class="fw-bold mb-1"><?= htmlspecialchars($item['title']) ?></h2>
                        <p class="mb-0 small"><?= htmlspecialchars($item['summary']) ?></p>
                    </div>
                </div>
            </div>

            <!-- Detail -->
            <div class="col-md-6">
                <div class="card-body">

                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <h3 class="h5 mb-1"><?= htmlspecialchars($item['title']) ?></h3>
                            <p class="text-muted small mb-2"><?= htmlspecialchars($item['summary']) ?></p>
                        </div>
                        <div class="text-end">
                            <?php if (!empty($item['harga'])): ?>
                                <div class="fs-5 text-primary fw-bold">Rp <?= number_format($item['harga'], 0, ',', '.') ?></div>
                                <div class="small text-muted">(Harga estimasi)</div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <p class="mt-3"><?= nl2br(htmlspecialchars($item['description'])) ?></p>

                    <div class="row mt-4">
                        <div class="col-6">
                            <a href="index.php" class="btn btn-outline-secondary w-100">Kembali</a>
                        </div>
                        <div class="col-6">
                            <a href="login.php" class="btn btn-primary w-100">Daftar / Konsultasi</a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Scope & Benefits -->
    <div class="row mt-4 g-3">

        <div class="col-md-6">
            <div class="card p-3 shadow-sm h-100">
                <h5 class="fw-bold">Ruang Lingkup</h5>
                <ul class="mb-0 mt-2">
                    <?php if (!empty($item['scope'])): ?>
                        <?php foreach ($item['scope'] as $s): ?>
                            <li><?= htmlspecialchars($s) ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="text-muted">Tidak ada rincian ruang lingkup.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-3 shadow-sm h-100">
                <h5 class="fw-bold">Manfaat untuk Klien</h5>

                <div class="d-flex flex-column gap-2 mt-2">
                    <?php if (!empty($item['benefits'])): ?>
                        <?php foreach ($item['benefits'] as $b): ?>
                            <div class="d-flex align-items-start">
                                <div class="me-2 text-success" style="font-size:18px;line-height:1">✓</div>
                                <div><?= htmlspecialchars($b) ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-muted">Tidak ada manfaat terdaftar.</div>
                    <?php endif; ?>
                </div>

            </div>
        </div>

        <!-- Process -->
        <div class="col-12">
            <div class="card p-3 shadow-sm">
                <h5 class="fw-bold">Proses Kerja</h5>

                <ol class="mt-2">
                    <?php if (!empty($item['process'])): ?>
                        <?php foreach ($item['process'] as $p): ?>
                            <li><?= htmlspecialchars($p) ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="text-muted">Proses tidak tersedia.</li>
                    <?php endif; ?>
                </ol>
            </div>
        </div>

    </div>

</div>

<?php else: ?>
<div class="container py-4">
    <div class="alert alert-warning">Layanan tidak ditemukan.</div>
    <a href="index.php" class="btn btn-dark">Kembali</a>
</div>
<?php endif; ?>

<?php require_once "includes/footer.php"; ?>
