<?php

include 'koneksi.php';

$connection = getConnection();

if ($connection) {
    try {

        $statement = $connection->query("SELECT DISTINCT kode_kategori FROM tb_buku");

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