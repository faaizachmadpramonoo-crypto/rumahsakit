CREATE DATABASE kesehatan;

USE kesehatan;

CREATE TABLE pasien (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    usia INT,
    alamat TEXT,
    diagnosa TEXT,
    riwayat TEXT
)
DELETE FROM pasien WHERE id = ?;