<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moo Link - Pasteurized Living Milk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <style>
        /* BACKGROUND UTAMA: Gambar Ahli Gizi & Sapi */
        body {
            background: linear-gradient(rgba(255,255,255, 0.8), rgba(255,255,255, 0.7)), url('bg.jpg') !important;
            background-size: cover !important;
            background-position: center !important;
            background-attachment: fixed !important;
            background-repeat: no-repeat !important;
        }
        
        /* Agar tulisan tetap terbaca jelas */
        .hero-section {
            background: transparent !important;
        }
        #produk {
            background: transparent !important;
        }
        /* =========================================
       KHUSUS TAMPILAN HP (MOBILE RESPONSIVE)
       Kode di bawah ini HANYA jalan di layar kecil
       ========================================= */
    @media (max-width: 768px) {
        
        /* 1. Judul Hero (Susu Segar...) dikecilkan */
        .hero-section h1 {
            font-size: 2.5rem !important; /* Ukuran font lebih pas di HP */
        }
        
        /* 2. Mengurangi jarak kosong (padding) biar tidak boros layar */
        .hero-section {
            padding: 50px 0 !important; /* Di PC 100px, di HP cukup 50px */
            min-height: auto; /* Hilangkan paksaan tinggi */
        }
        
        /* 3. Menata Ikon Keunggulan (Glass Box, dll) */
        /* Biar ikonnya tidak terlalu raksasa tapi tetap jelas */
        .hero-section .bi {
            font-size: 2rem !important;
        }
        .hero-section p.small {
            font-size: 0.7rem; /* Teks di bawah ikon diperkecil sedikit */
        }
        
        /* 4. Kartu Produk (Beri jarak antar kartu saat berjejer ke bawah) */
        .card-product {
            margin-bottom: 20px; /* Biar gak dempet-dempetan */
        }

        /* 5. Navbar (Menu Atas) */
        .navbar-brand {
            font-size: 1.2rem; /* Nama Moo Link agak dikecilkan dikit */
        }
    }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-box-seam-fill" style="color: var(--moo-green);"></i> Moo<span style="color:black;">Link</span>
            </a>
            <button class="btn btn-sm btn-outline-primary ms-auto">Masuk Mitra</button>
        </div>
    </nav>

    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Susu Segar, <span style="color: var(--moo-blue);">Jujur</span>, & Terlacak.</h1>
            <p class="lead text-muted mb-4">
                Nikmati <em>Pasteurized Living Milk</em> langsung dari peternak Sleman. <br> 
                Pesan H-1, Perah Subuh, Antar Pagi. <strong>Zero Waste.</strong>
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="#produk" class="btn btn-moo-primary">Pesan Sekarang (H-1)</a>
                <a href="track.php?batch=MOO-2026-001" class="btn btn-outline-dark"><i class="bi bi-qr-code-scan"></i> Cek Asal Susu</a>
            </div>
            
            <div class="row mt-5 justify-content-center">
                <div class="col-4 col-md-2">
                    <i class="bi bi-shield-check fs-1 text-primary"></i>
                    <p class="small fw-bold mt-2">Glass Box<br>Traceability</p>
                </div>
                <div class="col-4 col-md-2">
                    <i class="bi bi-droplet-half fs-1 text-success"></i>
                    <p class="small fw-bold mt-2">Living Milk<br>Nutrisi Utuh</p>
                </div>
                <div class="col-4 col-md-2">
                    <i class="bi bi-clock-history fs-1 text-dark"></i>
                    <p class="small fw-bold mt-2">Pre-Order<br>Dijamin Baru</p>
                </div>
            </div>
        </div>
    </section>

    <section id="produk" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Pilih Ukuranmu</h2>
                <p class="text-muted">Dukunganmu memberdayakan peternak lokal Cangkringan & Pakem.</p>
            </div>
            
            <div class="row">
                <?php
                $query = "SELECT * FROM products";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card card-product h-100 p-3">
                        <div style="height: 200px; background-color: #f8f9fa; border-radius: 10px; display: flex; align-items: center; justify-content: center; overflow:hidden;">
                            <?php if(file_exists($row['gambar'])): ?>
                                <img src="<?php echo $row['gambar']; ?>" alt="" style="width:100%; height:100%; object-fit:cover;">
                            <?php else: ?>
                                <i class="bi bi-cup-straw fs-1 text-muted"></i>
                            <?php endif; ?>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold mt-3"><?php echo $row['nama_produk']; ?></h5>
                            <p class="card-text small text-muted"><?php echo $row['deskripsi']; ?></p>
                            <p class="price-tag">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                            
                            <?php 
                                date_default_timezone_set('Asia/Jakarta');
                                $jam_sekarang = date('H');

                                    if ($jam_sekarang >= 21) { 
                                            // Jika malam (tutup)
                                            echo '<button class="btn btn-secondary w-100" disabled>PO Besok Tutup (Lewat 21.00)</button>';
                                            } else {
                                            // Jika siang/pagi (buka) - Perhatikan tanda backslash (\) di bawah ini
                                            echo '<button class="btn btn-moo-primary w-100" onclick="alert(\'✅ Berhasil! Susu akan diperah subuh nanti dan dikirim pagi hari.\')">
                                            <i class="bi bi-cart-plus"></i> Pre-Order Besok </button>';
                                        }
                            ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <footer class="py-4 text-center border-top">
        <p class="mb-0 text-muted small">&copy; 2026 Moo Link. Solusi Rantai Pasok Susu Hyperlocal.</p>
    </footer>
</body>
</html>