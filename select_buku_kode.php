<?php
include 'koneksi.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');
$conn = getConnection();
// Mendapatkan data dari request
$id = $_GET['id'];

// Query SQL untuk mengambil data buku berdasarkan kode
$sql = "SELECT * FROM tb_buku WHERE id='$id'";
$result = $conn->query($sql);

if ($result->rowCount() > 0) {
    $buku = $result->fetchAll();
    $response = [
        'status' => 'success',
        'data' => $buku
    ];
} else {
    $response = [
        'status' => 'error',
        'message' => 'Data buku tidak ditemukan.'
    ];
}

echo json_encode($response);
?>
