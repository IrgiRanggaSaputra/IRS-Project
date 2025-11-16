<?php require_once "includes/header.php"; ?>
<?php
$infos = json_decode(file_get_contents("data/info.json"), true);
$id = $_GET['id'] ?? 0;

$item = null;
foreach($infos as $info){
    if($info['id'] == $id){ 
        $item = $info; 
        break; 
    }
}
?>

<?php if($item): ?>
<div class="container py-4">

    <!-- Banner / Gambar -->
    <div class="text-center mb-4">
        <img src="assets/image/<?= $item['image'] ?>" 
             class="img-fluid rounded shadow-sm" 
             style="max-height: 280px; object-fit: cover;">
    </div>

    <!-- Judul -->
    <h2 class="fw-bold"><?=$item['title']?></h2>
    <p class="text-muted fs-5"><?=$item['tagline']?></p>

    <hr>

    <!-- DESKRIPSI -->
    <h4 class="fw-bold mt-4">Deskripsi Layanan</h4>
    <p><?=$item['description']?></p>

    <!-- RUANG LINGKUP -->
    <h4 class="fw-bold mt-4">Ruang Lingkup Layanan</h4>
    <ul>
        <?php foreach($item['scope'] as $s): ?>
            <li><?=$s?></li>
        <?php endforeach; ?>
    </ul>

    <!-- MANFAAT -->
    <h4 class="fw-bold mt-4">Manfaat untuk Klien</h4>
    <ul>
        <?php foreach($item['benefits'] as $b): ?>
            <li><?=$b?></li>
        <?php endforeach; ?>
    </ul>

    <!-- PROSES KERJA -->
    <h4 class="fw-bold mt-4">Proses Kerja</h4>
    <ol>
        <?php foreach($item['process'] as $p): ?>
            <li><?=$p?></li>
        <?php endforeach; ?>
    </ol>

    <a href="index.php" class="btn btn-dark w-100 mt-4">Kembali</a>
</div>

<?php endif; ?>

<?php require_once "includes/footer.php"; ?>
