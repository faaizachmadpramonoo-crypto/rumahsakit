<?php
require 'functions.php';

// Ambil ID dari URL
$id = $_GET["id"];

// Query data pasien berdasarkan ID untuk ditampilkan di form
$conn = koneksi();
$result = mysqli_query($conn, "SELECT * FROM pasien WHERE id = $id");
$p = mysqli_fetch_assoc($result);

if (isset($_POST["submit"])) {
    if (ubah($_POST) > 0) {
        echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>alert('Data gagal diubah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ubah Data Pasien - RS Bensehat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; }</style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow p-4">
                <h4 class="text-primary mb-4">Edit Data Pasien</h4>
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $p['id']; ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="<?= $p['nama']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Usia</label>
                        <input type="number" name="usia" class="form-control" value="<?= $p['usia']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="2" required><?= $p['alamat']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Diagnosa</label>
                        <input type="text" name="diagnosa" class="form-control" value="<?= $p['diagnosa']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Riwayat Penyakit</label>
                        <input type="text" name="riwayat" class="form-control" value="<?= $p['riwayat']; ?>" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>