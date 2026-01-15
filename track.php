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
    <link rel="stylesheet" href="style.css">
    <style>
        /* BACKGROUND LACAK: Gambar Perah Susu */
        body {
            background: linear-gradient(rgba(255,255,255, 0.7), rgba(255,255,255, 0.7)), url('bg_track.jpg') !important;
            background-size: cover !important;
            background-position: center !important;
            background-attachment: fixed !important;
        }
        /* Membuat kartu hasil scan sedikit transparan putih biar elegan */
        .card {
            /* Warna Putih dengan transparansi 80% (0.8) */
            /* Teks di dalamnya TIDAK akan ikut pudar */
            background: rgba(255, 255, 255, 0.3) !important;
            
            /* Efek blur di belakang kartu biar teks makin terbaca */
            backdrop-filter: blur(8px);
            
            /* List pinggir tipis biar rapi */
            border: 1px solid rgba(255, 255, 255, 0.5) !important;
        }
    </style>
</head>
<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="text-center mb-4">
                    <h3 class="fw-bold" style="color: var(--moo-blue);">Moo Trace</h3>
                    <p class="text-muted">Transparansi dari Peternak ke Tanganmu</p>
                </div>

                <?php if($data): ?>
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="card-header bg-success text-white text-center py-3">
                        <i class="bi bi-check-circle-fill me-2"></i> TERVERIFIKASI SEGAR
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h1 class="display-6 fw-bold"><?php echo $data['batch_code']; ?></h1>
                            <span class="badge bg-light text-dark border">Living Milk Quality</span>
                        </div>

                        <div class="trace-timeline">
                            <div class="trace-item">
                                <h6 class="fw-bold text-primary">Pemerahan (Farm Source)</h6>
                                <p class="mb-0 text-muted">Peternak: <strong><?php echo $data['peternak']; ?></strong></p>
                                <p class="mb-0 text-muted small"><i class="bi bi-geo-alt"></i> <?php echo $data['lokasi']; ?>
                                    <a class="text-decoration-none ms-1 fw-bold" data-bs-toggle="collapse" href="#petaLokasi" role="button" aria-expanded="false" aria-controls="petaLokasi" style="font-size: 0.85rem; color: var(--moo-blue);">
                                        [ <i class="bi bi-map"></i> Lihat Peta ]
                                    </a>
                                </p>

                            <div class="collapse mt-3" id="petaLokasi">
                                 <div class="rounded-3 overflow-hidden shadow-sm" style="border: 2px solid white;">
                            <iframe 
                                width="100%" 
                                height="250" 
                                style="border:0;" 
                                loading="lazy" 
                                allowfullscreen 
                                src="https://maps.google.com/maps?q=Rembulan+merapi+farm,+Cangkringan&t=&z=15&ie=UTF8&iwloc=&output=embed">
                            </iframe>
                            </div>
                            </div>
                                    <p class="small text-muted fst-italic mt-1">
                                    <i class="bi bi-pin-map-fill text-danger"></i> Lokasi Real-time: <strong>Rembulan Merapi Farm</strong> (Mitra Moo Link)</p>
                                <p class="fw-bold text-success mt-1"><i class="bi bi-clock"></i> <?php echo date('d M Y, H:i', strtotime($data['jam_perah'])); ?> WIB</p>
                            </div>

                            <div class="trace-item">
                                <h6 class="fw-bold text-primary">Pasteurisasi (Processing)</h6>
                                <p class="mb-0">Metode LTLT Presisi.</p>
                                <p class="mb-0">Suhu: <span class="badge bg-danger"><?php echo $data['suhu_pasteurisasi']; ?>°C</span> (Bioaktif Terjaga)</p>
                            </div>

                            <div class="trace-item">
                                <h6 class="fw-bold text-primary">Kualitas Nutrisi</h6>
                                <p class="mb-0">Protein Bioaktif: <strong><?php echo $data['nutrisi_protein']; ?></strong></p>
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button class="btn btn-outline-primary rounded-pill">Lihat Sertifikat Lab (Demo)</button>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                    <div class="alert alert-warning text-center">
                        Kode Batch tidak ditemukan. <br> <a href="index.php">Kembali</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>