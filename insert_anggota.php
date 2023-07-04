<?php

include 'koneksi.php';

$conn = getConnection();

$response = [];

try {
    if ($_POST) {
        $nomor = $_POST["nomor"];
        $nama = $_POST["nama"];
        $jenis_kelamin = $_POST["jenis_kelamin"];
        $alamat = $_POST["alamat"];
        $no_hp = $_POST["no_hp"];

        $statement = $conn->prepare("INSERT INTO `tb_anggota` (`nomor`, `nama`, `jenis_kelamin`, `alamat`, `no_hp`, `tanggal_terdaftar`) VALUES (:nomor, :nama, :jenis_kelamin, :alamat, :no_hp, :tanggal_terdaftar);");

        $statement->bindParam(':nomor', $nomor);
        $statement->bindParam(':nama', $nama);
        $statement->bindParam(':jenis_kelamin', $jenis_kelamin);
        $statement->bindParam(':alamat', $alamat);
        $statement->bindParam(':no_hp', $no_hp);
        $statement->bindParam(':tanggal_terdaftar', $tanggal_terdaftar);

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
