<?php
include 'koneksi.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');
$conn = getConnection();
// Memeriksa apakah data telah dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Memeriksa apakah elemen-elemen yang dibutuhkan tersedia dalam array $_POST
    if (isset($_POST['nomor'], $_POST['nama'], $_POST['jenis_kelamin'], $_POST['alamat'], $_POST['no_hp'])) {
        // Mendapatkan data dari request
        $nomor = $_POST['nomor'];
        $nama = $_POST['nama'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $no_hp = $_POST['no_hp'];

        // Query SQL untuk memperbarui data anggota berdasarkan nomor
        $sql = "UPDATE tb_anggota SET nama='$nama', jenis_kelamin='$jenis_kelamin', alamat='$alamat', no_hp='$no_hp' WHERE nomor='$nomor'";

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
