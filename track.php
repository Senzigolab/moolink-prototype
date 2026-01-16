<?php 
include 'koneksi.php'; 
$kode = isset($_GET['batch']) ? $_GET['batch'] : '';
$data = null;

if($kode) {
    $q = "SELECT * FROM batches WHERE batch_code = '$kode'";
    $data = mysqli_fetch_assoc(mysqli_query($conn, $q));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Susu - Moo Link</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css?v=10">
</head>
<body class="bg-tracking-page">

    <nav class="navbar navbar-dark bg-transparent pt-4">
        <div class="container justify-content-center">
             <a class="navbar-brand fw-bold fs-3" href="index.php">
                <i class="bi bi-arrow-left me-2 small"></i> Moo<span>Link</span> Trace
            </a>
        </div>
    </nav>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                
                <?php if($data): ?>
                <div class="card card-glass rounded-4 overflow-hidden mb-5">
                    
                    <div class="card-header bg-success text-white text-center py-3 border-0">
                        <i class="bi bi-patch-check-fill me-2 fs-5"></i> 
                        <span class="fw-bold tracking-wider">VERIFIED LIVING MILK</span>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-5">
                            <small class="text-muted text-uppercase fw-bold letter-spacing-2">Batch Code</small>
                            <h1 class="display-4 fw-bold text-dark mt-1"><?php echo $data['batch_code']; ?></h1>
                            <span class="badge rounded-pill bg-light text-primary border px-3 py-2">
                                <i class="bi bi-shield-lock"></i> Blockchain Verified (Demo)
                            </span>
                        </div>

                        <h6 class="fw-bold text-uppercase text-muted small border-bottom pb-2 mb-4">Jejak Perjalanan</h6>
                        
                        <div class="trace-timeline">
                            
                            <div class="trace-item">
                                <h6 class="fw-bold text-primary mb-1">Pemerahan (Farm Source)</h6>
                                <p class="mb-1 text-dark fw-bold"><?php echo $data['peternak']; ?></p>
                                <p class="small text-muted mb-2">
                                    <i class="bi bi-geo-alt-fill"></i> <?php echo $data['lokasi']; ?> • 
                                    <i class="bi bi-clock"></i> <?php echo date('d M, H:i', strtotime($data['jam_perah'])); ?>
                                </p>
                                
                                <a class="btn btn-sm btn-light border text-primary small rounded-pill" data-bs-toggle="collapse" href="#petaLokasi">
                                    <i class="bi bi-map-fill"></i> Cek Lokasi Satelit
                                </a>

                                <div class="collapse mt-3" id="petaLokasi">
                                     <div class="rounded-3 overflow-hidden shadow-sm border">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31640.97087612711!2d110.4355!3d-7.6335!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a670000000001%3A0x5027a76e3568600!2sCangkringan%2C%20Sleman%20Regency%2C%20Special%20Region%20of%20Yogyakarta!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                    </div>
                                    <small class="text-muted fst-italic mt-1 d-block text-center" style="font-size: 10px;">*Lokasi peternakan mitra di Cangkringan, Sleman.</small>
                                </div>
                            </div>

                            <div class="trace-item">
                                <h6 class="fw-bold text-primary mb-1">Pasteurisasi (Processing)</h6>
                                <p class="mb-1 text-dark">Metode LTLT (Low Temp Long Time)</p>
                                <div class="d-flex align-items-center gap-2 mt-2">
                                    <div class="badge bg-danger rounded-pill px-3 py-2">
                                        <i class="bi bi-thermometer-half"></i> <?php echo $data['suhu_pasteurisasi']; ?>°C
                                    </div>
                                    <small class="text-muted">Suhu dijaga agar enzim tetap hidup.</small>
                                </div>
                            </div>

                            <div class="trace-item">
                                <h6 class="fw-bold text-primary mb-3">Kualitas Bioaktif (Lab Result)</h6>
                                
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span class="fw-bold">Protein Murni</span>
                                        <span class="text-success fw-bold">98% (Excellent)</span>
                                    </div>
                                    <div class="nutrient-bar">
                                        <div class="nutrient-fill" style="width: 98%;"></div>
                                    </div>
                                </div>

                                <div class="mb-1">
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span class="fw-bold">Tingkat Bakteri (TPC)</span>
                                        <span class="text-success fw-bold">Sangat Rendah (Safe)</span>
                                    </div>
                                    <div class="nutrient-bar">
                                        <div class="nutrient-fill bg-info" style="width: 95%;"></div>
                                    </div>
                                    <small class="text-muted mt-1 d-block" style="font-size: 11px;">*Berdasarkan uji sampel acak harian.</small>
                                </div>
                            </div>

                        </div> <div class="d-grid gap-2 mt-5">
                            <button class="btn btn-dark rounded-pill py-2">
                                <i class="bi bi-file-earmark-pdf"></i> Unduh Sertifikat Digital
                            </button>
                            <a href="index.php#produk" class="btn btn-outline-primary rounded-pill py-2">
                                Pesan Batch Ini Lagi
                            </a>
                        </div>

                    </div>
                    
                    <div class="card-footer bg-light text-center py-3 border-top">
                        <small class="text-muted">MooLink Technology &copy; 2026</small>
                    </div>
                </div>
                
                <?php else: ?>
                    <div class="card card-glass text-center p-5 rounded-4">
                        <i class="bi bi-search display-1 text-muted mb-3"></i>
                        <h3 class="fw-bold">Data Tidak Ditemukan</h3>
                        <p class="text-muted">Mohon periksa kembali Kode Batch di QR code botol Anda.</p>
                        <a href="index.php" class="btn btn-primary rounded-pill mt-3 px-4">Kembali ke Beranda</a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>