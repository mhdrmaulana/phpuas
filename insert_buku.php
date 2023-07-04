<?php

include 'koneksi.php';

$conn = getConnection();

try {
    if ($_POST) {
        $kode = $_POST["kode"];
        $kode_kategori = $_POST["kode_kategori"];
        $judul = $_POST["judul"];
        $pengarang = $_POST["pengarang"];
        $penerbit = $_POST["penerbit"];
        $tahun = $_POST["tahun"];
        $harga = $_POST["harga"];

        if (isset($_FILES["file_cover"]["name"])) {
            $image_name = $_FILES["file_cover"]["name"];
            $extensions = ["jpg", "png", "jpeg"];
            $extension = pathinfo($image_name, PATHINFO_EXTENSION);

            if (in_array($extension, $extensions)) {
                $upload_path = 'upload/' . $image_name;

                if (move_uploaded_file($_FILES["file_cover"]["tmp_name"], $upload_path)) {

                    $file_cover = "https://mhdrmaulana.my.id/mypustaka/" . $upload_path;

                    $statement = $conn->prepare("INSERT INTO `tb_buku`(`kode`, `kode_kategori`, `judul`, `pengarang`, `penerbit`, `tahun`, `tanggal_input`, `harga`, `file_cover`) VALUES (:kode, :kode_kategori, :judul, :pengarang, :penerbit, :tahun, NOW(), :harga, :file_cover);");

                    $statement->bindParam(':kode', $kode);
                    $statement->bindParam(':kode_kategori', $kode_kategori);
                    $statement->bindParam(':judul', $judul);
                    $statement->bindParam(':pengarang', $pengarang);
                    $statement->bindParam(':penerbit', $penerbit);
                    $statement->bindParam(':tahun', $tahun);
                    $statement->bindParam(':harga', $harga);
                    $statement->bindParam(':file_cover', $file_cover);

                    $statement->execute();

                    $response["message"] = "Data Berhasil Direkam!";
                } else {
                    echo "gagal memindahkan file";
                }
            } else {
                $response["message"] = "Hanya diperbolehkan menginput file gambar!";
            }
        } else {
            $statement = $conn->prepare("INSERT INTO `tb_buku`(`kode`, `kode_kategori`, `judul`, `pengarang`, `penerbit`, `tahun`, `tanggal_input`, `harga`) VALUES (:kode, :kode_kategori, :judul, :pengarang, :penerbit, :tahun, NOW(), :harga)");

            $statement->bindParam(':kode', $kode);
            $statement->bindParam(':kode_kategori', $kode_kategori);
            $statement->bindParam(':judul', $judul);
            $statement->bindParam(':pengarang', $pengarang);
            $statement->bindParam(':penerbit', $penerbit);
            $statement->bindParam(':tahun', $tahun);
            $statement->bindParam(':harga', $harga);

            $statement->execute();
            $response["message"] = "Data berhasil direkam";
        }
    }
} catch (PDOException $e) {
    $response["message"] = "error $e";
}
echo json_encode($response, JSON_PRETTY_PRINT);
?>
