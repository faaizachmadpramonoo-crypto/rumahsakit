<?php
require 'config.php';

function tambahPasien($data) {
    $conn = koneksi();

    $nama = htmlspecialchars($data['nama']);
    $usia = htmlspecialchars($data['usia']);
    $alamat = htmlspecialchars($data['alamat']);
    $diagnosa = htmlspecialchars($data['diagnosa']);
    $riwayat = htmlspecialchars($data['riwayat']);

    $query = "INSERT INTO pasien VALUES (
        NULL,
        '$nama',
        '$usia',
        '$alamat',
        '$diagnosa',
        '$riwayat'
    )";

    return mysqli_query($conn, $query);
}

function getPasien() {
    $conn = koneksi();
    $result = mysqli_query($conn, "SELECT * FROM pasien");

    $data = [];
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}
function ubah($data) {
    $conn = koneksi();

    $id = $data["id"];
    $nama = htmlspecialchars($data['nama']);
    $usia = htmlspecialchars($data['usia']);
    $alamat = htmlspecialchars($data['alamat']);
    $diagnosa = htmlspecialchars($data['diagnosa']);
    $riwayat = htmlspecialchars($data['riwayat']);

    $query = "UPDATE pasien SET 
                nama = '$nama',
                usia = '$usia',
                alamat = '$alamat',
                diagnosa = '$diagnosa',
                riwayat = '$riwayat'
              WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function hapus($id) {
    $conn = koneksi(); 
    mysqli_query($conn, "DELETE FROM pasien WHERE id = $id");

    return mysqli_affected_rows($conn);
}
?>