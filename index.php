<?php
// ===== DATA PRODUK (array PHP) =====
$produk = [
    ["nama" => "Iphone 18 Promax",     "kategori" => "MURAH", "harga" => 30000000, "stok" => 25],
    ["nama" => "Samsung Galaxy S26 Ultra",     "kategori" => "MAHAL", "harga" => 23000000, "stok" => 15],
    ["nama" => "Oppo Find X9",     "kategori" => "MAHAL", "harga" => 17000000, "stok" => 0],
    ["nama" => "Huawei Mate X7",   "kategori" => "MAHAL", "harga" => 19000000, "stok" => 10],
    ["nama" => "Poco F8 Ultra", "kategori" => "MURAH", "harga" => 24000000, "stok" => 8],
    ["nama" => "Samsung Galaxy Z Flip 8",       "kategori" => "MURAH",  "harga" => 30000000, "stok" => 40],
    ["nama" => "Iphone 17 Promax",           "kategori" => "MURAH",  "harga" => 20000000, "stok" => 30],
];


$batas_diskon = 23000000;
$persen_diskon = 10;


function rupiah($angka) {
    return "Rp" . number_format($angka, 0, ",", ".");
}

$total_produk = count($produk);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIA STORE</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- NAVBAR -->
    <header class="navbar">
        <div class="container navbar-isi">
            <div class="logo">CIA STORE</div>
            <nav>
                <a href="#beranda">Beranda</a>
                <a href="#katalog">Menu</a>
            </nav>
        </div>
    </header>

    <!-- HERO -->
    <section class="hero" id="beranda">
        <div class="container">
            <h1>Harga Murah, Kualitas Terdepan.</h1>
            <a href="#katalog" class="btn-hero">Lihat Menu</a>
        </div>
    </section>

    <!-- KATALOG -->
    <main class="container" id="katalog">
        <div class="katalog-atas">
            <h2>Produk kami</h2>
            <span class="total">Total Menu: <?= $total_produk; ?></span>
        </div>

        <div class="grid">
            <?php foreach ($produk as $item) : ?>
                <?php
                    // Percabangan: cek diskon
                    $dapat_diskon = $item["harga"] >= $batas_diskon;
                    $harga_akhir  = $item["harga"];

                    if ($dapat_diskon) {
                        $potongan    = $item["harga"] * $persen_diskon / 100;
                        $harga_akhir = $item["harga"] - $potongan;
                    }

                    // Percabangan: cek stok
                    $tersedia = $item["stok"] > 0;
                ?>
                <div class="card">
                    <div class="card-atas">
                        <span class="kategori"><?= $item["kategori"]; ?></span>
                        <?php if ($dapat_diskon) : ?>
                            <span class="badge-diskon">Diskon <?= $persen_diskon; ?>%</span>
                        <?php endif; ?>
                    </div>

                    <h3><?= $item["nama"]; ?></h3>

                    <div class="harga">
                        <?php if ($dapat_diskon) : ?>
                            <span class="harga-normal"><?= rupiah($item["harga"]); ?></span>
                            <span class="harga-akhir"><?= rupiah($harga_akhir); ?></span>
                        <?php else : ?>
                            <span class="harga-akhir"><?= rupiah($item["harga"]); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="stok-baris">
                        <span>Stok: <?= $item["stok"]; ?></span>
                        <?php if ($tersedia) : ?>
                            <span class="status tersedia">Tersedia</span>
                        <?php else : ?>
                            <span class="status habis">Stok Habis</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($tersedia) : ?>
                        <button class="btn-beli">Beli Sekarang</button>
                    <?php else : ?>
                        <button class="btn-beli" disabled>Beli Sekarang</button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <p>&copy; <?= date("Y"); ?> KUALITAS PASTI.</p>
        </div>
    </footer>

</body>
</html>
