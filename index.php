<?php
require_once "includes/header.php";

// Load layanan from database instead of JSON
require_once __DIR__ . '/config.php';

$infos = [];
$sql = "SELECT id, nama, image, deskripsi FROM layanan ORDER BY id ASC";
$res = $conn->query($sql);
if ($res && $res->num_rows > 0) {
  while ($row = $res->fetch_assoc()) {
    $summary = '';
    // If deskripsi contains JSON, try to extract description or create a short summary
    $maybe = json_decode($row['deskripsi'] ?? '', true);
    if (is_array($maybe) && !empty($maybe['description'])) {
      $summary = mb_substr(strip_tags($maybe['description']), 0, 160);
    } else {
      $summary = mb_substr(strip_tags($row['deskripsi'] ?? ''), 0, 160);
    }

    $infos[] = [
      'id' => $row['id'],
      'title' => $row['nama'],
      'summary' => $summary,
      'image' => $row['image']
    ];
  }
}
?>

<style>
.hero {
    background: linear-gradient(135deg, #1f6feb, #37b7ff);
    color: white;
    padding: 80px 20px;
    border-radius: 20px;
}
.hero h1 {
    font-size: 48px;
    font-weight: 700;
}
.hero p {
    font-size: 18px;
    opacity: 0.9;
}
.service-card:hover {
    transform: translateY(-6px);
    transition: 0.3s;
}
.navbar {
    backdrop-filter: blur(10px);
    background: rgba(255,255,255,0.4) !important;
}
</style>

<!-- JUDUL -->
<div class="hero mb-5">
  <div class="row align-items-center">
    <div class="col-md-7">
      <h1>IRS Project</h1>
      <p>
        IRS Project merupakan mitra terpercaya dalam pengembangan teknologi informasi, 
        manajemen proyek, dan peningkatan kualitas SDM. Dengan pendekatan inovatif dan berorientasi pada hasil, 
        kami membantu organisasi mempercepat transformasi digital, meningkatkan efektivitas kerja, 
        dan meraih kesuksesan berkelanjutan.
      </p>
      <a href="login.php" class="btn btn-light btn-lg mt-3">Mulai Sekarang</a>
    </div>
    <div class="col-md-5 text-center">
      <img src="assets/image/irs.png" width="380">
    </div>
  </div>
</div>

<!-- LAYANAN -->
<h2 class="mb-4 text-center fw-bold">Layanan Kami</h2>

<div class="row">
  <?php foreach($infos as $info): ?>
  <div class="col-md-4 mb-4">
    <div class="card service-card shadow border-0 p-3">
      <div class="card-body">
        <h4 class="fw-bold"><?=$info['title'];?></h4>
        <p><?=$info['summary'];?></p>
        <a href="detail.php?id=<?= $info['id'] ?>" class="btn btn-primary mt-2">Lihat Detail</a>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>

<?php require_once "includes/footer.php"; ?>
