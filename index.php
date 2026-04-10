
<?php
// Memanggil file logika database
require 'functions.php';

// Ambil semua data pasien dari database
$pasien = getPasien();

// Logika jika tombol "Simpan ke Database" ditekan
if (isset($_POST["submit"])) {
    if (tambahPasien($_POST) > 0) {
        echo "<script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan data. Periksa kembali inputan Anda.');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id" id="html-page" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumah Sakit Bensehat</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        /* Transisi halus saat ganti mode */
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: var(--bs-body-bg); 
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        
        .hero-header {
            background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);
            color: white;
            padding: 30px 0;
            border-radius: 0 0 40px 40px;
            margin-bottom: 40px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        /* Tombol melayang untuk ganti mode */
        .btn-theme-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            cursor: pointer;
            transition: 0.3s;
        }

        .card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .btn-custom { border-radius: 12px; font-weight: 600; padding: 12px; transition: 0.3s; }
        .patient-name { cursor: pointer; color: var(--bs-primary); transition: 0.2s; }
        .patient-name:hover { text-decoration: underline; }
        
        /* Penyesuaian warna badge untuk dark mode */
        [data-bs-theme="dark"] .badge-diagnosa { background-color: rgba(229, 62, 62, 0.2); color: #ff8787; border: 1px solid #e53e3e; }
        [data-bs-theme="light"] .badge-diagnosa { background-color: #fff5f5; color: #e53e3e; border: 1px solid #feb2b2; }
    </style>
</head>
<body>

<div class="btn-theme-toggle btn btn-primary" id="themeToggler">
    <i class="bi bi-moon-stars-fill" id="themeIcon"></i>
</div>

<div class="hero-header text-center">
    <div class="container">
        <h1 class="fw-bold"><i class="bi bi-hospital"></i> Rumah Sakit Bensehat</h1>
        <p class="opacity-75 mb-0">Sistem Manajemen Informasi Pasien</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card p-4 shadow-sm">
                <h5 class="fw-bold text-primary mb-4"><i class="bi bi-plus-circle-fill"></i> Input Pasien Baru</h5>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama Pasien" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Usia (Tahun)</label>
                        <input type="number" name="usia" class="form-control" placeholder="Contoh: 25" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat lengkap..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Diagnosa</label>
                        <input type="text" name="diagnosa" class="form-control" placeholder="Hasil diagnosa medis" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Riwayat Penyakit</label>
                        <input type="text" name="riwayat" class="form-control" placeholder="Pernah sakit apa sebelumnya?" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary w-100 btn-custom mt-2">
                        <i class="bi bi-cloud-arrow-up-fill"></i> Simpan ke Database
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold text-primary mb-0"><i class="bi bi-people-fill"></i> Daftar Pasien</h5>
                    <span class="badge bg-primary rounded-pill px-3 py-2">Total: <?= count($pasien); ?> Orang</span>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="small text-uppercase fw-bold text-muted">
                            <tr>
                                <th width="50">No.</th>
                                <th>Nama Pasien</th>
                                <th>Usia</th>
                                <th>Diagnosa</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach ($pasien as $row) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td>
                                    <span class="patient-name fw-semibold" data-bs-toggle="modal" data-bs-target="#modalDetail<?= $row['id']; ?>">
                                        <?= $row["nama"]; ?>
                                    </span>
                                </td>
                                <td><?= $row["usia"]; ?> Thn</td>
                                <td><span class="badge badge-diagnosa"><?= $row["diagnosa"]; ?></span></td>
                                <td class="text-center">
                                    <div class="btn-group border rounded shadow-sm">
                                        <a href="ubah.php?id=<?= $row["id"]; ?>" class="btn btn-sm text-warning border-end">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="hapus.php?id=<?= $row["id"]; ?>" class="btn btn-sm text-danger" onclick="return confirm('Yakin hapus?');">
                                            <i class="bi bi-trash3"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalDetail<?= $row['id']; ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow" style="border-radius: 25px;">
                                        <div class="modal-header border-0 bg-body-tertiary rounded-top-4">
                                            <h5 class="modal-title fw-bold">Informasi Pasien</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-4 text-center">
                                            <i class="bi bi-person-badge text-primary mb-3" style="font-size: 50px;"></i>
                                            <h3 class="fw-bold mb-1"><?= $row["nama"]; ?></h3>
                                            <p class="text-muted mb-4 small">ID Pasien: #00<?= $row["id"]; ?></p>
                                            
                                            <div class="row text-start g-3">
                                                <div class="col-6">
                                                    <label class="small text-muted d-block">Usia</label>
                                                    <span class="fw-bold"><?= $row["usia"]; ?> Tahun</span>
                                                </div>
                                                <div class="col-6">
                                                    <label class="small text-muted d-block">Status</label>
                                                    <span class="badge bg-success">Aktif</span>
                                                </div>
                                                <div class="col-12 border-top pt-3">
                                                    <label class="small text-muted d-block">Alamat</label>
                                                    <p class="mb-0 fw-medium"><?= $row["alamat"]; ?></p>
                                                </div>
                                                <div class="col-12 border-top pt-3 text-danger">
                                                    <label class="small text-muted d-block text-body">Diagnosa</label>
                                                    <p class="fw-bold mb-0"><?= $row["diagnosa"]; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 p-3">
                                            <button type="button" class="btn btn-secondary w-100 rounded-3" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="text-center text-muted py-5 small">
    &copy; 2026 <strong>Rumah Sakit Bensehat</strong>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Script Logic untuk Dark Mode
    const toggler = document.getElementById('themeToggler');
    const themeIcon = document.getElementById('themeIcon');
    const htmlTag = document.getElementById('html-page');

    // Fungsi ganti tema
    function switchTheme(theme) {
        htmlTag.setAttribute('data-bs-theme', theme);
        localStorage.setItem('theme', theme); // Simpan ke browser

        if (theme === 'dark') {
            themeIcon.className = 'bi bi-sun-fill';
            toggler.classList.replace('btn-primary', 'btn-warning');
        } else {
            themeIcon.className = 'bi bi-moon-stars-fill';
            toggler.classList.replace('btn-warning', 'btn-primary');
        }
    }

    // Cek saat halaman pertama kali dibuka
    const savedTheme = localStorage.getItem('theme') || 'light';
    switchTheme(savedTheme);

    // Event saat tombol diklik
    toggler.addEventListener('click', () => {
        const currentTheme = htmlTag.getAttribute('data-bs-theme');
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        switchTheme(newTheme);
    });
</script>

</body>
</html>