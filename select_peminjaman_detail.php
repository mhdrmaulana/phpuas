<?php

include 'koneksi.php';

$response = [];

$conn = getConnection();

if ($conn) {
    try {
        $statement = $conn->prepare("SELECT * FROM tb_peminjaman_detail LEFT JOIN tb_buku ON tb_peminjaman_detail.kode_buku = tb_buku.kode ");
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($result, JSON_PRETTY_PRINT);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Failed to connect to the database.']);
}
