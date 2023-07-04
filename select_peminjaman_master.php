<?php

include 'koneksi.php';

$conn = getConnection();

$response = [];

try {
    if ($_POST) {
        $nomor_anggota = $_POST["nomor_anggota"];
        $status_peminjaman = $_POST["status_peminjaman"];
        $tanggal_pengembalian = $_POST["tanggal_pengembalian"];
        $durasi_keterlambatan = $_POST["durasi_keterlambatant"];

        $statement = $conn->prepare("INSERT INTO `tb_peminjaman_master` (`nomor_anggota`, `status_peminjaman`, `tanggal_pengembalian`, `durasi_keterlambatan`) 
VALUES (:nomor_anggota, :status_peminjaman, :tanggal_pengembalian, :durasi_keterlambatan);");

        $statement->bindParam(':nomor_anggota', $nomor_anggota);
        $statement->bindParam(':status_peminjaman', $status_peminjaman);
        $statement->bindParam(':tanggal_pengembalian', $tanggal_pengembalian);
        $statement->bindParam(':durasi_keterlambatan', $durasi_keterlambatan);

        if ($statement->execute()) {
            $response["message"] = "Data Berhasil Direkam!";
        } else {
            $response["message"] = "Gagal menyimpan data.";
        }
    } else {
        $response["message"] = "Data tidak diterima.";
    }
} catch (PDOException $e) {
    $response["message"] = "Error: " . $e->getMessage();
}

echo json_encode($response, JSON_PRETTY_PRINT);
?>
