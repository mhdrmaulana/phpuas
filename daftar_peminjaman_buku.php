<?php

include 'koneksi.php';

$conn = getConnection();

try {
    $status="DIPINJAM";
    if(isset($_REQUEST['status'])){
        if(!empty($_REQUEST['status'])){
            $status=$_REQUEST['status'];
        }
    }
    $statement = $conn->prepare("SELECT * FROM tb_peminjaman_master WHERE status_peminjaman = '$status';");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    $response = $result;
} catch (PDOException $e) {
    $response["message"] = "Error: " . $e->getMessage();
}

echo json_encode($response, JSON_PRETTY_PRINT);
?>
