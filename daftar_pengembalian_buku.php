<?php

include 'koneksi.php';

$conn = getConnection();

try {
    $statement = $conn->prepare("SELECT * FROM tb_peminjaman_master WHERE status_peminjaman = 'DIKEMBALIKAN';");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    $response = $result;
} catch (PDOException $e) {
    $response["message"] = "Error: " . $e->getMessage();
}

echo json_encode($response, JSON_PRETTY_PRINT);
?>
