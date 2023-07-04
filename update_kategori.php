<?php
include 'koneksi.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');
$conn = getConnection();
// Memeriksa apakah data telah dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Memeriksa apakah elemen-elemen yang dibutuhkan tersedia dalam array $_POST
    if (isset($_POST['kode'], $_POST['kategori'])) {
        // Mendapatkan data dari request
        $kode = $_POST['kode'];
        $kategori = $_POST['kategori'];

        // Query SQL untuk memperbarui data anggota berdasarkan nomor
        $sql = "UPDATE tb_kategori SET kategori='$kategori' WHERE kode='$kode'";

        try {
            $conn->query($sql);
            $response = [
                'status' => 'success',
                'message' => 'Data anggota berhasil diperbarui.'
            ];
        } catch (PDOException $e) {
            // Jika terjadi error, tampilkan pesan error
            $response = [
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengupdate data anggota: ' . $e->getMessage()
            ];
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Data yang diperlukan tidak lengkap.'
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'Metode request yang tidak valid.'
    ];
}

echo json_encode($response);
?>
