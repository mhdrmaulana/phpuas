<?php

include 'koneksi.php';

$conn = getConnection();

$response = [];

try {
    if ($_POST) {
        $kode = $_POST["kode"];
        $kode_kategori = $_POST["kode_kategori"];
        $judul = $_POST["judul"];
        $pengarang = $_POST["pengarang"];
        $penerbit = $_POST["penerbit"];
        $tahun = $_POST["tahun"];
        $harga = $_POST["harga"];

        // Check if a new image is provided
        if (isset($_FILES["file_cover"]["name"])) {
            $image_name = $_FILES["file_cover"]["name"];
            $extensions = ["jpg", "png", "jpeg"];
            $extension = pathinfo($image_name, PATHINFO_EXTENSION);

            if (in_array($extension, $extensions)) {
                $upload_path = 'upload/' . $image_name;

                if (move_uploaded_file($_FILES["file_cover"]["tmp_name"], $upload_path)) {

                    $file_cover = "https://mhdrmaulana.my.id/mypustaka/" . $upload_path;

                    // Update query with file_cover
                    $statement = $conn->prepare("UPDATE `tb_buku` SET `kode_kategori` = :kode_kategori, `judul` = :judul, `pengarang` = :pengarang, `penerbit` = :penerbit, `tahun` = :tahun, `harga` = :harga, `file_cover` = :file_cover WHERE `kode` = :kode;");

                    $statement->bindParam(':kode', $kode);
                    $statement->bindParam(':kode_kategori', $kode_kategori);
                    $statement->bindParam(':judul', $judul);
                    $statement->bindParam(':pengarang', $pengarang);
                    $statement->bindParam(':penerbit', $penerbit);
                    $statement->bindParam(':tahun', $tahun);
                    $statement->bindParam(':harga', $harga);
                    $statement->bindParam(':file_cover', $file_cover);

                    $statement->execute();

                    $response["message"] = "Data Berhasil Diupdate!";
                } else {
                    $response["message"] = "Gagal memindahkan file";
                }
            } else {
                $response["message"] = "Hanya diperbolehkan menginput file gambar!";
            }
        } else {
            // Update query without file_cover
            $statement = $conn->prepare("UPDATE `tb_buku` SET `kode_kategori` = :kode_kategori, `judul` = :judul, `pengarang` = :pengarang, `penerbit` = :penerbit, `tahun` = :tahun, `harga` = :harga WHERE `kode` = :kode;");

            $statement->bindParam(':kode', $kode);
            $statement->bindParam(':kode_kategori', $kode_kategori);
            $statement->bindParam(':judul', $judul);
            $statement->bindParam(':pengarang', $pengarang);
            $statement->bindParam(':penerbit', $penerbit);
            $statement->bindParam(':tahun', $tahun);
            $statement->bindParam(':harga', $harga);

            $statement->execute();

            $response["message"] = "Data berhasil diupdate";
        }
    } else {
        $response["message"] = "Data tidak diterima.";
    }
} catch (PDOException $e) {
    $response["message"] = "Error: " . $e->getMessage();
}

echo json_encode($response, JSON_PRETTY_PRINT);
?>
