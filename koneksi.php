<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Header: Content-Type');
header('Access-Control-Allow-Method: GET, POST, OPTION, DELETE');

function getConnection() {
    $host = 'localhost';
    $username = 'mhdrmaul_web';
    $password = 'tYHXONOnweaV';
    $db = 'mhdrmaul_myperpush';


    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}
?>