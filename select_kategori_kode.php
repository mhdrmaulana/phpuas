<?php
include 'koneksi.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

// Mendapatkan data dari request
$kode = $_GET['kode'];

// Query SQL untuk mengambil data kategori berdasarkan kode
$sql = "SELECT * FROM tb_kategori WHERE kode='$kode'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $category = $result->fetch_assoc();
    $response = [
        'status' => 'success',
        'data' => $category
    ];
} else {
    $response = [
        'status' => 'error',
        'message' => 'Data kategori tidak ditemukan.'
    ];
}

echo json_encode($response);
?>
