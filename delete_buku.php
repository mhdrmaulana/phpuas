<?php
// Include file koneksi.php untuk mendapatkan koneksi ke database
include 'koneksi.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

// Mendapatkan data yang dikirim melalui metode POST atau GET

try {
    // Establish database connection
    $conn = getConnection();

    // Query SQL untuk menghapus data buku berdasarkan kode buku
    $query = "DELETE FROM tb_buku WHERE id = :id";

    // Mempersiapkan statement PDO untuk eksekusi query
    $statement = $conn->prepare($query);

    // Mengikat parameter dengan nilai yang sesuai
    $statement->bindParam(':id', $id);
    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';

    // Eksekusi statement
    $statement->execute();

    // Memeriksa apakah ada baris yang terpengaruh (data terhapus)

    $rowCount = $statement->rowCount();
    if ($rowCount > 0) {
        // Data buku berhasil dihapus
        $response = [
            'status' => 'success',
            'message' => 'Data buku berhasil dihapus'
        ];
    } else {
        // Data buku tidak ditemukan
        $response = [
            'status' => 'error',
            'message' => 'Kode buku tidak ditemukan'
        ];
    }
} catch (PDOException $e) {
    // Jika terjadi error, tampilkan pesan error
    $response = [
        'status' => 'error',
        'message' => 'Terjadi kesalahan saat menghapus data buku: ' . $e->getMessage()
    ];
}

// Mengirimkan response JSON
echo json_encode($response);

// Menutup koneksi
$conn = null;
?>
