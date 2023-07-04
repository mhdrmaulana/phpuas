<?php

include 'koneksi.php';

$conn = getConnection();

$response = [];

try {
    if ($_POST) {
        $kode = $_POST["kode"];
        $kategori = $_POST["kategori"];

        $statement = $conn->prepare("INSERT INTO `tb_kategori` (`kode`, `kategori`) VALUES (:kode, :kategori);");

        $statement->bindParam(':kode', $kode);
        $statement->bindParam(':kategori', $kategori);

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
