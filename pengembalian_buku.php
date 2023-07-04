<?php

include 'koneksi.php';

$conn = getConnection();

$response = [];

try {
    if ($_POST) {
        $id_peminjaman_master = $_POST["id_peminjaman_master"];
        $tanggal_pengembalian = $_POST["tanggal_pengembalian"];
        $durasi_keterlambatan = $_POST["durasi_keterlambatan"];

        // Perform the update in peminjaman_master table
        $statement = $conn->prepare("UPDATE peminjaman_master SET tanggal_pengembalian = :tanggal_pengembalian, durasi_keterlambatan = :durasi_keterlambatan, status_peminjaman = 'DIKEMBALIKAN' WHERE id = :id_peminjaman_master;");

        $statement->bindParam(':id_peminjaman_master', $id_peminjaman_master);
        $statement->bindParam(':tanggal_pengembalian', $tanggal_pengembalian);
        $statement->bindParam(':durasi_keterlambatan', $durasi_keterlambatan);

        $statement->execute();

        $response["message"] = "Buku berhasil dikembalikan!";
    } else {
        $response["message"] = "Data tidak diterima.";
    }
} catch (PDOException $e) {
    $response["message"] = "Error: " . $e->getMessage();
}

echo json_encode($response, JSON_PRETTY_PRINT);
?>
