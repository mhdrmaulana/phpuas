<?php
// Include file koneksi.php untuk mendapatkan koneksi ke database
include 'koneksi.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: GET, POST, DELETE, PUT');

// Mendapatkan data yang dikirim melalui metode POST

try {
    // Establish database connection
    $conn = getConnection();

    // Query SQL untuk menghapus data anggota berdasarkan nomor
    $query = "DELETE FROM tb_kategori WHERE id = :id";

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

        $response = [
            'status' => 'success',
            'message' => 'Data anggota berhasil dihapus'
        ];
    } else {
        // Data buku tidak ditemukan
        $response = [
            'status' => 'error',
            'message' => 'Nomor anggota tidak ditemukan'
        ];
    }
} catch (PDOException $e) {
    // Jika terjadi error, tampilkan pesan error
    $response = [
        'status' => 'error',
        'message' => 'Terjadi kesalahan saat menghapus data anggota: ' . $e->getMessage()
    ];
}

// Mengirimkan response JSON
echo json_encode($response);

// Menutup koneksi
$conn = null;
?>

