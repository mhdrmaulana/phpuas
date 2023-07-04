<?php

include 'koneksi.php';

$connection = getConnection();

if ($connection) {
    try {
        $where=null;
        if (isset($_REQUEST['q'])){

            $q=$_REQUEST['q'];
//            $where="where ";
            if (!empty($q)){
            $where="where kode='$q' or MATCH(`judul`, `pengarang`, `penerbit`) AGAINST ('$q' IN BOOLEAN MODE)";
            }


        }
        $statement = $connection->query("SELECT tb_buku.*,tb_kategori.kategori as kode_kategori FROM tb_buku LEFT JOIN tb_kategori ON tb_kategori.kode = tb_buku.kode_kategori $where");

        $statement-> setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetchAll();

        echo json_encode($result, JSON_PRETTY_PRINT);
    } catch (PDOException $e) {
        echo $e;
    }
} else {
    echo "Failed to connect to database.";
}
?>