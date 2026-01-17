<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moo Link - Pasteurized Living Milk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css?v=9">
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top navbar-dark navbar-on-scroll">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <img src="logo-moolink-putih-tanpa-teks.png" alt="MooLink Logo" class="logo-nav"> 
                Moo<span>Link</span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto text-center gap-3 py-3 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#hero-cinematic">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="#produk">Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="track.php">Lacak Susu</a></li>
                    <li class="nav-item">
                        <a href="#" class="btn btn-sm btn-outline-primary px-4 rounded-pill">Masuk Mitra</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="hero-cinematic" class="d-flex align-items-center text-white">
        
        <div class="overlay-dark"></div>

        <div class="container position-relative z-2 text-center">
            <div class="row justify-content-center">
                <div class="mb-4"> 
                    <img src="logo-moolink-putih.png" alt="MooLink Logo" class="logo-hero">
                    
                    <h1 class="display-3 fw-bold mb-4">
                        Kemurnian yang Hidup.
                    </h1>
                    
                    <p class="lead mb-5 px-md-5 opacity-75">
                        Bukan sekadar susu. Ini adalah komitmen kami menjaga nutrisi alami dari peternakan langsung ke pintu keluarga terpilih Anda.
                    </p>

                    <div class="d-flex justify-content-center gap-3">
                        <a href="#produk" class="btn btn-moo-primary btn-lg rounded-pill px-4">
                            Lihat Koleksi <i class="bi bi-arrow-down-short"></i>
                        </a>
                        
                        <a href="track.php" class="btn btn-outline-light btn-lg rounded-pill px-4">
                            Lacak Susu
                        </a>
                    </div>
                </div>
            </div>
        </div> 

        <div class="scroll-indicator position-absolute start-50 translate-middle-x text-center z-2 scroll-indicator-wrapper">
             <small class="text-white-50 scroll-text">Scroll untuk eksplorasi</small><br>
             <i class="bi bi-chevron-double-down fs-2 text-white fade-down-animation"></i>
        </div>

    </section>

    <section id="produk" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Pilih Ukuranmu</h2>
                <p class="text-muted">Terimakasih sudah memberdayakan peternak lokal Cangkringan.</p>
            </div>
            
            <div class="row">
                <?php
                $query = "SELECT * FROM products";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card card-product h-100 p-3">
                        <div class="position-absolute top-0 end-0 p-3 z-2"><span class="badge bg-success rounded-pill shadow-sm"><i class="bi bi-recycle"></i> Returnable</span>
                        </div>
                        <div class="product-img-wrapper">
                            <?php if(file_exists($row['gambar'])): ?>
                                <img src="<?php echo $row['gambar']; ?>" alt="" class="product-img-fit">
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
                                    echo '<button class="btn btn-secondary w-100" disabled>PO Besok Tutup (Lewat 21.00)</button>';
                                } else {
                                    echo '<button class="btn btn-moo-primary w-100" data-bs-toggle="modal" data-bs-target="#modalOrder"><i class="bi bi-cart-plus"></i> Pre-Order Besok </button>';
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

    <div class="modal fade" id="modalOrder" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header border-0 bg-light rounded-top-4">
                    <h5 class="modal-title fw-bold">🥛 Data Penerima Susu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Nama Penerima</label>
                            <input type="text" class="form-control rounded-3" placeholder="Contoh: Erynd">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Nomor WhatsApp</label>
                            <input type="number" class="form-control rounded-3" placeholder="08xxxx">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Alamat Pengiriman (Sleman Area)</label>
                            <textarea class="form-control rounded-3" rows="2" placeholder="Jalan Kaliurang KM..."></textarea>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="button" class="btn btn-primary btn-lg rounded-pill" onclick="alert('Pesanan Terkirim ke Sistem! (Simulasi)')">
                                Kirim Pesanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        window.onscroll = function() {
            var nav = document.querySelector('.navbar-on-scroll');
            if (window.pageYOffset > 50) {
                nav.classList.add('scrolled');
                nav.classList.remove('navbar-dark');
            } else {
                nav.classList.remove('scrolled');
                nav.classList.add('navbar-dark');
            }
        }
    </script>
</body>
</html>