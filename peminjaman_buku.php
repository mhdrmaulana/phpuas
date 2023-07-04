<?php

include 'koneksi.php';

$conn = getConnection();

$response = [];

try {
    if ($_POST) {
        $tanggal_peminjaman = $_POST["tanggal_peminjaman"];
        $nomor_anggota = $_POST["nomor_anggota"];
        $status_peminjaman = "DIPINJAM"; // Set default status to DIPINJAM

        // Validate if the provided nomor_anggota exists in the anggota table before proceeding with the peminjaman

        // Perform the insertion into peminjaman_master table
        $statement = $conn->prepare("INSERT INTO peminjaman_master (tanggal_peminjaman, nomor_anggota, status_peminjaman) VALUES (:tanggal_peminjaman, :nomor_anggota, :status_peminjaman);");

        $statement->bindParam(':tanggal_peminjaman', $tanggal_peminjaman);
        $statement->bindParam(':nomor_anggota', $nomor_anggota);
        $statement->bindParam(':status_peminjaman', $status_peminjaman);

        $statement->execute();

        $response["message"] = "Buku berhasil dipinjam!";
    } else {
        $response["message"] = "Data tidak diterima.";
    }
} catch (PDOException $e) {
    $response["message"] = "Error: " . $e->getMessage();
}

echo json_encode($response, JSON_PRETTY_PRINT);
?>
