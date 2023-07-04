<?php

include 'koneksi.php';

$conn = getConnection();

$response = [];

try {
    if ($_GET) {
        $id_peminjaman_master = $_GET["id"];

        // Fetch peminjaman_master and peminjaman_detail based on the provided id_peminjaman_master

        // Prepare your query here to fetch both peminjaman_master and peminjaman_detail data

        $statement = $conn->prepare("SELECT * FROM tb_peminjaman_master WHERE id = :id_peminjaman_master;");
        $statement->bindParam(':id_peminjaman_master', $id_peminjaman_master);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result) {

            $response = [
                'status' => 'success',
                'data' =>   $result
            ];

        } else {
            $response["message"] = "Data not found.";
        }
    } else {
        $response["message"] = "Data tidak diterima.";
    }
} catch (PDOException $e) {
    $response["message"] = "Error: " . $e->getMessage();
}

echo json_encode($response, JSON_PRETTY_PRINT);
?>
